<?php

namespace SkiSmileAdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SkiSmileAdminBundle\Entity\SkiService;

class LoadSkiserviceRetailData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $skiservice1 = new SkiService();
        $skiservice1->setService('Перевірка, змащування, регулювання кріплення');
        $skiservice1->setPrice('20');
        $skiservice1->setRetail(1);

        $skiservice2 = new SkiService();
        $skiservice2->setService('Полірування поверхні');
        $skiservice2->setPrice('20');
        $skiservice2->setRetail(1);

        $skiservice3 = new SkiService();
        $skiservice3->setService('Ручна заточка канта під кутами: -2°, -3°, -4° (+ зняття обертанта)');
        $skiservice3->setPrice('130');
        $skiservice3->setRetail(1);

        $skiservice4 = new SkiService();
        $skiservice4->setService('Ручна заточка канта з тефлона: -0,5°, -1°, -1,5°');
        $skiservice4->setPrice('90');
        $skiservice4->setRetail(1);

        $skiservice5 = new SkiService();
        $skiservice5->setService('Поклейка/слоїння канта');
        $skiservice5->setPrice('80 грн / 10 см');
        $skiservice5->setRetail(1);

        $skiservice6 = new SkiService();
        $skiservice6->setService('Заміна ремішка на кріпленні для сноуборду');
        $skiservice6->setPrice('130');
        $skiservice6->setRetail(1);

        $skiservice7 = new SkiService();
        $skiservice7->setService('Заміна кліпси на кріпленні для сноуборду');
        $skiservice7->setPrice('110');
        $skiservice7->setRetail(1);

        $skiservice8 = new SkiService();
        $skiservice8->setService('Заміна кліпси на гірськолижному боті');
        $skiservice8->setPrice('120');
        $skiservice8->setRetail(1);

        $skiservice9 = new SkiService();
        $skiservice9->setService('Ремонт язика на гірськолижному боті');
        $skiservice9->setPrice('120');
        $skiservice9->setRetail(1);

        $skiservice10 = new SkiService();
        $skiservice10->setService('Встановлення кріплення під шаблон');
        $skiservice10->setPrice('110');
        $skiservice10->setRetail(1);

        $skiservice11 = new SkiService();
        $skiservice11->setService('Встановлення кріплення вручну');
        $skiservice11->setPrice('140');
        $skiservice11->setRetail(1);

        $skiservice12 = new SkiService();
        $skiservice12->setService('Встановлення кріплення для сноуборда');
        $skiservice12->setPrice('40');
        $skiservice12->setRetail(1);

        $skiservice13 = new SkiService();
        $skiservice13->setService('Встановлення одного наконечника на лижі');
        $skiservice13->setPrice('120');
        $skiservice13->setRetail(1);

        $skiservice14 = new SkiService();
        $skiservice14->setService('Встановлення одного наконечника на сноуборд');
        $skiservice14->setPrice('160');
        $skiservice14->setRetail(1);

        $skiservice15 = new SkiService();
        $skiservice15->setService('Заміна кільця на палці');
        $skiservice15->setPrice('40');
        $skiservice15->setRetail(1);

        $manager->persist($skiservice1);
        $manager->persist($skiservice2);
        $manager->persist($skiservice3);
        $manager->persist($skiservice4);
        $manager->persist($skiservice5);
        $manager->persist($skiservice6);
        $manager->persist($skiservice7);
        $manager->persist($skiservice8);
        $manager->persist($skiservice9);
        $manager->persist($skiservice10);
        $manager->persist($skiservice11);
        $manager->persist($skiservice12);
        $manager->persist($skiservice13);
        $manager->persist($skiservice14);
        $manager->persist($skiservice15);
        $manager->flush();
    }

}