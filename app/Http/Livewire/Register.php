<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Http\Livewire;

use Filament\Facades\Filament;
use Illuminate\Auth\Events\Registered;
use JeffGreco13\FilamentBreezy\Http\Livewire\Auth\Register as FilamentBreezyRegister;


class Register extends FilamentBreezyRegister
{

    public function register()
    {
        $preparedData = $this->prepareModelData($this->form->getState());

        $user = config('filament-breezy.user_model')::create($preparedData);
        $user->assignRole('client');
        event(new Registered($user));
        Filament::auth()->login($user, true);

        return redirect()->to(config('filament-breezy.registration_redirect_url'));
    }
}
