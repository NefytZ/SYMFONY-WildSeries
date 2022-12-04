<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{



    const CATEGORIES = [
        [
            'Title' => 'Walking Dead',
            'Synopsis' => 'Des zombies envahissent la terre.',
            'Category' => 'category_Horreur',
        ],
        [
            'Title' => 'Black Mirror',
            'Synopsis' => 'Chaque épisode a un casting, un décor et une réalité différente.',
            'Category' => 'category_Fantastique',
        ],
        [
            'Title' => 'You',
            'Synopsis' => 'Une jeune femme est un véritable coup de foudre pour Joe qui décide de la retrouver sur Internet.',
            'Category' => 'category_Fantastique',
        ],
        [
            'Title' => 'Manifest',
            'Synopsis' => 'Un vol commercial, qui relie la Jamaïque aux Etats-Unis, fait face à de fortes turbulences mais parvient à rallier sa destination sans dommage.',
            'Category' => 'category_Fantastique',
        ],
        [
            'Title' => 'Wayward Pines',
            'Synopsis' => 'Il doit enquêter sur la mystérieuse disparition de deux agents fédéraux.',
            'Category' => 'category_Fantastique',
        ],

    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::CATEGORIES as $p => $category) {
            $program = new Program();

            $program->setTitle($category['Title']);
            $program->setSynopsis($category['Synopsis']);
            $program->setCategory($this->getReference($category['Category']));

            $this->addReference('program_' . $p, $program);
    
            $manager->persist($program);
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
