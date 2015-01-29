<?php

namespace Stampi\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /*public function indexAction($name)
    {
        return $this->render('StampiAdminBundle:Default:index.html.twig', array('name' => $name));
    }*/

    public function indexAction()
    {
        return $this->render('StampiAdminBundle:Default:index.html.twig');
    }
}
