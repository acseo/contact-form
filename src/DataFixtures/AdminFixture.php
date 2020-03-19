<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $admin = (new Admin())
        ->setEMail('admin@acsios.com');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
             'toto' . $admin->getSalt()
         ));

        $manager->persist($admin);
        $manager->flush();
    }
}
