<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Database data
     */
    public function toArray($notifiable): array
    {
        return [
            'type' => 'order',
            'message' => 'New order #' . $this->order->id,
            'order_id' => $this->order->id,
        ];
    }
}