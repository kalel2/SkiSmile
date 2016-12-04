<?php

namespace SkiSmileAdminBundle\Controller;

use SkiSmileAdminBundle\Entity\SkiRent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Skirent admin controller.
 *
 * @Route("admin/ski_rent")
 */
class SkiRentAdminController extends Controller
{
    /**
     * Lists all skiRent entities.
     *
     * @Route("/", name="ski_rent_admin_index")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/SkiRent/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skiRents = $em->getRepository('SkiSmileAdminBundle:SkiRent')->findAll();

        return array(
            'entities' => $skiRents,
        );
    }

    /**
     * Creates a new skiRent entity.
     *
     * @Route("/new", name="ski_rent_admin_new")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/SkiRent/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $skiRent = new Skirent();
        $form = $this->createForm('SkiSmileAdminBundle\Form\SkiRentType', $skiRent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skiRent);
            $em->flush($skiRent);

            return $this->redirectToRoute('ski_rent_admin_show', array('id' => $skiRent->getId()));
        }

        return array(
            'skiRent' => $skiRent,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a skiRent entity.
     *
     * @Route("/{id}", name="ski_rent_admin_show")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/SkiRent/show.html.twig")
     */
    public function showAction(SkiRent $skiRent)
    {
        $deleteForm = $this->createDeleteForm($skiRent);

        return  array(
            'skiRent' => $skiRent,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing skiRent entity.
     *
     * @Route("/{id}/edit", name="ski_rent_admin_edit")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/SkiRent/edit.html.twig")
     */
    public function editAction(Request $request, SkiRent $skiRent)
    {
        $deleteForm = $this->createDeleteForm($skiRent);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\SkiRentType', $skiRent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ski_rent_admin_edit', array('id' => $skiRent->getId()));
        }

        return array(
            'skiRent' => $skiRent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a skiRent entity.
     *
     * @Route("/{id}", name="ski_rent_admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SkiRent $skiRent)
    {
        $form = $this->createDeleteForm($skiRent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skiRent);
            $em->flush($skiRent);
        }

        return $this->redirectToRoute('ski_rent_admin_index');
    }

    /**
     * Creates a form to delete a skiRent entity.
     *
     * @param SkiRent $skiRent The skiRent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SkiRent $skiRent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ski_rent_admin_delete', array('id' => $skiRent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
