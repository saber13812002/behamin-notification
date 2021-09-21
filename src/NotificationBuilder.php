<?php

namespace Behamin\Notification;

class NotificationBuilder
{
    private ?string $title = null;
    private string $appId;
    private ?string $description = null;
    private ?string $icon;
    private ?string $image = null;
    private ?string $data = null;
    private string $package;
    private bool $isVisibleForUser = true;
    private int $actionType = self::ACTION_OPEN_APP;
    private ?string $action = null;
    private bool $autoCancel = true;
    private array $actions = array();
    private string $channelId;
    private string $type;
    private string $priority;
    private array $tokens = array();
    private bool $isOlderVersion;

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

    public function __construct()
    {
        $this->package = config('notification.package');
        $this->channelId = config('notification.channel_id');
        $this->priority = config('notification.priority');
        $this->icon = config('notification.icon');
        $this->type = "notification";
        $this->appId = config('notification.app_id');
        $this->isOlderVersion = config('notification.is_older_version');
    }

    public function icon(string $icon): NotificationBuilder
    {
        $this->icon = $icon;
        return $this;
    }

    public function data(string $data): NotificationBuilder
    {
        $this->data = $data;
        return $this;
    }


    public function isVisibleForUser(bool $isVisible): NotificationBuilder
    {
        $this->isVisibleForUser = $isVisible;
        return $this;
    }

    public function action(int $actionType, string $action): NotificationBuilder
    {
        $this->actionType = $actionType;
        $this->action = $action;
        return $this;
    }

    public function autoCancel(bool $autoCancel): NotificationBuilder
    {
        $this->autoCancel = $autoCancel;
        return $this;
    }

    public function addButton(string $title, int $actionType, string $action): NotificationBuilder
    {
        $this->actions[] = [
            'title' => $title,
            'action_type' => $actionType,
            'action' => $action
        ];
        return $this;
    }

    public function priority(string $priority): NotificationBuilder
    {
        $this->priority = $priority;
        return $this;
    }

    public function type($type): NotificationBuilder
    {
        $this->type = $type;
        return $this;
    }

    public function image(string $image): NotificationBuilder
    {
        $this->image = $image;
        return $this;
    }

    public function title(string $title): NotificationBuilder
    {
        $this->title = $title;
        return $this;
    }

    public function description(string $description): NotificationBuilder
    {
        $this->description = $description;
        return $this;
    }


    /**
     * @param string|array ...$tokens
     * @return array
     */
    public function build(...$tokens): array
    {
        $this->tokens = func_get_args();
        return $this->buildNotificationData();
    }

    private function buildNotificationData(): array
    {
        // $this->prepareTokens();
        $notificationData = [
            'app_id' => $this->appId,
            'tokens' => $this->tokens,
            'type' => $this->type,
            'priority' => $this->priority,
            'payload' => [
                'title' => $this->title,
                'description' => $this->description,
                'icon' => $this->icon,
                'image' => $this->image,
                'data' => $this->data,
                'visible' => $this->isVisibleForUser,
                'action_type' => $this->actionType,
                'action' => $this->action,
                'auto_cancel' => $this->autoCancel,
                'channel_id' => $this->channelId,
                'package' => $this->package,
                'actions' => $this->actions
            ]
        ];
        if ($this->isOlderVersion == true) {
            $notificationData = array_merge($notificationData, [
                'notification' => [
                    'title' => $this->title,
                    'body' => $this->description
                ]
            ]);
        }
        return $notificationData;
    }

}

