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
     * @Route("/", name="fotogallery_admin_index")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/Fotogallery/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $fotoGalleries = $em->getRepository('SkiSmileAdminBundle:FotoGallery')->findAll();

        return array(
            'fotoGalleries' => $fotoGalleries,
        );
    }

    /**
     * Creates a new fotoGallery entity.
     *
     * @Route("/new", name="fotogallery_admin_new")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/Fotogallery/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $fotoGallery = new Fotogallery();
        $form = $this->createForm('SkiSmileAdminBundle\Form\FotoGalleryType', $fotoGallery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fotoGallery);
            $em->flush($fotoGallery);

            return $this->redirectToRoute('fotogallery_admin_show', array('id' => $fotoGallery->getId()));
        }

        return array(
            'fotoGallery' => $fotoGallery,
            'form' => $form->createView(),
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
     * @Route("/{id}/edit", name="fotogallery_admin_edit")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/Fotogallery/edit.html.twig")
     */
    public function editAction(Request $request, FotoGallery $fotoGallery)
    {
        $deleteForm = $this->createDeleteForm($fotoGallery);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\FotoGalleryType', $fotoGallery);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fotogallery_admin_edit', array('id' => $fotoGallery->getId()));
        }

        return array(
            'fotoGallery' => $fotoGallery,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
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
}
