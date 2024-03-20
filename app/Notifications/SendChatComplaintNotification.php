<?php

namespace App\Notifications;

use App\Channels\WhacenterChannel;
use App\Models\ChatPersonal;
use App\Models\Complaint;
use App\Services\WhacenterService;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendChatComplaintNotification extends Notification
{
    use Queueable;

     public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ChatPersonal $message)
    {
       $this->message = new \stdClass(); // Inisialisasi sebagai objek standar
    $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WhacenterChannel::class];
    }


    public function toWhacenter($notifiable)
    {

    $created_at = new DateTime($this->message->created_at);


    $hour = (int) $created_at->format('G');

    // Menentukan salam berdasarkan jam
    if ($hour >= 0 && $hour < 10) {
        $salam = "Selamat Pagi";
    } elseif ($hour >= 10 && $hour < 15) {
        $salam = "Selamat Siang";
    }
    elseif ($hour >= 15 && $hour < 18) {
        $salam = "Selamat Sore";
    } else {
        $salam = "Selamat Malam";
    }

    // Menggunakan salam yang sesuai dalam pesan
    return (new WhacenterService())
        ->to($this->message->users->nomer_wa)
        ->line("Halo, " . $salam)
        ->line("Dengan Nomer Keluhan : " .$this->message->complaint->nomer_keluhan)
        ->line("Link keluhan: https://bit.ly/sikpgap" )
        ->line(strip_tags($this->message->message))
        ->line("Mohon jangan Reply ke Nomer Wa ini.")
        ->line("Terimakasih.")
        ->line("*Pesan Otomatis dari Sistem Website SIK2P GAP");
    }
}
