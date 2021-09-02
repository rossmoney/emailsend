<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\RateLimitedMiddleware\RateLimited;

use Carbon\Carbon;

use App\Mail\MessageMailable;

use App\Models\Message;
use App\Models\User;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $sender;
    private $recipientEmail;
    private $subject;
    private $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $sender, string $recipientEmail, string $subject, string $message)
    {
        $this->sender = $sender;
        $this->recipientEmail = $recipientEmail;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //try 
        //{
            $messageRecord = Message::create([
                'recipient_email' => $this->recipientEmail,
                'sender_email' => $this->sender->email, 
                'subject' => $this->subject,
                'body' => $this->message,
                'timestamp' => Carbon::now()->format('Y-m-d H:i')
            ]);
            
            Mail::to($this->recipientEmail)
                ->send(new MessageMailable($this->sender, $this->subject, $this->message, $messageRecord));

       // } catch (\Exception $e) {
           // if (!empty($messageRecord))
           //     $messageRecord->update(['mailgun_status' => 'permanent_fail']);
        //}

    }

    public function middleware()
    {
        $rateLimitedMiddleware = (new RateLimited())
            ->allow(1)
            ->everySeconds(15)
            ->releaseAfterSeconds(300);
            
        return [$rateLimitedMiddleware];
    }
}
