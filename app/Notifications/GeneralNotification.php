<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class GeneralNotification extends Notification
{
    use Queueable;

    private $title;
    private $message;

    public function __construct($title, $message) {
        $this->title = $title;
        $this->message = $message;
    }

    public function via($notifiable) {
        return ['database', 'mail']; // Stores in DB & sends email
    }

    public function toMail($notifiable) {
        return (new MailMessage)
            ->subject($this->title)
            ->line($this->message)
            ->action('View Dashboard', url('/dashboard'))
            ->line('Thank you for using our LMS!');
    }

    public function toArray($notifiable) {
        return [
            'title' => $this->title,
            'message' => $this->message
        ];
    }
}
