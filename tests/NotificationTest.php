<?php


namespace Behamin\Notification\Tests;


use Behamin\Notification\Facades\Notification;

use function PHPUnit\Framework\assertEquals;

class NotificationTest extends TestCase
{
    public function test_notificationData_correct()
    {
        $expectedJson = [
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


        $data = Notification::title('hello')
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

        assertEquals($expectedJson, $data);
    }
}