<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorkingCorrectly()
    {
        # Act
        $response = $this->get('/');

        # Assert
        # Checking for visible text on the screen
        $response->assertSeeText('Welcome to the laravel !');
        $response->assertSeeText('This is a blog website.');
    }

    public function testContactPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');
        $response->assertSeeText('Contact Page');
    }
}
