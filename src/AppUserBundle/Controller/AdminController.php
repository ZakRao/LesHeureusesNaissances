<?php
// src/OC/UserBundle/Controller/SecurityController.php;

namespace AppUserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;



class AdminController extends Controller
{

   /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function adminAction (Request $request)
  {

      $user = $this->container->get('security.context')->getToken()->getUser();
     
    $listUsers = $this->getDoctrine()
      ->getManager()
      ->getRepository('AppUserBundle:User')
      ->findAll()
    ;

    // L'appel de la vue ne change pas
    return $this->render('AppUserBundle:Profile:admin.html.twig', array(
      'listUsers' => $listUsers
    ));
    
  
  }

  


}