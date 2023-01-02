<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Actor;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture
{
    public const ACTORS = 10;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i=1; $i <= self::ACTORS; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            $this->addReference('actor_' . $i, $actor);
            $manager->persist($actor);
        }

        $manager->flush();
    }
}
