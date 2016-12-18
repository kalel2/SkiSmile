<?php

namespace SkiSmileAdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SkiSmileAdminBundle\Entity\SkiRent;

class LoadSkirentData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $skirent1 = new SkiRent();
        $skirent1->setCategory('А1');
        $skirent1->setInventory('Лижі нові 1-3 роки з черевиками та палками + шлем');
        $skirent1->setPriceOne(200);
        $skirent1->setPriceTwo(200);
        $skirent1->setPriceThree(180);
        $skirent1->setGuarantee(5500);
        $skirent1->setRetail(0);

        $skirent2 = new SkiRent();
        $skirent2->setCategory('А');
        $skirent2->setInventory('Лижі вживані 1-3 роки з черевиками та палками + шлем');
        $skirent2->setPriceOne(170);
        $skirent2->setPriceTwo(170);
        $skirent2->setPriceThree(160);
        $skirent2->setGuarantee(4500);
        $skirent2->setRetail(0);

        $skirent3 = new SkiRent();
        $skirent3->setCategory('Б');
        $skirent3->setInventory('Лижі вживані 3-6 років з черевиками та палками + шлем');
        $skirent3->setPriceOne(120);
        $skirent3->setPriceTwo(120);
        $skirent3->setPriceThree(110);
        $skirent3->setGuarantee(4000);
        $skirent3->setRetail(0);

        $skirent4 = new SkiRent();
        $skirent4->setInventory('Лижі дитячі з черевиками та палками + шлем');
        $skirent4->setPriceOne(90);
        $skirent4->setPriceTwo(90);
        $skirent4->setPriceThree(80);
        $skirent4->setGuarantee(3500);
        $skirent4->setRetail(0);

        $skirent5 = new SkiRent();
        $skirent5->setCategory('А');
        $skirent5->setInventory('Сноуборд новий з черевиками 1-3 роки + шлем');
        $skirent5->setPriceOne(170);
        $skirent5->setPriceTwo(170);
        $skirent5->setPriceThree(150);
        $skirent5->setGuarantee(4500);
        $skirent5->setRetail(0);

        $skirent6 = new SkiRent();
        $skirent6->setCategory('Б');
        $skirent6->setInventory('Сноуборд вживаний з черевиками 3-6 років + шлем');
        $skirent6->setPriceOne(120);
        $skirent6->setPriceTwo(120);
        $skirent6->setPriceThree(110);
        $skirent6->setGuarantee(4000);
        $skirent6->setRetail(0);

        $skirent7 = new SkiRent();
        $skirent7->setInventory('Шлем вживаний');
        $skirent7->setPriceOne(40);
        $skirent7->setPriceTwo(40);
        $skirent7->setPriceThree(35);
        $skirent7->setGuarantee(800);
        $skirent7->setRetail(0);

        $skirent8 = new SkiRent();
        $skirent8->setInventory('Окуляри нові');
        $skirent8->setPriceOne(40);
        $skirent8->setPriceTwo(40);
        $skirent8->setPriceThree(35);
        $skirent8->setGuarantee(800);
        $skirent8->setRetail(0);

        $skirent9 = new SkiRent();
        $skirent9->setInventory('Окуляри вживані');
        $skirent9->setPriceOne(30);
        $skirent9->setPriceTwo(30);
        $skirent9->setPriceThree(25);
        $skirent9->setGuarantee(300);
        $skirent9->setRetail(0);

        $skirent10 = new SkiRent();
        $skirent10->setInventory('Рукавиці гірськолижні');
        $skirent10->setPriceOne(40);
        $skirent10->setPriceTwo(40);
        $skirent10->setPriceThree(35);
        $skirent10->setGuarantee(150);
        $skirent10->setRetail(0);

        $skirent11 = new SkiRent();
        $skirent11->setCategory('А');
        $skirent11->setInventory('Костюм новий гірськолижний');
        $skirent11->setPriceOne(150);
        $skirent11->setPriceTwo(150);
        $skirent11->setPriceThree(140);
        $skirent11->setGuarantee(2500);
        $skirent11->setRetail(0);

        $skirent12 = new SkiRent();
        $skirent12->setCategory('Б');
        $skirent12->setInventory('Костюм вживаний 1-3 роки');
        $skirent12->setPriceOne(120);
        $skirent12->setPriceTwo(120);
        $skirent12->setPriceThree(110);
        $skirent12->setGuarantee(1000);
        $skirent12->setRetail(0);

        $skirent13 = new SkiRent();
        $skirent13->setInventory('Сани');
        $skirent13->setPriceOne(30);
        $skirent13->setPriceTwo(30);
        $skirent13->setPriceThree(25);
        $skirent13->setGuarantee(200);
        $skirent13->setRetail(0);

        $manager->persist($skirent1);
        $manager->persist($skirent2);
        $manager->persist($skirent3);
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