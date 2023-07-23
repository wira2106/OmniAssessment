<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        
        $subject = 'Welcome to Omni Assessment';
        $deskripsi = "Selamat Datang ".$this->user->name.". Proses Pendaftaran Email Anda (".$this->user->email.") telah berhasil, selamat menggunakan aplikasi ini. ";
        $url = url('/');
        return (new MailMessage)
                    ->view('mail.sendEmailUser',compact('subject','deskripsi','url'))
                    ->subject('Selamat Bergabung '.$this->user->name);
    }

    /*
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
