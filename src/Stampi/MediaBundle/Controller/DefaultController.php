<?php

namespace ByHours\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MediaBundle:Default:index.html.twig', array('name' => $name));
    }
}