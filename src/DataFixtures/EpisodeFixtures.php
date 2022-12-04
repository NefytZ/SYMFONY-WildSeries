<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\DataFixtures\SeasonFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public const EPISODE = [
        'Episode 1',
        'Episode 2',
        'Episode 3',
        'Episode 4',
        'Episode 5',
        'Episode 6',
        'Episode 7',
        'Episode 8',
        'Episode 9',
        'Episode 10',
    ];

    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i < 5; $i++) {
            foreach (self::EPISODE as $key) {
                $episode = new Episode();

                $episode->setTitle($key);

                $episode->setNumber('1');

                $episode->setSynopsis('Synopsis bientot disponible');

                $episode->setSeason($this->getReference('program_walking_Saison' . $i));

                $manager->persist($episode);
            }
        }

        for ($i = 1; $i < 5; $i++) {
            foreach (self::EPISODE as $key) {
                $episode = new Episode();

                $episode->setTitle($key);

                $episode->setNumber('1');

                $episode->setSynopsis('Synopsis bientot disponible');

                $episode->setSeason($this->getReference('program_blackMirror_Saison' . $i));

                $manager->persist($episode);
            }
        }

        for ($i = 1; $i < 5; $i++) {
            foreach (self::EPISODE as $key) {
                $episode = new Episode();

                $episode->setTitle($key);

                $episode->setNumber('1');

                $episode->setSynopsis('Synopsis bientot disponible');

                $episode->setSeason($this->getReference('program_you_Saison' . $i));

                $manager->persist($episode);
            }
        }


        for ($i = 1; $i < 5; $i++) {
            foreach (self::EPISODE as $key) {
                $episode = new Episode();

                $episode->setTitle($key);

                $episode->setNumber('1');

                $episode->setSynopsis('Synopsis bientot disponible');

                $episode->setSeason($this->getReference('program_manifest_Saison' . $i));

                $manager->persist($episode);
            }
        }


        for ($i = 1; $i < 5; $i++) {
            foreach (self::EPISODE as $key) {
                $episode = new Episode();

                $episode->setTitle($key);

                $episode->setNumber('1');

                $episode->setSynopsis('Synopsis bientot disponible');

                $episode->setSeason($this->getReference('program_waywardPines_Saison' . $i));

                $manager->persist($episode);
            }
        }

        $manager->flush();
    }

    public function getDependencies()

    {

        return [

            SeasonFixtures::class,

        ];
    }
}
