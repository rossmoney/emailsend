<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\User;

class MessageMailable extends Mailable
{
    use Queueable, SerializesModels;

    private $sender;
    private $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $sender, string $subject, string $message)
    {
        $this->sender = $sender;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->sender->email)
                    ->subject($this->subject)
                    ->view('mail.message')
                    ->with('name', $this->sender->name)
                    ->with('messageBody', $this->message);
    }
}
