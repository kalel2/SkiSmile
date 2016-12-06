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
     * @Route("/", name="ski_service_admin_index")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/SkiService/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skiServices = $em->getRepository('SkiSmileAdminBundle:SkiService')->findAll();

        return array(
            'skiServices' => $skiServices,
        );
    }

    /**
     * Creates a new skiService entity.
     *
     * @Route("/new", name="ski_service_admin_new")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/SkiService/new.html.twig")
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

            return $this->redirectToRoute('ski_service_admin_index');
        }

        return array(
            'skiService' => $skiService,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a skiService entity.
     *
     * @Route("/{id}", name="ski_service_admin_show")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/SkiService/show.html.twig")
     */
    public function showAction(SkiService $skiService)
    {
        $deleteForm = $this->createDeleteForm($skiService);

        return array(
            'skiService' => $skiService,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing skiService entity.
     *
     * @Route("/{id}/edit", name="ski_service_admin_edit")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/SkiService/edit.html.twig")
     */
    public function editAction(Request $request, SkiService $skiService)
    {
        $deleteForm = $this->createDeleteForm($skiService);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\SkiServiceType', $skiService);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ski_service_admin_index');
        }

        return array(
            'skiService' => $skiService,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a skiService entity.
     *
     * @Route("/{id}", name="ski_service_admin_delete")
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

        return $this->redirectToRoute('ski_service_admin_index');
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
            ->setAction($this->generateUrl('ski_service_admin_delete', array('id' => $skiService->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
