<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = 8;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        foreach (CategoryFixtures::CATEGORIES as $categoryName) {

            for ($j = 1; $j <= ProgramFixtures::PROGRAMS; $j++) {
                for ($i = 1; $i <= self::SEASONS; $i++) {
                    $season = new Season();
                    $season->setNumber($i);
                    $season->setYear($faker->year());
                    $season->setDescription($faker->paragraphs(3, true));
                    $season->setProgram($this->getReference('program_' . $j . '_' . $categoryName));
                    $this->addReference('program_' . $j . '_' . $categoryName . '_season_' . $i, $season);

                    $manager->persist($season);
                }
            }
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