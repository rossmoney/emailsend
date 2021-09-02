<?php
use function Pest\Livewire\livewire;

use App\Http\Livewire\ContactForm;

test('contact form can be rendered', function () {
    livewire(ContactForm::class)
        ->call('render')
        ->assertSee('Email Address');
});