<?php

namespace SkiSmileAdminBundle\Controller;

use SkiSmileAdminBundle\Entity\Reviews;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Review controller.
 *
 * @Route("admin/reviews")
 */
class ReviewsController extends Controller
{
    /**
     * Lists all review entities.
     *
     * @Route("/", name="reviews_admin_index")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/Reviews/index.html.twig")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $reviews = $em->getRepository('SkiSmileAdminBundle:Reviews')->findAll();
        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $reviews,
            $request->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return  array(
            'pagination' => $pagination
        );
    }

    /**
     * Creates a new review entity.
     *
     * @Route("/new", name="reviews_admin_new")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/Reviews/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $review = new Reviews();
        $form = $this->createForm('SkiSmileAdminBundle\Form\ReviewsAdminType', $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush($review);

            return $this->redirectToRoute('reviews_admin_show', array('id' => $review->getId()));
        }

        return array(
            'review' => $review,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a review entity.
     *
     * @Route("/{id}", name="reviews_admin_show")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/Reviews/show.html.twig")
     */
    public function showAction(Reviews $review)
    {
        $deleteForm = $this->createDeleteForm($review);

        return array(
            'review' => $review,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing review entity.
     *
     * @Route("/{id}/edit", name="reviews_admin_edit")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/Reviews/edit.html.twig")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Reviews $review)
    {
        $deleteForm = $this->createDeleteForm($review);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\ReviewsAdminType', $review);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reviews_admin_index');
        }

        return array(
            'review' => $review,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a review entity.
     *
     * @Route("/{id}", name="reviews_admin_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Reviews $review)
    {
        $form = $this->createDeleteForm($review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($review);
            $em->flush($review);
        }

        return $this->redirectToRoute('reviews_admin_index');
    }

    /**
     * Creates a form to delete a review entity.
     *
     * @param Reviews $review The review entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reviews $review)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reviews_admin_delete', array('id' => $review->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
