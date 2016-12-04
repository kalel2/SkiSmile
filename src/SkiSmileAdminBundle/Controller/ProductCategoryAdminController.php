<?php

namespace SkiSmileAdminBundle\Controller;

use SkiSmileAdminBundle\Entity\ProductCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Productcategory admin controller.
 *
 * @Route("admin/product_category")
 */
class ProductCategoryAdminController extends Controller
{
    /**
     * Lists all productCategory entities.
     *
     * @Route("/", name="product_category_admin_index")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/ProductCategory/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productCategories = $em->getRepository('SkiSmileAdminBundle:ProductCategory')->findAll();

        return  array(
            'productCategories' => $productCategories,
        );
    }

    /**
     * Creates a new productCategory entity.
     *
     * @Route("/new", name="product_category_admin_new")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/ProductCategory/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $productCategory = new Productcategory();
        $form = $this->createForm('SkiSmileAdminBundle\Form\ProductCategoryType', $productCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productCategory);
            $em->flush($productCategory);

            return $this->redirectToRoute('product_category_admin_show', array('id' => $productCategory->getId()));
        }

        return  array(
            'productCategory' => $productCategory,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a productCategory entity.
     *
     * @Route("/{id}", name="product_category_admin_show")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/ProductCategory/show.html.twig")
     */
    public function showAction(ProductCategory $productCategory)
    {
        $deleteForm = $this->createDeleteForm($productCategory);

        return array(
            'productCategory' => $productCategory,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing productCategory entity.
     *
     * @Route("/{id}/edit", name="product_category_admin_edit")
     * @Method({"GET", "POST"})
     * @Template("@SkiSmileAdmin/ProductCategory/edit.html.twig")
     */
    public function editAction(Request $request, ProductCategory $productCategory)
    {
        $deleteForm = $this->createDeleteForm($productCategory);
        $editForm = $this->createForm('SkiSmileAdminBundle\Form\ProductCategoryType', $productCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_category_admin_edit', array('id' => $productCategory->getId()));
        }

        return array(
            'productCategory' => $productCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a productCategory entity.
     *
     * @Route("/{id}", name="product_category_admin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProductCategory $productCategory)
    {
        $form = $this->createDeleteForm($productCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productCategory);
            $em->flush($productCategory);
        }

        return $this->redirectToRoute('product_category_admin_index');
    }

    /**
     * Creates a form to delete a productCategory entity.
     *
     * @param ProductCategory $productCategory The productCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProductCategory $productCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_category_admin_delete', array('id' => $productCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
