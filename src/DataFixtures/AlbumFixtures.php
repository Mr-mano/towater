<?php

namespace App\DataFixtures;


use App\Entity\Album;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AlbumFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $Album1 = new Album();
        $Album1->setUtilisateur($this->getReference('admin'));
        $Album1->setTitre('Vacance en Irlande');
        $manager->persist($Album1);
        $this->addReference('album-1', $Album1);

        $Album2 = new Album();
        $Album2->setUtilisateur($this->getReference('user-1'));
        $Album2->setTitre('Pêche aux brochets');
        $manager->persist($Album2);
        $this->addReference('album-2', $Album2);

        $Album3 = new Album();
        $Album3->setUtilisateur($this->getReference('user-1'));
        $Album3->setTitre('Pêche à la mouche');
        $manager->persist($Album3);
        $this->addReference('album-3', $Album3);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UtilisateurFixtures::class,
        );
    }

}