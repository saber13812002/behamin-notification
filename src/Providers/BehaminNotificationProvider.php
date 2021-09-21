<?php


namespace Behamin\Notification\Providers;


use Behamin\Notification\NotificationBuilder;
use Illuminate\Support\ServiceProvider;

class BehaminNotificationProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Notification', function () {
            return new NotificationBuilder();
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/notification.php' => config_path('notification.php'),
            ], 'config');
        }
    }
}