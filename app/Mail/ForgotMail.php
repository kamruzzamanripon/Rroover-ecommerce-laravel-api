<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotMail extends Mailable {
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $token ) {
        $this->data = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $data = $this->data;
        return $this->from( "ripon@gmail.com" )->view( 'mail.forgot', compact( 'data' ) )->subject( 'Password Reset Link' );
    }
}
