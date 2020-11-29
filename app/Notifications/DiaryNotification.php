<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DiaryNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if ($notifiable->service=="consulta-virtual") {
            return (new MailMessage)
                    ->subject('Consulta Médica')
                    ->greeting('Hola')
                    ->line('Gracias por agendar su consulta medica para el día '.date('d-m-Y', strtotime($notifiable->diary->date)).', a la hora '.date('H:i a', strtotime($notifiable->diary->time)).' con el médico '.$notifiable->doctor->name.' '.$notifiable->doctor->first_lastname.' '.$notifiable->doctor->second_lastname)
                    ->line('Para asistir a su consulta a la hora agendada ingrese a la siguiente plataforma:')
                    ->action('Ingresar', $notifiable->doctor->doctor->diary_doctor->url)
                    ->salutation('Saludos, '.config('app.name'));
        } else {
            return (new MailMessage)
                    ->subject('Consulta Médica')
                    ->greeting('Hola')
                    ->line('Hola, gracias por agendar su consulta medica para el día '.date('d-m-Y', strtotime($notifiable->diary->date)).', a la hora '.date('H:i a', strtotime($notifiable->diary->time)).' con el médico '.$notifiable->doctor->name.' '.$notifiable->doctor->first_lastname.' '.$notifiable->doctor->second_lastname)
                    ->salutation('Saludos, '.config('app.name'));
        }
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
