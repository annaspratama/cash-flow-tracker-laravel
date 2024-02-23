<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class ForgotPasswordNotification extends Notification
{
    use Queueable;
    
    public string $url;

    /**
     * Create a new notification instance.
     * 
     * @param string @url
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject(subject: "Recover Your Password")
                    ->line("Dear {$notifiable->fullname},")
                    ->line(line: "We have received a request to reset the password associated with your account.")
                    ->line(line: "To proceed with the password reset process, please click the link below:")
                    ->action(text: "Recover Password", url: $this->url)
                    ->line(line: "If you did not request this password reset, you can safely ignore this email. Your account remains secure.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * Generate URL for recover password.
     *
     * @param mixed $notifiable
     * @return string
     */
    // protected function recoverPasswordUrl(mixed $notifiable)
    // {
    //     return URL::temporarySignedRoute(
    //         'password.reset', // Route name for recover password
    //         Carbon::now()->addMinutes(value: Config::get('auth.verification.expire', 60)), // URL expire time
    //         [
    //             'id' => $notifiable->getKey(), // User ID
    //             'hash' => sha1($notifiable->getEmailForVerification()), // Email hash
    //         ]
    //     );
    // }
}
