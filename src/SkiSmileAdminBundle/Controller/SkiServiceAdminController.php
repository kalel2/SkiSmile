<?php

namespace SkiSmileAdminBundle\Controller;

use SkiSmileAdminBundle\Entity\SkiService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Skiservice admin controller.
 *
 * @Route("admin/ski_service")
 * @Template()
 */
class SkiServiceAdminController extends Controller
{
    /**
     * Lists all skiService entities.
     *
     * @Route("/", name="ski_service_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skiServices = $em->getRepository('SkiSmileAdminBundle:SkiService')->findAll();

        return  array(
            'skiServices' => $skiServices,
        );
    }

    /**
     * Creates a new skiService entity.
     *
     * @Route("/new", name="ski_service_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $skiService = new Skiservice();
        $form = $this->createForm('SkiSmileAdminBundle\Form\SkiServiceType', $skiService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skiService);
            $em->flush($skiService);

            return $this->redirectToRoute('ski_service_show', array('id' => $skiService->getId()));
        }

        return $this->render('skiservice/new.html.twig', array(
            'skiService' => $skiService,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a skiService entity.
     *
     * @Route("/{id}", name="ski_service_show")
     * @Method("GET")
     */
    public function showAction(SkiService $skiService)
    {
        $deleteForm = $this->createDeleteForm($skiService);

        return $this->render('skiservice/show.html.twig', array(
            'skiService' => $skiService,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing skiService entity.
     *
     * @Route("/{id}/edit", name="ski_service_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SkiService $skiService)
    {
        $deleteForm = $this->createDeleteForm($skiService);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\SkiServiceType', $skiService);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ski_service_edit', array('id' => $skiService->getId()));
        }

        return $this->render('skiservice/edit.html.twig', array(
            'skiService' => $skiService,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a skiService entity.
     *
     * @Route("/{id}", name="ski_service_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SkiService $skiService)
    {
        $form = $this->createDeleteForm($skiService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skiService);
            $em->flush($skiService);
        }

        return $this->redirectToRoute('ski_service_index');
    }

    /**
     * Creates a form to delete a skiService entity.
     *
     * @param SkiService $skiService The skiService entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SkiService $skiService)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ski_service_delete', array('id' => $skiService->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
