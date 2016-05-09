<?php

namespace MessagerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{

	/**
     *
     *@Route("/formtest")
     * 
     */
    public function indexAction()
    {
        return $this->render('MessagerieBundle:Message:formreplytest.html.twig');
    }
}
