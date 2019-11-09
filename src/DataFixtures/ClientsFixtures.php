<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ClientsFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $admin_client = new Client();
        $admin_client->setName('admi');
        $admin_client->setEmail('admin@attineos.com');
        $admin_client->setPassword($this->passwordEncoder->encodePassword(
            $admin_client,
            'admin'
        ));
        $admin_client->setRoles(array('ROLE_SUPER_ADMIN'));
        $manager->persist($admin_client);

        $classic_client = new Client();
        $classic_client->setName('use');
        $classic_client->setEmail('user@attineos.com');
        $classic_client->setPassword($this->passwordEncoder->encodePassword(
            $classic_client,
            'user'
        ));
        $classic_client->setRoles(array('ROLE_USER'));
        $manager->persist($classic_client);

        $manager->flush();
    }
}
