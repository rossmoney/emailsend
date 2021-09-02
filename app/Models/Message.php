<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $fillable = ['recipient_email', 'sender_email', 'subject', 'body', 'timestamp', 'mailgun_status', 'mailgun_payload', 'swift_message_id', 'created_at', 'updated_at'];
}
