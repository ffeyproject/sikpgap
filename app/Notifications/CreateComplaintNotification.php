<?php

namespace App\Notifications;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateComplaintNotification extends Notification
{
    use Queueable;

    public $complaint;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Complaint $complaint)
    {
        $this->complaint = $complaint;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('keluhan/show/'.$this->complaint->id);

        return (new MailMessage)
                ->from('it@gajahtex.com', 'IT GAP')
                ->subject('Success Sent Data Complaint')
                ->greeting('Data Complaint A.N : ' . $this->complaint->nama_marketing)
                ->line('Nomer Keluhan Anda : ' . $this->complaint->nomer_keluhan)
                ->line('Tanggal Keluhan Anda : ' . $this->complaint->tgl_keluhan)
                ->line('Nama Buyer Anda : ' . $this->complaint->buyer->nama_buyer)
                ->line('Nomer Wo : ' . $this->complaint->no_wo)
                ->line('Jenis : ' . $this->complaint->jenis)
                ->line('Masalah : ' . $this->complaint->masalah)
                ->action('View Data Complaint', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}