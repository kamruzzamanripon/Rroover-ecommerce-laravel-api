<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
//custom
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPasswordNotification extends Notification {
    use Queueable;
    protected $pageUrl;
    public $token;
    public static $toMailCallback;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $token ) {
        //parent::__construct( $token );
        $this->token = $token;
        //$this->pageUrl = 'localhost:8080';
        $this->pageUrl = env( 'Frontend_Reset_URL' );
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via( $notifiable ) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toMail( $notifiable ) {
        if ( static::$toMailCallback ) {
            return call_user_func( static::$toMailCallback, $notifiable, $this->token );
        }
        return ( new MailMessage )
            ->subject( 'Reset application Password v1' )
            ->line( 'You are receiving this email because we received a password reset request for your account.' )
            ->action( 'Reset Password', $this->pageUrl . "?token=" . $this->token )
            ->line( 'This password reset link will expire in :count minutes.', ['count' => config( 'auth.passwords.users.expire' )] )
            ->line( 'If you did not request a password reset, no further action is required.' );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray( $notifiable ) {
        return [
            //
        ];
    }
}
