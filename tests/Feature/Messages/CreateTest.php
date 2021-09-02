<?php
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
 
uses(RefreshDatabase::class);
 
beforeEach(fn () => User::factory()->create());

test('can view messages create page', function () {
    $user = User::factory()->create(['name' => 'Ross Money', 'email' => 'ross.money@gmx.com']);

    actingAs($user)->get('/')->assertSee('Your message here...');
});