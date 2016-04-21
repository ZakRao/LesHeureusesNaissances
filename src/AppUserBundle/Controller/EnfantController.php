<?php
// src/OC/UserBundle/Controller/SecurityController.php;

namespace AppUserBundle\Controller;
use AppUserBundle\Entity\Enfant;
use AppUserBundle\Form\Type\EnfantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class EnfantController extends Controller
{

  
  public function add_enfantAction (Request $request)
  {
  
    $enfant = new Enfant();
        $form = $this->createForm(EnfantType::class, $enfant);
        
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

           // Associate User Entity To Product 
            $user = $this->container->get('security.context')->getToken()->getUser();
            $enfant->setUser($user);

            $em->persist($enfant);
            $em->flush();

            return $this->container->get('templating')->renderResponse('FOSUserBundle:Profile:show.html.twig', array('user' => $user)); 
        }

        return $this->render('AppUserBundle:Profile:add_enfant.html.twig', array(
            'enfant' => $enfant,
            'form'   => $form->createView(),
        ));
  
  
  
  }


}