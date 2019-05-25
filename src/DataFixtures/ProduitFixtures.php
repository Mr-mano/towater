<?php

namespace App\DataFixtures;



use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProduitFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $canoe = new Produit();
        $canoe->setUtilisateur($this->getReference('admin'));
        $canoe->setCategorie($this->getReference('categorie-1'));
        $canoe->setLibelle('Canoe de pêche');
        $canoe->setPhoto('photo-1.jpg');
        $canoe->setDateCreation(new \DateTime('2019-01-11'));
        $canoe->SetDateVente(new \DateTime('2019-02-08'));
        $canoe->SetPrix('450');
        $canoe->setMiseEnAvant('false');
        $canoe->SetDescription('Un beau canoë presque neuf');
        $manager->persist($canoe);
        $this->addReference('produit-1', $canoe);

        $cannemouche = new Produit();
        $cannemouche->setUtilisateur($this->getReference('user-1'));
        $cannemouche->setCategorie($this->getReference('categorie-2'));
        $cannemouche->setLibelle('Canne à mouche');
        $cannemouche->setPhoto('photo-2.jpg');
        $cannemouche->setDateCreation(new \DateTime('2019-02-18'));
        $cannemouche->SetDateVente(new \DateTime('2019-02-25'));
        $cannemouche->SetPrix('25');
        $cannemouche->setMiseEnAvant('false');
        $cannemouche->SetDescription('Une belle canne à mouche');
        $manager->persist($cannemouche);
        $this->addReference('produit-2', $cannemouche);

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            ProduitCategorieFixtures::class, UtilisateurFixtures::class,
        );
    }
}