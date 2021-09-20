<?php


namespace Behamin\Notification\Providers;


use Illuminate\Support\ServiceProvider;

class BehaminNotificationProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/notification.php' => config_path('notification.php'),
            ], 'config');
        }
    }
}