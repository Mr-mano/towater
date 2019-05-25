<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Utilisateur;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UtilisateurFixtures extends Fixture
{
   
    private $passwordEncoder;
        /**
        * UserFixtures constructor.
        * @param UserPasswordEncoderInterface $passwordEncoder
        */
        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
            $this->passwordEncoder = $passwordEncoder;
        }
        
        public function load(ObjectManager $manager)
        {
            $admin = new Utilisateur();
            $admin->setPassword($this->passwordEncoder->encodePassword($admin, '1234'));
            $admin->setNom('quere');
            $admin->setPrenom('mano');
            $admin->setEmail('mano.quere@orange.fr');
            $admin->setAdresse('rue du chat qui pête');
            $admin->setCodePostal('35000');
            $admin->setCommune('Rennes');
            $admin->setDepartement('Ile et Vilaine');
            $admin->setRoles(["ROLE_ADMIN"]);
            $manager->persist($admin);
            $this->addReference('admin', $admin);

            $user1 = new Utilisateur();
            $user1->setPassword($this->passwordEncoder->encodePassword($user1, '1234'));
            $user1->setNom('ménard');
            $user1->setPrenom('raoul');
            $user1->setEmail('raoul.menard@orange.fr');
            $user1->setAdresse('rue du gibolin');
            $user1->setCodePostal('56000');
            $user1->setCommune('Vannes');
            $user1->setDepartement('Morbihan');
            $user1->setRoles(["ROLE_USER"]);
            $manager->persist($user1);
            $this->addReference('user-1', $user1);

            $user2 = new Utilisateur();
            $user2->setPassword($this->passwordEncoder->encodePassword($user2, '1234'));
            $user2->setNom('Leglond');
            $user2->setPrenom('Stéphanie');
            $user2->setEmail('steph.leglond@orange.fr');
            $user2->setAdresse('rue du mouettes');
            $user2->setCodePostal('29000');
            $user2->setCommune('Brests');
            $user2->setDepartement('Finistère');
            $user2->setRoles(["ROLE_USER"]);
            $manager->persist($user2);
            $this->addReference('user-2', $user2);

            $manager->flush();
        }
    
}
