<?php

namespace App\DataFixtures;



use App\Entity\ProduitCategorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProduitCategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $embarcation = new ProduitCategorie();
        $embarcation->setLibelle('Embarcation');
        $manager->persist($embarcation);
        $this->addReference('categorie-1', $embarcation);

        $canne = new ProduitCategorie();
        $canne->setLibelle('Canne à pêche');
        $manager->persist($canne);
        $this->addReference('categorie-2', $canne);

        $moulinet = new ProduitCategorie();
        $moulinet->setLibelle('Moulinet');
        $manager->persist($moulinet);
        $this->addReference('categorie-3', $moulinet);

        $manager->flush();
    }

}