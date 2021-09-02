<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_email');
            $table->string('sender_email');
            $table->string('subject');
            $table->string('body', 140);
            $table->timestamp('timestamp');
            $table->set('mailgun_status', ['delivered','permanent_fail','temporary_fail'])->nullable();
            $table->json('mailgun_payload')->nullable();
            $table->string('swift_message_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
