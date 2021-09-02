<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Jobs\SendEmail;

class ContactForm extends Component
{
    public $email;
    public $message;
    public $success;
    protected $rules = [
        'email' => 'required|email',
        'message' => 'required|max:140',
    ];

    public function contactFormSubmit()
    {
        $contact = $this->validate();

        $user = Auth::user();
        if (!empty($user))
        {
            $subject = 'New Message from ' . $user->name;

            dispatch(new SendEmail(sender: $user, recipientEmail: $this->email, subject: $subject, message: $this->message));
        }

        $this->success = 'Thank you for reaching out to us!';

        $this->clearFields();
    }

    private function clearFields()
    {
        $this->name = '';
        $this->email = '';
        $this->comment = '';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}