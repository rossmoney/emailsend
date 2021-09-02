<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Message;
use App\Models\User;

class MessageMailable extends Mailable
{
    use Queueable, SerializesModels;

    private $sender;
    private $message;
    private $messageRecord;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $sender, string $subject, string $message, Message $messageRecord)
    {
        $this->sender = $sender;
        $this->subject = $subject;
        $this->message = $message;
        $this->messageRecord = $messageRecord;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $messageRecord = $this->messageRecord;

        return $this->from($this->sender->email)
                    ->subject($this->subject)
                    ->view('mail.message')
                    ->with('name', $this->sender->name)
                    ->with('messageBody', $this->message)
                    ->withSwiftMessage(function ($message) use (&$messageRecord){
                        $messageRecord->swift_message_id = $message->getId();
                        $messageRecord->save();
                    });
    }
}
