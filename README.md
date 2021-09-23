# Behamin Notification

Behamin standard format for sending notification

## Installation
1. Install the package with composer
```bash
composer require behamin/bresources
```
2. publish package config file
```bash
php artisan vendor:publish --provider="Behamin\Notification\Providers\BehaminNotificationProvider" --tag="config"
```

## Usage

Just call Notification facade, set data you like and use build method to get notification data

```php
use Behamin\Notification\Facades\Notification;

Notification::title('hello')
    ->data("data")
    ->description("description")
    ->icon("https://www.google.nl/images/branding/googlelogo/2x/googlelogo_light_color_272x92dp.png")
    ->image("https://www.google.nl/images/branding/googlelogo/2x/googlelogo_light_color_272x92dp.png")
    ->type(Notification::TYPE_DATA)
    ->action(Notification::ACTION_OPEN_APP, "")
    ->priority(Notification::PRIORITY_NORMAL)
    ->isVisibleForUser(true)
    ->autoCancel(false)
    ->addButton("new button", Notification::ACTION_OPEN_APP, "")
    ->build("token1", "token2");
```

## Output

```php
$expectedArray = [
    "app_id" => "0",
    "tokens" => [
        "token1",
        "token2",
    ],
    "type" => "data",
    "priority" => "normal",
    "payload" => [
        "title" => "hello",
        "description" => "description",
        "icon" => "https://www.google.nl/images/branding/googlelogo/2x/googlelogo_light_color_272x92dp.png",
        "image" => "https://www.google.nl/images/branding/googlelogo/2x/googlelogo_light_color_272x92dp.png",
        "data" => "data",
        "visible" => true,
        "action_type" => 0,
        "action" => "",
        "auto_cancel" => false,
        "channel_id" => "test",
        "package" => "com.package.app",
        "actions" => [
            [
                "title" => "new button",
                "action_type" => 0,
                "action" => "",
            ]
        ]
    ],
    "notification" => [
        "title" => "hello",
        "body" => "description",
    ]
];
```