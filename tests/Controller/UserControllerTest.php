<?php
// tests/Controller/UserControllerTest.php
namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class UserControllerTest extends WebTestCase
{
    /**
    * @var \Doctrine\ORM\EntityManager
    */
    private $entityManager;

    
    public function testGetUsers()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/users/');
        // Premier test
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
        //Deuxième test
        // asserts that the "Content-Type" header is "application/json"
        $this->assertTrue
        (
            $client->getResponse()->headers->contains
            (
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
        
        //Troisième test: asserts that the response content contains a string
        $this->assertContains('JWT Token not found', $client->getResponse()->getContent());
        
        //Quatrième test: asserts a specific 401 status code
        $this->assertEquals
        (
            401, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );
        
    }

    public function testPostUser()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/users/');
        // Premier test
        $this->assertEquals(401, $client->getResponse()->getStatusCode());
        //Deuxième test
        // asserts that the "Content-Type" header is "application/json"
        $this->assertTrue
        (
            $client->getResponse()->headers->contains
            (
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
        
        //Troisième test: asserts that the response content contains a string
        $this->assertContains('JWT Token not found', $client->getResponse()->getContent());
        
        //Quatrième test: asserts a specific 401 status code
        $this->assertEquals
        (
            401, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

    }

    public function testGetUser()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/users/{id}/');
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        //Deuxième test
        // asserts that the "Content-Type" header is "application/json"
        $this->assertTrue
        (
            $client->getResponse()->headers->contains
            (
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
        
        //Troisième test: asserts that the response content contains a string
        $this->assertContains('Redirecting to', $client->getResponse()->getContent());
        
        //Quatrième test: asserts a specific 401 status code
        $this->assertEquals
        (
            302, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

    }

    public function testDeleteMobile()
    {
        $client = static::createClient();
        $crawler = $client->request('Delete', '/api/user/{id}/');
        // Premier test
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
        //Deuxième test
        // asserts that the "Content-Type" header is "application/json"
        $this->assertTrue
        (
            $client->getResponse()->headers->contains
            (
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
        
        //Troisième test: asserts that the response content contains a string
        $this->assertContains('Redirecting to', $client->getResponse()->getContent());
        
        //Quatrième test: asserts a specific 401 status code
        $this->assertEquals
        (
            302, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

    }


}