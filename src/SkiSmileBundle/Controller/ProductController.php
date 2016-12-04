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
     * @Route("product/list", name="product_index")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/Product/index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('SkiSmileAdminBundle:Product')->findAll();

        return array(
            'products' => $products,
        );
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("product/{id}", name="product_show")
     * @Method("GET")
     * @Template("@SkiSmileAdmin/Product/show.html.twig")
     */
    public function showAction(Product $product)
    {

        return array(
            'product' => $product,
        );
    }
}
