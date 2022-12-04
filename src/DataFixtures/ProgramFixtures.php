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
        $this->addReference('program_walking', $program);
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);
        

        $program = new Program();
        $program->setTitle('Black Mirror');
        $program->setSynopsis('chaque épisode a un casting, un décor et une réalité différente.');
        $this->addReference('program_blackMirror', $program);
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        
        $program = new Program();
        $program->setTitle('You');
        $program->setSynopsis('Une jeune femme est un véritable coup de foudre pour Joe qui décide de la retrouver sur Internet.');
        $this->addReference('program_you', $program);
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
       

        $program = new Program();
        $program->setTitle('Manifest');
        $program->setSynopsis('Un vol commercial, qui relie la Jamaïque aux Etats-Unis, fait face à de fortes turbulences mais parvient à rallier sa destination sans dommage.');
        $this->addReference('program_manifest', $program);
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        

        $program = new Program();
        $program->setTitle('Wayward Pines');
        $program->setSynopsis('Il doit enquêter sur la mystérieuse disparition de deux agents fédéraux.');
        $this->addReference('program_waywardPines', $program);
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
