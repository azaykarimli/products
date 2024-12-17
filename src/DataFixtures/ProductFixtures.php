<?php

namespace App\DataFixtures;

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Add a single sample product
        $product = new Product();
        $product->setName('Sample Product')
            ->setPrice(20.99)
            ->setQty(50);

        $manager->persist($product);

        // Add multiple random products
        for ($i = 1; $i <= 5; $i++) {
            $product = new Product();
            $product->setName("Product $i")
                ->setPrice(mt_rand(10, 100)) // Random price between 10 and 100
                ->setQty(mt_rand(1, 50));   // Random quantity between 1 and 50

            $manager->persist($product);
        }

        // Persist all products
        $manager->flush();
    }
}
