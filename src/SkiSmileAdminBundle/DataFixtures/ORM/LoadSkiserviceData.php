<?php

namespace SkiSmileAdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SkiSmileAdminBundle\Entity\SkiService;

class LoadSkiserviceData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $skiservice1 = new SkiService();
        $skiservice1->setService('Чистка ковзної поверхні (мілка шліфовка)');
        $skiservice1->setPrice('40');
        $skiservice1->setRetail(0);

        $skiservice2 = new SkiService();
        $skiservice2->setService('Заливка пошкодженої ковзної поверхні кофексом');
        $skiservice2->setPrice('100-130');
        $skiservice2->setRetail(0);

        $skiservice3 = new SkiService();
        $skiservice3->setService('Шліфовка ковзної поверхні');
        $skiservice3->setPrice('55');
        $skiservice3->setRetail(0);

        $skiservice4 = new SkiService();
        $skiservice4->setService('Станочна заточка кантів');
        $skiservice4->setPrice('65');
        $skiservice4->setRetail(0);

        $skiservice5 = new SkiService();
        $skiservice5->setService('Гаряча наплавка спеціальним парафіном');
        $skiservice5->setPrice('55');
        $skiservice5->setRetail(0);

        $skiservice6 = new SkiService();
        $skiservice6->setService('Цикльовка і натирання ковзної поверхні');
        $skiservice6->setPrice('30');
        $skiservice6->setRetail(0);

        $skiservice7 = new SkiService();
        $skiservice7->setService('Вирівнювання та нанесення структури на ковзну поверхню');
        $skiservice7->setPrice('160');
        $skiservice7->setRetail(0);

        $manager->persist($skiservice1);
        $manager->persist($skiservice2);
        $manager->persist($skiservice3);
        $manager->persist($skiservice4);
        $manager->persist($skiservice5);
        $manager->persist($skiservice6);
        $manager->persist($skiservice7);
        $manager->flush();
    }
}