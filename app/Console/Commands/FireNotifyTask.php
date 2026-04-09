<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\DBNotify;
use App\Notifications\TaskStatus;
use Database\Factories\UserFactory;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

#[Signature('fire:db-notify {text}')]
class FireNotifyTask extends Command
{
    public function handle()
    {
        $user = User::factory()->create();
        Notification::sendNow($user, new DBNotify($this->argument('text')));
    }
}
