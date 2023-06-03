<?php

namespace Tests\Feature;

use App\Http\Livewire\TripSearch;
use App\Models\Reservation;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Livewire\Livewire;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_check_home_page_without_auth_if_redirect_to_login(): void
    {
        $this->get('/')
             ->assertStatus(302)
             ->assertRedirect(route('filament.auth.login'));
    }



    public function test_is_user_can_login_successfully()
    {
        $this->actingAs(User::first());
        $this->get(route('filament.auth.login'))
             ->assertRedirect(route('filament.pages.dashboard'));
    }

    public function test_is_user_can_see_reservation_from_in_home_page()
    {
        $this->actingAs(User::first());
        $this->get('/')
             ->assertStatus(200)
             ->assertSeeLivewire(TripSearch::class);
    }

    public function test_is_search_from_work_as_expected()
    {

        Livewire::actingAs(User::first());

        $this->get('/')
             ->assertSeeLivewire('trip-search');

        Livewire::test(TripSearch::class)
                ->call('search')
                ->assertHasErrors([
                    'fromStation' => 'required',
                    'toStation'   => 'required'
                ])
                ->assertSee('Sorry There are no Trips right now');

        Livewire::test(TripSearch::class,['fromStation' => 1,'toStation' => 4])
                ->call('search')
                ->assertSee(['2306010000001','2306010000002']);

    }

    public function test_reservation_is_work()
    {
        Livewire::actingAs(User::first());
        Livewire::test(TripSearch::class,['fromStation' => 1,'toStation' => 4,'requiredTrip' => Trip::find(1)])
                ->call('search')
                ->assertSee(['2306010000001','2306010000002'])
                ->call('paymentConfirmed');

        $this->assertTrue(Reservation::where([
            'user_id' => auth()->id(),
            'from_station' => 1,
            'to_station' => 4,
            'confirmed' => true
        ])->exists());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

}
