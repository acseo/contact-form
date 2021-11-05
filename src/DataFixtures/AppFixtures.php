<?php

namespace App\DataFixtures;

use App\Entity\ContactMessage;
use App\Entity\ContactUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact1 = new ContactUser();
        $contact1->setEmail('test1@test1.fr');
        $contact1->setCreatedAt(new \DateTimeImmutable());

        $contact2 = new ContactUser();
        $contact2->setEmail('test2@test2.fr');
        $contact2->setCreatedAt(new \DateTimeImmutable());

        $contactMessage1 = new ContactMessage();
        $contactMessage1->setName('John Doe');
        $contactMessage1->setMessage('Est ce que vous livrez à domicile ?');
        $contactMessage1->setContactUser($contact1);

        $contactMessage2 = new ContactMessage();
        $contactMessage2->setName('Mirabelle Jones');
        $contactMessage2->setMessage('Est ce que vous faites vraiment une pizza à l\'ananas ?');
        $contactMessage2->setContactUser($contact1);

        $contactMessage3 = new ContactMessage();
        $contactMessage3->setName('Samantha prime');
        $contactMessage3->setMessage('Pourquoi les girafes ont un long cou ?');
        $contactMessage3->setProcessed(1);
        $contactMessage3->setContactUser($contact2);

        $manager->persist($contactMessage1);
        $manager->persist($contactMessage2);
        $manager->persist($contactMessage3);
        $manager->flush();
    }
}
