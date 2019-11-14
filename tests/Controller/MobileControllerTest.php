<?php
// tests/Controller/MobileControllerTest.php
namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Mobile;

class MobileControllerTest extends WebTestCase
{
    /**
    * @var \Doctrine\ORM\EntityManager
    */
    private $entityManager;

    
    public function testGetMobiles()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/mobiles/');
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

    public function testPostMobile()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/mobiles/');
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

    public function testGetMobile()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/mobiles/{id}/');
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
        $crawler = $client->request('Delete', '/api/mobile/{id}/');
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