<?php
use function Pest\Livewire\livewire;

use App\Http\Livewire\ContactForm;

test('contact form can be submitted', function () {
    livewire(ContactForm::class)
        ->set('email', 'ross.money@gmx.com')
        ->set('message', 'test from pest')
        ->call('contactFormSubmit')
        ->assertSee('Thank you for reaching out to us!');
});