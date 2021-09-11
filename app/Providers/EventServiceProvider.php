<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
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
        Event::listen(BuildingMenu::class, function(BuildingMenu $event) {
            if(Auth::check()){
                $apps= Auth::user()->apps()->get();
                $myAppMenuItems = $apps->map(function($app){
                    return [
                        'text' => $app->name,
                        'url' => route('apps.show', [ 'app' => $app])
                    ];
                })->toArray();
                $event->menu->addIn('menu-my-apps', ...$myAppMenuItems);

                $topics = Auth::user()->topics()->orderBy('id', 'desc')->limit(10)->get();
                $myTopicsMenuItems = $topics->map(function($topic){
                    return [
                        'text' => $topic->title,
                        'url' => route('apps.topics.show', ['appId' => $topic->app_id, 'topicId' => $topic->id])
                    ];
                });
                $event->menu->addIn('my-topics', ...$myTopicsMenuItems);

                $event->menu->remove('menu-login');
                $event->menu->remove('menu-register');
            }
            $newTopicsMenu = Topic::orderBy('id', 'desc')->limit(5)->get()->map(function($topic){
                return [
                    'text' => $topic->title,
                    'url' => route('apps.topics.show', ['appId' => $topic->app_id, 'topicId' => $topic->id])
                ];
            });
            $event->menu->addIn('new-topics', ...$newTopicsMenu);
  
        });
    }
}
