<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponses;
use App\Utility\NotificationUtility;
use Exception;
use Ichtrojan\Otp\Otp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    use ApiResponses;

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => [
                'required',
                Password::default()
            ],
        ]);
        $data['password'] = bcrypt($data['password']);
        DB::beginTransaction();
        try {
            $user = User::create($data)->assignRole('client');
            event(new Registered($user));
            $token = $user->createToken('authToken');
            DB::commit();

            return $this->sendSuccess('Successfully Completed', [
                'user' => UserResource::make($user),
                'token' => $token->plainTextToken,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return $this->sendError($e->getMessage(), []);
        }

    }

    public function login(LoginRequest $request)
    {
        $request->authenticate();
        if (! $request->user()->hasRole('client')) {
            return $this->sendError('Only Client Account Allowed');
        }
        $request->user()->tokens()->delete();
        $token = $request->user()->createToken('authToken');
        return $this->sendSuccess('Login Successfully', [
            'user' => UserResource::make($request->user()),
            'token' => $token->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->sendSuccess(__('Logged out Successfully'), []);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
        ]);
        $check = User::whereEmail($request->get('email'))->first();

        if ($check) {
            $Otp = new Otp();
            $code = $Otp->generate($check->email, 4);
            NotificationUtility::SendReset($code->token, $check->email);

            return $this->sendSuccess(__('We Sent Code To Your Email'), ['verify_token' => encrypt($check->email)]);
        } else {
            return $this->sendError(__('Account With this Phone Number Not Found'));
        }

    }

    public function validateOtpAndChangePassword(Request $request)
    {
        $request->validate([
            'verify_token' => 'required',
            'otp' => 'required',
            'password_confirmation' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);
        $token = decrypt($request->get('verify_token'));
        $otp = new Otp();
        if ($otp->validate($token, $request->get('otp'))->status) {
            $user = User::whereEmail($token)->first();
            $user->update([
                'password' => Hash::make($request->get('password')),
                'otp_verified' => 1,
            ]);
            $user->tokens()->delete();
            $token = $user->createToken('authToken');

            return $this->sendSuccess(__('Your Password Has Been Changed Successfully'), [
                'user' => UserResource::make($user),
                'token' => $token->plainTextToken,
            ]);
        }

        return $this->sendError(__('OTP is Wrong Try Again'));
    }

    public function userInfo()
    {
        return UserResource::make(auth()->user());
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPasswordRule()],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        auth()
            ->user()
            ->update(['password' => Hash::make($request->get('new_password'))]);

        return $this->sendSuccess(__('Password Changed Successfully'));
    }

    public function disableAccount()
    {
        auth()
            ->user()
            ->update([
                'disabled' => true,
            ]);

        return $this->sendSuccess(__('Your Account Disabled Successfully'));
    }
}
