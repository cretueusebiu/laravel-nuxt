<?php


namespace Tests\Feature\Users;


use App\User;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Support\Str;
use PHPUnit\Framework\Assert as PHPUnit;
use Tests\Feature\Core\AuthenticatedTestCase;
use Tests\TestCase;

class TestIndex extends AuthenticatedTestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_cannot_access_if_not_authenticated()
    {
        $response = $this->get("/api/users");
        $response->assertUnauthorized();
    }

    public function test_default_page_length_is_10()
    {
        factory(User::class, 20)->create();
        $this->authenticate();
        $response = $this->get("/api/users");
        $response->assertSuccessful();
        $data = $response->json('data');
        $this->assertIsArray($data);
        $this->assertCount(10, $data);
        $this->assertequals(21, $response->json('meta.pagination.total'), 'total users available shows 20 + current auth user');
        $this->assertequals(10, $response->json('meta.pagination.per_page'), "metadata indicates items displayed per page");
        $this->assertequals(1, $response->json('meta.pagination.current_page'), "we are at page 1");
    }

    public function test_it_shows_user_data()
    {
        $this->authenticate();
        $response = $this->get("/api/users");
        $response->assertSuccessful();

        // the only user in the database should be the current authenticated user
        // check that the data returned matches what we expect from the api
        $this->assertequals($this->auth->id, $response->json('data.0.id'));
        $this->assertequals('users', $response->json('data.0.type'));
        $this->assertequals($this->auth->name, $response->json('data.0.attributes.name'));
        $this->assertequals($this->auth->email, $response->json('data.0.attributes.email'));


    }
}
