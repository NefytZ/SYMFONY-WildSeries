<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('Walking Dead');
        $program->setSynopsis('Des zombies envahissent la terre.');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        

        $program = new Program();
        $program->setTitle('Black Mirror');
        $program->setSynopsis('chaque épisode a un casting, un décor et une réalité différente.');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        
        $program = new Program();
        $program->setTitle('You');
        $program->setSynopsis('Une jeune femme est un véritable coup de foudre pour Joe qui décide de la retrouver sur Internet.');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
       

        $program = new Program();
        $program->setTitle('Manifest');
        $program->setSynopsis('Un vol commercial, qui relie la Jamaïque aux Etats-Unis, fait face à de fortes turbulences mais parvient à rallier sa destination sans dommage.');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        

        $program = new Program();
        $program->setTitle('Wayward Pines');
        $program->setSynopsis('Il doit enquêter sur la mystérieuse disparition de deux agents fédéraux.');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}
