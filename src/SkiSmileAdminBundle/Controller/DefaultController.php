<?php

namespace SkiSmileAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("admin/")
     */
    public function indexAction()
    {
        return $this->render('SkiSmileAdminBundle:Default:index.html.twig');
    }
}
