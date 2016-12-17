<?php

namespace SkiSmileAdminBundle\Controller;

use SkiSmileAdminBundle\Entity\ContactMessage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Contactmessage controller.
 *
 * @Route("admin/contactmessage")
 */
class ContactMessageController extends Controller
{
    /**
     * Lists all contactMessage entities.
     *
     * @Route("/", name="contactmessage_admin_index")
     * @Template("@SkiSmileAdmin/ContactMessage/index.html.twig")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $contactMessages = $em->getRepository('SkiSmileAdminBundle:ContactMessage')->findAll();
        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $contactMessages,
            $request->query->get('page', 1)/*page number*/,
            9/*limit per page*/
        );

        return array(
            'pagination' => $pagination,
        );
    }

    /**
     * Creates a new contactMessage entity.
     *
     * @Route("/new", name="contactmessage_admin_new")
     * @Template("@SkiSmileAdmin/ContactMessage/new.html.twig")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $contactMessage = new Contactmessage();
        $form = $this->createForm('SkiSmileAdminBundle\Form\ContactMessageType', $contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contactMessage);
            $em->flush($contactMessage);

            return $this->redirectToRoute('contactmessage_admin_show', array('id' => $contactMessage->getId()));
        }

        return  array(
            'contactMessage' => $contactMessage,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a contactMessage entity.
     *
     * @Route("/{id}", name="contactmessage_admin_show")
     * @Template("@SkiSmileAdmin/ContactMessage/show.html.twig")
     * @Method("GET")
     */
    public function showAction(ContactMessage $contactMessage)
    {
        $deleteForm = $this->createDeleteForm($contactMessage);

        return array(
            'contactMessage' => $contactMessage,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing contactMessage entity.
     *
     * @Route("/{id}/edit", name="contactmessage_admin_edit")
     * @Template("@SkiSmileAdmin/ContactMessage/edit.html.twig")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ContactMessage $contactMessage)
    {
        $deleteForm = $this->createDeleteForm($contactMessage);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\ContactMessageType', $contactMessage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contactmessage_admin_edit', array('id' => $contactMessage->getId()));
        }

        return array(
            'contactMessage' => $contactMessage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a contactMessage entity.
     *
     * @Route("/delete/{id}", name="contactmessage_admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ContactMessage $contactMessage)
    {
        $form = $this->createDeleteForm($contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contactMessage);
            $em->flush($contactMessage);
        }

        return $this->redirectToRoute('contactmessage_admin_index');
    }

    /**
     * Creates a form to delete a contactMessage entity.
     *
     * @param ContactMessage $contactMessage The contactMessage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ContactMessage $contactMessage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactmessage_admin_delete', array('id' => $contactMessage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
