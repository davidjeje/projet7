<?php
// tests/Controller/ClientControllerTest.php
namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Client;

class ClientControllerTest extends WebTestCase
{
    /**
    * @var \Doctrine\ORM\EntityManager
    */
    private $entityManager;

    
    public function testGetClients()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/clients/');
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

    public function testLoginClient()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/login_check/');
        // Premier test
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
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
        //$this->assertContains('token', $client->getResponse()->getContent());
        
        //Quatrième test: asserts a specific 201 status code
        $this->assertEquals
        (
            201, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

        /*$form = $crawler->selectButton('Execute')->form();

        // set some values
        $form['username'] = 'user@attineos.com';
        $form['password'] = 'user';

        // submit the form
        $crawler = $client->Execute($form);*/

        //$crawler = $client->submitForm('validate', ['username' => 'user@attineos.com']);
        // submits a form directly (but using the Crawler is easier!)
        $client->request('POST', '/submit', ['username' => 'user@attineos.com']);

        // submits a raw JSON string in the request body
        $client->request
        (
            'POST',
            '/submit',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"username":"user@attineos.com"}'
        );


    }

    public function testPostClient()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/clients/');
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

    public function testGetClient()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/clients/{id}');
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
        $crawler = $client->request('Delete', '/api/clients/{id}');
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