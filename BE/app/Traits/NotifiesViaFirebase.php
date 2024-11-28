<?php

namespace App\Traits;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\Notification;

use Throwable;

trait NotifiesViaFirebase{
    /**
     * Sends a Firebase notification to a list of device tokens or a topic.
     *
     * @param array $deviceTokens Array of device tokens to send notification to.
     * @param string|null $topic Topic to send notification to if specified.
     * @param string $title Title of the notification.
     * @param string $body Body text of the notification.
     * @param int|null $notificationId $body Body text of the notification.
     */
    public function sendFirebaseNotification(array  $deviceTokens, ?string $topic,
                                             string $title, string $body, ?int $notificationId = null): void
    {
        $image = "https://cloudlab.io.vn/assets/logo-DhSOuyQh.svg";
        $notificationData = [
            'title' => $title,
            'body' => $body,
            'image' => $image
        ];

        if ($notificationId !== null) {
            $notificationData['notificationId'] = $notificationId;
        }

        $message = CloudMessage::new()
            ->withNotification(Notification::create($title, $body, $image))
            ->withData($notificationData)
            ->withAndroidConfig(AndroidConfig::fromArray([
                'notification' => [
                    'sound' => 'default'
                ],
            ]))
            ->withApnsConfig(ApnsConfig::fromArray([
                'payload' => [
                    'aps' => [
                        'sound' => 'default'
                    ],
                ]
            ]));

        if ($topic) {
            $message = CloudMessage::withTarget('topic', $topic)
                ->withNotification([
                    'title' => $title,
                    'body' => $body,

                ]);
            $this->sendMessage($message);
        } else {
            foreach ($deviceTokens as $token) {
                $this->sendMessage($message->withChangedTarget('token', $token));
            }
        }
    }

    /**
     * Sends the message using Firebase messaging service.
     *
     * @param mixed $message The Firebase message object.
     */
    private function sendMessage(mixed $message): void
    {
        try {
            $factory = (new Factory)->withServiceAccount(base_path('firebase-credentials.json'));
            $messaging = $factory->createMessaging();
            $messaging->send($message);
            Log::info('Firebase notification sent successfully.');
        } catch (ConnectException $e) {
            Log::error('Network connection issue: Failed to send Firebase notification', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        } catch (RequestException $e) {
            Log::error('HTTP request issue: Failed to send Firebase notification', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        } catch (Throwable $e) {
            Log::error('Failed to send Firebase notification', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }
    }

}