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

## Create an Event

```bash
php artisan make:event UserRegistration
```

### Create a channel inside the event

```php
  public function broadcastOn()
  {
      return new Channel("notifications");

  }
```

### set a return value once the event channel is triggered using broadcast With

```php
 public function broadcastWith(){
    return [$this->message]; // array
  }


```

## create an api endpoint that will serve as trigger for the created event

### Either do it this way

```php
Route::post('/fight', function(Request $request){
 try{

$options = array(
    'cluster' => 'PUSHER_APP_CLUSTER',
    'useTLS' => true
  );
  $pusher = new Pusher(
    'PUSHER_APP_KEY',
    'PUSHER_APP_SECRET',
    'PUSHER_APP_ID',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('my-channel', 'my-event', $data);
  return "success"
}
  catch(Exception $e){
    return $e->getMessage();
  }
});
```

### or this way

```php
Route::post('/fight', function(Request $request){
 try{
   $rev= event(new UserRegistration('test'));
  return $rev;
}
  catch(Exception $e){
    return $e->getMessage();
  }
});
```
