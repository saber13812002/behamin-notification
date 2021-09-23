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
    public const ACTION_OPEN_APP = 0;
    public const ACTION_OPEN_WEB_URL = 1;
    public const ACTION_OPEN_OTHER_APP = 2;
    public const ACTION_OPEN_PAGE = 3;
    public const ACTION_OPEN_TELEGRAM_CHANNEL = 4;
    public const ACTION_OPEN_INSTAGRAM_PAGE = 5;
    public const ACTION_CALL_SERVICE = 6;

    public const PRIORITY_HIGH = 'high';
    public const PRIORITY_NORMAL = 'normal';

    public const TYPE_NOTIFICATION = 'notification';
    public const TYPE_DATA = 'data';

    protected static function getFacadeAccessor(): string
    {
        return NotificationBuilder::class;
    }
}
