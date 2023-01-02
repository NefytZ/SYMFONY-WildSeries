<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const PROGRAMS = 5;
    public const PROG_BY_ACTOR = 3;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        foreach (CategoryFixtures::CATEGORIES as $category) {
            for ($i = 1; $i <= self::PROGRAMS; $i++) {
                $program = new Program();
                $program->setTitle($faker->sentence(4, true));
                $program->setSynopsis($faker->paragraph(3));
                $program->setCategory($this->getReference('category_' . $category));
                $this->addReference('program_' . $i . '_' . $category, $program);
                for ($j = 1; $j < self::PROG_BY_ACTOR; $j++) {
                    $program->addActor($this->getReference('actor_' . $faker->numberBetween(1, 10)));
                }
                $manager->persist($program);
            }
        }
        $manager->flush();
    }



    public function getDependencies()
    {
        return [
            CategoryFixtures::class,

        ];
    }
}
