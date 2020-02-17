<?php


namespace Tests\Feature\Core;


use App\User;
use Illuminate\Foundation\Testing\Concerns\MakesHttpRequests;
use Tests\TestCase;

abstract class AuthenticatedTestCase extends TestCase
{
    protected $defaultHeaders = [
        'Accept' => 'application/x.bunker-maestro.v2+json'
    ];

    /** @var \App\User */
    protected $auth;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();

        $this->auth = factory(User::class)->create();
    }

    public function authenticate() {
        $this->actingAs($this->auth);
    }
}
