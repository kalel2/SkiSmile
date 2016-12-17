<?php

namespace SkiSmileBundle\Controller;

use SkiSmileAdminBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Product controller.
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("product/list/{category}", name="product_index")
     * @Method("GET")
     * @Template("@SkiSmile/Product/index.html.twig")
     */
    public function indexAction(Request $request, $category = null)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('SkiSmileAdminBundle:ProductCategory')->findAll();

        if ($category) {
            $products = $em->getRepository('SkiSmileAdminBundle:Product')->findBy(array('category'=>$category));
        } else {
            $products = $em->getRepository('SkiSmileAdminBundle:Product')->findAll();
        }

        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $products,
            $request->query->get('page', 1)/*page number*/,
            12/*limit per page*/
        );

        return array(
            'pagination' => $pagination,
            'categories' => $categories
        );
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("product/{id}", name="product_show")
     * @Method("GET")
     * @Template("@SkiSmile/Product/show.html.twig")
     */
    public function showAction(Product $product)
    {

        return array(
            'product' => $product,
        );
    }
}
