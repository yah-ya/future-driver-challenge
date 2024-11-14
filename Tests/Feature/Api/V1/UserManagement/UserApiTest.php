<?php
// tests/UserManagement/UserApiTest.php
namespace App\Tests\UserManagement;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Factory\UserFactory;

class UserApiTest extends ApiTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = self::createClient();
    }

    public function testCGetListOfUsers()
    {
        UserFactory::createMany(10);
        $response = static::createClient()->request('GET', 'api/users');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/ld+json; charset=utf-8');
    }

    public function testGetUser()
    {
        $response = $this->client->request('GET', 'http://localhost/api/users/1');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function testDeleteUser()
    {
        $response = $this->client->request('DELETE', 'http://localhost/api/users/1');

        $this->assertEquals(204, $response->getStatusCode()); // Check for successful deletion
    }
}
