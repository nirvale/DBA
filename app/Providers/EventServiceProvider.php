<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
      Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
          // Add some items to the menu...
          // $event->menu->add('MAIN NAVIGATION');
          // $event->menu->add([
          //     'text' => 'Blog',
          //     'url' => 'admin/blog',
          // ]);
          if (!Auth::check()) {
            $event->menu->add('SESIÓN');
            $event->menu->add([
                'text' => 'Login',
                'route' => 'login',
                'icon' => 'fas fa-fw fa-sign-in-alt',
            ]);
          }else {
            $event->menu->add('SESIÓN');
            $event->menu->add([
                'text' => 'Salir',
                'route' => 'cerrars',
                'icon' => 'fas fa-fw fa-sign-out-alt',

            ]);
          }
      });
    }
}
