<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class DBNotify extends Notification
{
    use Queueable;


    public function __construct(public string $text)
    {
        $this->afterCommit();
    }

    public function via(object $notifiable): array
    {
        Log::debug(__CLASS__, [$notifiable]);
        return ['database'];
    }

    public function afterSending(object $notifiable, string $channel, mixed $response): void
    {
        Log::debug(__METHOD__, [$response]);
    }

    public function toArray()
    {
        return [
            'text' => $this->text
        ];
    }

    public function toDatabase()
    {
        return [
            'text' => $this->text,
            'with_to_database' => true
        ];
    }
}
