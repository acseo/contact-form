<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AdminUsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $adminUser = new User();
        $adminUser->setEmail('admin@admin.fr');
        $adminUser->setPassword('$2y$13$kpaF4U7j9LOKFG/32T7iL.hSUGVgKzoZHEWFn19f3rfKq6Vc5Au5S');
        $adminUser->setRoles(array('ROLE_ADMIN'));
        $manager->persist($adminUser);
        $manager->flush();

    }
}
