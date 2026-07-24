<?php

namespace App\Services\Notifications;

use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;

class NotificationChannelRouter
{
    /**
     * @param  array<int, string>  $requestedChannels
     * @return array<int, string>
     */
    public function route(
        object $notifiable,
        array $requestedChannels,
        ?Notification $notification = null
    ): array {
        $drivers = [];

        foreach (array_unique($requestedChannels) as $channel) {
            $settings = config("notifications.channels.{$channel}", []);
            $driver = $settings['driver'] ?? null;

            if (! ($settings['enabled'] ?? false) || ! is_string($driver) || $driver === '') {
                continue;
            }

            if ($driver === 'mail' && ! $this->hasMailRoute($notifiable, $notification)) {
                continue;
            }

            $drivers[] = $driver;
        }

        return array_values(array_unique($drivers));
    }

    private function hasMailRoute(
        object $notifiable,
        ?Notification $notification
    ): bool {
        if (! method_exists($notifiable, 'routeNotificationFor')) {
            return false;
        }

        $route = $notifiable instanceof AnonymousNotifiable
            ? $notifiable->routeNotificationFor('mail')
            : $notifiable->routeNotificationFor('mail', $notification);

        return ! empty($route);
    }
}
