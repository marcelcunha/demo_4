<?php

use App\Models\Book;
use App\Models\User;

it('should not display book if not authenticated', function () {

    $response = $this->get(route('books.show', 1));

    $response->assertStatus(302)->assertRedirect(route('login'));
});

it('should display book if authenticated', function () {
    $book = Book::factory()->create(['id' => 1]);
    $response = $this->actingAs(User::factory()->create())
        ->get(route('books.show', 1));

    $response->assertStatus(200)->assertSee($book->title);
});

it(
    'should not display book if book not exists',
    function () {

        $response = $this->actingAs(User::factory()->create())
            ->get(route('books.show', 1));

        $response->assertStatus(404);
    }
);
