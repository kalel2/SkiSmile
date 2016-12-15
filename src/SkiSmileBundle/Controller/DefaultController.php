<?php

namespace SkiSmileBundle\Controller;

use SkiSmileAdminBundle\Entity\ContactMessage;
use SkiSmileAdminBundle\Form\ContactMessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        // Ski rent entities
        $skiRents = $em->getRepository('SkiSmileAdminBundle:SkiRent')->findBy(array('retail'=>0));
        $skiRentsPart = $em->getRepository('SkiSmileAdminBundle:SkiRent')->findBy(array('retail'=>1));
        // Ski service entity
        $skiService = $em->getRepository('SkiSmileAdminBundle:SkiService')->findAll();
        return array(
            'ski_rent' => $skiRents,
            'ski_rent_part' => $skiRentsPart,
            'ski_service' => $skiService
        );
    }

    /**
     * @Route("/contact", name="contact_home")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $contactMessage = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contactMessage);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($contactMessage);
                $em->flush($contactMessage);

                $this->sendMail($contactMessage);

                return $this->redirectToRoute('home');
            }
        }
        return array(
            'form' => $form->createView()
        );
    }

    private function sendMail($contactMessage)
    {
        $mail = \Swift_Message::newInstance()
            ->setSubject('Ski Smile повідомлення')
            ->setFrom($contactMessage->getEmail())
            ->setTo('s.hrynenko@gmail.com')
            ->setBody('message body goes here ' . $contactMessage->getMessage())
        ;

        $this->get('mailer')->send($mail);
    }
}
