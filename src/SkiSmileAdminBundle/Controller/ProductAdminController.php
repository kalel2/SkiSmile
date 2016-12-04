<?php

namespace SkiSmileAdminBundle\Controller;

use SkiSmileAdminBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Product admin controller.
 *
 * @Route("admin/product")
 */
class ProductAdminController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_admin_index")
     * @Template("@SkiSmileAdmin/Product/index.html.twig")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('SkiSmileAdminBundle:Product')->findAll();

        return  array(
            'products' => $products,
        );
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_admin_new")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/Product/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('SkiSmileAdminBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush($product);

            return $this->redirectToRoute('product_admin_show', array('id' => $product->getId()));
        }

        return array(
            'product' => $product,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_admin_show")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/Product/show.html.twig")
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_admin_edit")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/Product/edit.html.twig")
     */
    public function editAction(Request $request, Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_admin_edit', array('id' => $product->getId()));
        }

        return  array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="product_admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush($product);
        }

        return $this->redirectToRoute('product_admin_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_admin_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
