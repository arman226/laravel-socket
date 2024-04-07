# A Proof of Concept of a Laravel Server Project with Real time communication Service using Firebase

## Install Pusher

```bash
composer require pusher/pusher-php-server
```

## Configure Pusher

.env

```.env
 BROADCAST_DRIVER=pusher
 PUSHER_APP_ID=your_pusher_app_id
 PUSHER_APP_KEY=your_pusher_app_key
 PUSHER_APP_SECRET=your_pusher_app_secret
 PUSHER_APP_CLUSTER=your_pusher_app_cluster
```

## Create Notification

Generate a notification using Laravel’s artisan command:

```bash
php artisan make:notification NewNotification
```

## Modify Notification vehicle

```php
    public function via(object $notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'This is a sample push notification!',
        ]);
    }

```
