<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;

use Carbon\Carbon;

use App\Models\Message;

class MailgunWebhookHandle implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $payload = $this->webhookCall->payload;

        $message = Message::where('subject', $payload['event-data']['message']['headers']['subject'])
                ->where('recipient_email', $payload['event-data']['recipient'])
                ->whereBetween('timestamp', [Carbon::now()->subMinutes(5)->format('Y-m-d H:i:s'), Carbon::now()->format('Y-m-d H:i:s')])
                ->first();

        if (!empty($message)) {
            $message->mailgun_status = $payload['event-data']['event'];
            if ($payload['event-data']['event'] == 'failed')
            {
                $message->mailgun_status = $payload['event-data']['severity'] . '_fail';
            }
      
            $message->mailgun_payload = json_encode($payload);
            $message->timestamp = Carbon::parse($payload['event-data']['timestamp'])->format('Y-m-d H:i:s');
            $message->save();
        }

    }
}