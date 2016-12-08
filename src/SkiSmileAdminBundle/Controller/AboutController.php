<?php

namespace SkiSmileAdminBundle\Controller;

use SkiSmileAdminBundle\Entity\About;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * About controller.
 *
 * @Route("admin/about")
 */
class AboutController extends Controller
{
    /**
     * Lists all about entities.
     *
     * @Route("/", name="about_admin_index")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/About/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $abouts = $em->getRepository('SkiSmileAdminBundle:About')->findAll();

        return array(
            'abouts' => $abouts,
        );
    }

    /**
     * Creates a new about entity.
     *
     * @Route("/new", name="about_admin_new")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/About/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $about = new About();
        $form = $this->createForm('SkiSmileAdminBundle\Form\AboutType', $about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($about);
            $em->flush($about);

            return $this->redirectToRoute('about_admin_show', array('id' => $about->getId()));
        }

        return array(
            'about' => $about,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a about entity.
     *
     * @Route("/{id}", name="about_admin_show")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/About/show.html.twig")
     */
    public function showAction(About $about)
    {
        $deleteForm = $this->createDeleteForm($about);

        return  array(
            'about' => $about,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing about entity.
     *
     * @Route("/{id}/edit", name="about_admin_edit")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/About/edit.html.twig")
     */
    public function editAction(Request $request, About $about)
    {
        $deleteForm = $this->createDeleteForm($about);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\AboutType', $about);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('about_admin_edit', array('id' => $about->getId()));
        }

        return array(
            'about' => $about,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a about entity.
     *
     * @Route("/{id}", name="about_admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, About $about)
    {
        $form = $this->createDeleteForm($about);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($about);
            $em->flush($about);
        }

        return $this->redirectToRoute('about_admin_index');
    }

    /**
     * Creates a form to delete a about entity.
     *
     * @param About $about The about entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(About $about)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('about_admin_delete', array('id' => $about->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
