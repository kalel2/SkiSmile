<?php

namespace SkiSmileBundle\Controller;

use SkiSmileAdminBundle\Entity\ContactMessage;
use SkiSmileAdminBundle\Form\ContactMessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use SkiSmileAdminBundle\Entity\Reviews;

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
        $skiService = $em->getRepository('SkiSmileAdminBundle:SkiService')->findBy(array('retail'=>0));
        $skiServicePart = $em->getRepository('SkiSmileAdminBundle:SkiService')->findBy(array('retail'=>1));
        return array(
            'ski_rent' => $skiRents,
            'ski_rent_part' => $skiRentsPart,
            'ski_service' => $skiService,
            'ski_service_part' => $skiServicePart
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

    /**
     * Show reviews.
     *
     * @Route("/review", name="review")
     * @Method("GET")
     * @Template()
     */
    public function reviewAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $reviews = $em->getRepository('SkiSmileAdminBundle:Reviews')->findAll();

        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $reviews,
            $request->query->get('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return array(
            'pagination' => $pagination,
        );
    }

    /**
     * Creates a new review entity.
     *
     * @Route("/new/review", name="new_review")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function reviewNewAction(Request $request)
    {
        $review = new Reviews();
        $form = $this->createForm('SkiSmileAdminBundle\Form\ReviewsType', $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush($review);

            return $this->redirectToRoute('review');
        }

        return array(
            'review' => $review,
            'form' => $form->createView(),
        );
    }

    /**
     * Show reviews.
     *
     * @Route("/foto_gallery/{place}", name="foto_gallery_index")
     * @Method("GET")
     * @Template()
     */
    public function galleryAction(Request $request, $place) {
        $places = array(
            'vorokhta' =>'Ворохта',
            'yablunitsya' =>'Яблуниця'
        );
        $em = $this->getDoctrine()->getManager();

        $fotoGalleries = $em->getRepository('SkiSmileAdminBundle:FotoGallery')->findBy(array('place'=>$places[$place]));

        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $fotoGalleries,
            $request->query->get('page', 1)/*page number*/,
            18/*limit per page*/
        );

        return array(
            'pagination' => $pagination,
            'place' => $places[$place],
            'target' => $place
        );
    }
}
