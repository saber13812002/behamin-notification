<?php


namespace Behamin\Notification\Facades;


use Behamin\Notification\NotificationBuilder;
use Illuminate\Support\Facades\Facade;

/**
 * Class Notification
 * @package Behamin\Notification\Facades
 *
 * @method static \Behamin\Notification\NotificationBuilder title(string $title)
 * @method static \Behamin\Notification\NotificationBuilder icon(string $icon)
 * @method static \Behamin\Notification\NotificationBuilder data(string $data)
 * @method static \Behamin\Notification\NotificationBuilder isVisibleForUser(bool $isVisible)
 * @method static \Behamin\Notification\NotificationBuilder action(int $actionType, string $action)
 * @method static \Behamin\Notification\NotificationBuilder autoCancel(bool $autoCancel)
 * @method static \Behamin\Notification\NotificationBuilder addButton(string $title, int $actionType, string $action)
 * @method static \Behamin\Notification\NotificationBuilder priority(string $priority)
 * @method static \Behamin\Notification\NotificationBuilder type($type)
 * @method static \Behamin\Notification\NotificationBuilder image(string $image)
 * @method static \Behamin\Notification\NotificationBuilder description(string $description)
 * @method static array build(...$tokens)
 */
class Notification extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NotificationBuilder::class;
    }
}