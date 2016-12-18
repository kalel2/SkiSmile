<?php

namespace SkiSmileAdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SkiSmileAdminBundle\Entity\SkiRent;



class LoadSkirentRetailData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $skirent1 = new SkiRent();
        $skirent1->setCategory('А');
        $skirent1->setInventory('Лижі нові');
        $skirent1->setPriceOne(130);
        $skirent1->setPriceTwo(130);
        $skirent1->setPriceThree(80);
        $skirent1->setPriceFour(80);
        $skirent1->setGuarantee(2900);
        $skirent1->setRetail(1);

        $skirent2 = new SkiRent();
        $skirent2->setCategory('Б');
        $skirent2->setInventory('Лижі вживані 1-3 роки');
        $skirent2->setPriceOne(100);
        $skirent2->setPriceTwo(100);
        $skirent2->setPriceThree(60);
        $skirent2->setPriceFour(60);
        $skirent2->setGuarantee(2000);
        $skirent2->setRetail(1);

        $skirent4 = new SkiRent();
        $skirent4->setInventory('Лижі дитячі');
        $skirent4->setPriceOne(75);
        $skirent4->setPriceTwo(75);
        $skirent4->setPriceThree(40);
        $skirent4->setPriceFour(40);
        $skirent4->setGuarantee(1800);
        $skirent4->setRetail(1);

        $skirent5 = new SkiRent();
        $skirent5->setCategory('А');
        $skirent5->setInventory('Сноуборд новий');
        $skirent5->setPriceOne(130);
        $skirent5->setPriceTwo(130);
        $skirent5->setPriceThree(80);
        $skirent5->setPriceFour(75);
        $skirent5->setGuarantee(2900);
        $skirent5->setRetail(1);

        $skirent6 = new SkiRent();
        $skirent6->setCategory('Б');
        $skirent6->setInventory('Сноуборд вживаний 1-3 роки');
        $skirent6->setPriceOne(100);
        $skirent6->setPriceTwo(100);
        $skirent6->setPriceThree(60);
        $skirent6->setPriceFour(60);
        $skirent6->setGuarantee(2000);
        $skirent6->setRetail(1);

        $skirent7 = new SkiRent();
        $skirent7->setInventory('Ботінки гірськолижні');
        $skirent7->setPriceOne(50);
        $skirent7->setPriceTwo(40);
        $skirent7->setPriceThree(40);
        $skirent7->setPriceFour(30);
        $skirent7->setGuarantee(1600);
        $skirent7->setRetail(1);

        $skirent8 = new SkiRent();
        $skirent8->setInventory('Ботінки сноубордові');
        $skirent8->setPriceOne(50);
        $skirent8->setPriceTwo(40);
        $skirent8->setPriceThree(40);
        $skirent8->setPriceFour(30);
        $skirent8->setGuarantee(1500);
        $skirent8->setRetail(1);

        $skirent9 = new SkiRent();
        $skirent9->setInventory('Куртка нова');
        $skirent9->setPriceOne(85);
        $skirent9->setPriceTwo(85);
        $skirent9->setPriceThree(60);
        $skirent9->setPriceFour(50);
        $skirent9->setGuarantee(1500);
        $skirent9->setRetail(1);

        $skirent10 = new SkiRent();
        $skirent10->setInventory('Штани нові');
        $skirent10->setPriceOne(85);
        $skirent10->setPriceTwo(85);
        $skirent10->setPriceThree(60);
        $skirent10->setPriceFour(50);
        $skirent10->setGuarantee(1500);
        $skirent10->setRetail(1);

        $skirent11 = new SkiRent();
        $skirent11->setInventory('Куртка вживана 1-2 роки');
        $skirent11->setPriceOne(60);
        $skirent11->setPriceTwo(60);
        $skirent11->setPriceThree(50);
        $skirent11->setPriceFour(40);
        $skirent11->setGuarantee(800);
        $skirent11->setRetail(1);

        $skirent12 = new SkiRent();
        $skirent12->setInventory('Штани вживані 1-2 роки');
        $skirent12->setPriceOne(60);
        $skirent12->setPriceTwo(60);
        $skirent12->setPriceThree(50);
        $skirent12->setPriceFour(40);
        $skirent12->setGuarantee(800);
        $skirent12->setRetail(1);

        $skirent13 = new SkiRent();
        $skirent13->setInventory('Палки гірськолижні');
        $skirent13->setPriceOne(30);
        $skirent13->setPriceTwo(25);
        $skirent13->setPriceThree(20);
        $skirent13->setPriceFour(20);
        $skirent13->setGuarantee(500);
        $skirent13->setRetail(1);

        $manager->persist($skirent1);
        $manager->persist($skirent2);
        $manager->persist($skirent4);
        $manager->persist($skirent5);
        $manager->persist($skirent6);
        $manager->persist($skirent7);
        $manager->persist($skirent8);
        $manager->persist($skirent9);
        $manager->persist($skirent10);
        $manager->persist($skirent11);
        $manager->persist($skirent12);
        $manager->persist($skirent13);
        $manager->flush();
    }
}