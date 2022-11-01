<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Food;
use App\Entity\Ingredients;
use App\Entity\Tags;
use App\Faker\FakerFood;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $faker->addProvider(new FakerFood($faker));

        for($i = 0;$i<15;$i++){
            $category = new Category();
            $category->setTitle($faker->kategorijaJela());
            $manager->persist($category);

            $food = new Food();
            $food->setName($faker->imeHrane());
            $food->setCategory($category);
            $manager->persist($food);

            $tags = new Tags();
            $tags->setTitle($faker->oznakaHrane());
            $tags->setFood($food);
            $manager->persist($tags);

            $ingredients = new Ingredients();
            $ingredients->setTitle($faker->imeSastojka());
            $ingredients->setFood($food);
            $manager->persist($ingredients);
        }

        for($i = 0;$i<5;$i++)
        {
            $food = new Food();
            $food->setName($faker->imeHrane());
            $food->setCategory(null);
            $manager->persist($food);

            $tags = new Tags();
            $tags->setTitle($faker->oznakaHrane());
            $tags->setFood($food);
            $manager->persist($tags);

            $ingredients = new Ingredients();
            $ingredients->setTitle($faker->imeSastojka());
            $ingredients->setFood($food);
            $manager->persist($ingredients);
        }

        $manager->flush();
    }
}
