<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 35; $i++){
            $article = new Article();
            $article
                ->setUtilisateur($this->getReference($faker->randomElement($array = array ('user-1','user-2','admin'))))
                ->setLibelle($faker->words(3, true))
                ->setTexte($faker->text($maxNbChars = 450))
                ->setNokill($faker->numberBetween(0,1));
            $manager->persist($article);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            AlbumFixtures::class, UtilisateurFixtures::class,
        );
    }
}
