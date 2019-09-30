<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $user_client = new User();
        $user_client->setFirstName('dave');
        $user_client->setName('davi');
        $user_client->setEmail('dave@attineos.com');
        $user_client->setPassword($this->passwordEncoder->encodePassword(
            $user_client,
            'admin'
        ));
        $user_client->setCountry('France');
        $user_client->setCity('Paris');
        $user_client->setAdresse('6 rue Champs de Mars');
        $user_client->setZipCode('7508');
        $user_client->setClient(23);
        $manager->persist($user_client);

        $use_client = new User();
        $use_client->setFirstName('Gerard');
        $use_client->setName('Goutte');
        $use_client->setEmail('Gerard@attineos.com');
        $use_client->setPassword($this->passwordEncoder->encodePassword(
            $use_client,
            'admin'
        ));
        $use_client->setCountry('France');
        $use_client->setCity('Paris');
        $use_client->setAdresse('18 rue Champs de Mars');
        $use_client->setZipCode('7508');
        $use_client->setClient(23);
        $manager->persist($use_client);

        $manager->flush();
    }
}