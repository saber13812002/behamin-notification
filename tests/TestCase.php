<?php


namespace Behamin\Notification\Tests;

use Illuminate\Notifications\NotificationServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            NotificationServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('notification.package', 'com.package.app');
        $app['config']->set('notification.channel_id', 'test');
        $app['config']->set('notification.priority', 'high');
        $app['config']->set('notification.app_id', 0);
        $app['config']->set('notification.is_older_version', true);
    }
}