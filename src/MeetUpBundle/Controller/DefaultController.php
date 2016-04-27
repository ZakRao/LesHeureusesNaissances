<?php

namespace MeetUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MeetUpBundle:Default:index.html.twig');
    }
}
