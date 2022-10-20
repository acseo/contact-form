<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $m_userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->m_userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $adminUser = new User(); 
        $adminUser->setUsername("acseo");
        $adminUser->setRoles(["ROLE_ADMIN"]);
        $adminUser->setPassword($this->m_userPasswordHasher->hashPassword($adminUser, "acseo"));
        $manager->persist($adminUser);
        $manager->flush();
    }
}
