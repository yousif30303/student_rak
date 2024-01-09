<?php

namespace App\Notifications;

use App\Models\RegisterNotifi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermitRenewNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(protected $data)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'mail',
//            'database',
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Registeration' )
                    ->bcc(['yousif@saifbelhasagroup.com'])
            ->greeting('Dear All,')
            ->line('In regards to subject, Student has paid Learning permit renewal fee. Kindly find below details.')
            ->line('Registration No. :')
            ->line('Student Name : ')
            ->line('Kindly do the needful.');

//        return (new MailMessage)
//            ->subject('Learning Permit Renew - ' . $this->data->regnnumb)
//            ->bcc(['ahsan.mujtaba@saifbelhasagroup.com','yousif@saifbelhasagroup.com'])
//            ->markdown('mail.permitrenew', ['data' => $this->data]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
//
//    public function toDatabase($notifiable)
//    {
//        return PermitRenew::where('regnnumb', $this->data->get('regnnumb'))->where('docnumbr', $this->data->get('docnumbr'))->update(['emailsnd' => 'Y']);
//    }
}
