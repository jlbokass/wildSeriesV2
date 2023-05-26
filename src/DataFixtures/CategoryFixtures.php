<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < count(self::CATEGORIES); $i++) {
            $category = new Category();
            $category->setName(self::CATEGORIES[$i]);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
