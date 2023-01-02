<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Episode;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface

{

    public const EPISODES = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (CategoryFixtures::CATEGORIES as $categoryName) {
            for ($i = 1; $i <= ProgramFixtures::PROGRAMS; $i++) {
                for ($j = 1; $j <= SeasonFixtures::SEASONS; $j++) {
                    for ($k = 1; $k <= self::EPISODES; $k++) {
                        $episode = new Episode();
                        $episode->setTitle($faker->sentence());
                      
                       
                        $episode->setSynopsis($faker->paragraph(4, true));
                      
                        $episode->setNumber($k);
                        $episode->setSeason($this->getReference('program_' . $i . '_' . $categoryName . '_season_' . $j));
                        $manager->persist($episode);
                    }
                }
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