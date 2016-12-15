<?php

namespace SkiSmileAdminBundle\Controller;

use SkiSmileAdminBundle\Entity\FotoGallery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Fotogallery controller.
 *
 * @Route("admin/fotogallery")
 */
class FotoGalleryController extends Controller
{
    /**
     * Lists all fotoGallery entities.
     *
     * @Route("/{place}", name="fotogallery_admin_index")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/Fotogallery/index.html.twig")
     */
    public function indexAction(Request $request, $place)
    {
        $places = $this->getPlaces();
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

    /**
     * Creates a new fotoGallery entity.
     *
     * @Route("/{place}/new", name="fotogallery_admin_new")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/Fotogallery/new.html.twig")
     */
    public function newAction(Request $request, $place)
    {
        $places = $this->getPlaces();
        $fotoGallery = new Fotogallery();
        $fotoGallery->setPlace($places[$place]);
        $form = $this->createForm('SkiSmileAdminBundle\Form\FotoGalleryType', $fotoGallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fotoGallery);
            $em->flush($fotoGallery);

            return $this->redirectToRoute('fotogallery_admin_index', array('place'=>$place));
        }

        return array(
            'fotoGallery' => $fotoGallery,
            'form' => $form->createView(),
            'place' => $place
        );
    }

    /**
     * Finds and displays a fotoGallery entity.
     *
     * @Route("/{id}", name="fotogallery_admin_show")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/Fotogallery/show.html.twig")
     */
    public function showAction(FotoGallery $fotoGallery)
    {
        $deleteForm = $this->createDeleteForm($fotoGallery);

        return array(
            'fotoGallery' => $fotoGallery,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing fotoGallery entity.
     *
     * @Route("/{id}/edit/{place}", name="fotogallery_admin_edit")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/Fotogallery/edit.html.twig")
     */
    public function editAction(Request $request, FotoGallery $fotoGallery, $place)
    {
        $deleteForm = $this->createDeleteForm($fotoGallery);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\FotoGalleryType', $fotoGallery);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fotogallery_admin_index', array('place' => $place));
        }

        return array(
            'fotoGallery' => $fotoGallery,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'place' => $place
        );
    }

    /**
     * Deletes a fotoGallery entity.
     *
     * @Route("/{id}", name="fotogallery_admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FotoGallery $fotoGallery)
    {
        $form = $this->createDeleteForm($fotoGallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($fotoGallery);
            $em->flush($fotoGallery);
        }

        return $this->redirectToRoute('fotogallery_admin_index');
    }

    /**
     * Creates a form to delete a fotoGallery entity.
     *
     * @param FotoGallery $fotoGallery The fotoGallery entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FotoGallery $fotoGallery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fotogallery_admin_delete', array('id' => $fotoGallery->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function getPlaces() {
        return array(
            'vorokhta' =>'Ворохта',
            'yablunitsya' =>'Яблуниця'
        );
    }
}
