<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use phpDocumentor\Reflection\Types\Self_;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public const SEASONS = [
        'Saison1',
        'Saison2',
        'Saison3',
        'Saison4',
        'Saison5',
    ];

    public function load(ObjectManager $manager): void
    {

        foreach (Self::SEASONS as $key) {
            $saisons = new Season();

            $saisons->setNumber(5);

            $saisons->setYear(2002);

            $saisons->setDescription($key);

            $program =  $this->getReference('program_walking');

            $this->addReference('program_walking_' . $key , $saisons);
           
            $saisons->setProgram($program);

            $manager->persist($saisons);
        }
        
        
        foreach (Self::SEASONS as $key) {
            $saisons = new Season();

            $saisons->setNumber(5);

            $saisons->setYear(2002);

            $saisons->setDescription($key);

            $program =  $this->getReference('program_blackMirror');

            $this->addReference('program_blackMirror_' . $key , $saisons);
           
            $saisons->setProgram($program);

            $manager->persist($saisons);
        }

        foreach (Self::SEASONS as $key) {
            $saisons = new Season();

            $saisons->setNumber(5);

            $saisons->setYear(2002);

            $saisons->setDescription($key);

            $program =  $this->getReference('program_you');

            $this->addReference('program_you_' . $key , $saisons);

            $saisons->setProgram($program);

            $manager->persist($saisons);
        }

        foreach (Self::SEASONS as $key) {
            $saisons = new Season();

            $saisons->setNumber(5);

            $saisons->setYear(2002);

            $saisons->setDescription($key);

            $program =  $this->getReference('program_manifest');

            $this->addReference('program_manifest_' . $key , $saisons);

            $saisons->setProgram($program);

            $manager->persist($saisons);
        }

        foreach (Self::SEASONS as $key) {
            $saisons = new Season();

            $saisons->setNumber(5);

            $saisons->setYear(2002);

            $saisons->setDescription($key);

            $program =  $this->getReference('program_waywardPines');

            $this->addReference('program_waywardPines_' . $key , $saisons);

            $saisons->setProgram($program);

            $manager->persist($saisons);
        }

        $manager->flush();
    }
    public function getDependencies()

    {

        return [

            ProgramFixtures::class,

        ];
    }
}