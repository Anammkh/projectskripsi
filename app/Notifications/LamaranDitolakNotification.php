<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LamaranDitolakNotification extends Notification
{
    use Queueable;

    public $lamaran;

    public function __construct($lamaran)
    {
        $this->lamaran = $lamaran;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Maaf, lamaran Anda ditolak.',
            'type' => 'danger',
        ];
    }
}

