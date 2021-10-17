<?php

namespace Behamin\Notification;

class NotificationBuilder
{
    private ?string $title = null;
    private int $appId;
    private ?string $description = null;
    private ?string $icon;
    private ?string $image = null;
    private ?string $data = null;
    private string $package;
    private bool $isVisibleForUser = true;
    private ?int $actionType = null;
    private ?string $action = null;
    private bool $autoCancel = true;
    private array $actions = array();
    private string $channelId;
    private string $type;
    private string $priority;
    private ?string $sendAt = null;
    private array $tokens = array();
    private bool $isOlderVersion;

    public function __construct()
    {
        $this->package = config('notification.package');
        $this->channelId = config('notification.channel_id');
        $this->priority = config('notification.priority');
        $this->icon = config('notification.icon');
        $this->type = config('notification.type');
        $this->appId = config('notification.app_id');
        $this->isOlderVersion = config('notification.is_older_version');
    }

    /**
     * @param  string  $icon
     * @return $this
     */
    public function icon(string $icon): NotificationBuilder
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @param  string  $data
     * @return $this
     */
    public function data(string $data): NotificationBuilder
    {
        $this->data = $data;
        return $this;
    }


    /**
     * @param  bool  $isVisible
     * @return $this
     */
    public function isVisibleForUser(bool $isVisible): NotificationBuilder
    {
        $this->isVisibleForUser = $isVisible;
        return $this;
    }

    /**
     * @param  int  $actionType
     * @param  string  $action
     * @return $this
     */
    public function action(int $actionType, string $action): NotificationBuilder
    {
        $this->actionType = $actionType;
        $this->action = $action;
        return $this;
    }

    /**
     * @param  bool  $autoCancel
     * @return $this
     */
    public function autoCancel(bool $autoCancel): NotificationBuilder
    {
        $this->autoCancel = $autoCancel;
        return $this;
    }

    /**
     * @param  string  $title
     * @param  int  $actionType
     * @param  string  $action
     * @return $this
     */
    public function addButton(string $title, int $actionType, string $action): NotificationBuilder
    {
        $this->actions[] = [
            'title' => $title,
            'action_type' => $actionType,
            'action' => $action
        ];
        return $this;
    }

    /**
     * @param  string  $priority
     * @return $this
     */
    public function priority(string $priority): NotificationBuilder
    {
        $this->priority = $priority;
        return $this;
    }

    public function sendAt(string $sendAt): NotificationBuilder {
        $this->sendAt = $sendAt;
        return $this;
    }

    /**
     * @param $type
     * @return $this
     */
    public function type($type): NotificationBuilder
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param  string  $image
     * @return $this
     */
    public function image(string $image): NotificationBuilder
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @param  string  $title
     * @return $this
     */
    public function title(string $title): NotificationBuilder
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param  string  $description
     * @return $this
     */
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
        if (is_array(func_get_arg(0))) {
            $this->tokens = func_get_arg(0);
        } else {
            $this->tokens = array(func_get_arg(0));
        }
        return $this->buildNotificationData();
    }

    /**
     * @return array
     */
    private function buildNotificationData(): array
    {
        $notificationData = [
            'app_id' => $this->appId,
            'tokens' => $this->tokens,
            'type' => $this->type,
            'priority' => $this->priority,
            'scheduled_at' => $this->sendAt,
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

