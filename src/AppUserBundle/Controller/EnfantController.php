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

      $user = $this->container->get('security.context')->getToken()->getUser();
     if($user->getDescription()==null){


            return $this->redirectToRoute('fos_user_profile_edit');

    }
  
    $enfant = new Enfant();
        $form = $this->createForm(EnfantType::class, $enfant);
        
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

           // Associate User Entity To Product 
            $enfant->setUser($user);

            $em->persist($enfant);
            $em->flush();

                 return $this->redirectToRoute('show', array('username' => $user));            
        }

        return $this->render('AppUserBundle:Profile:add_enfant.html.twig', array(
            'enfant' => $enfant,
            'form'   => $form->createView(),
        ));
  
  
  
  }

  public function delete_enfantAction($id, Request $request)
  {
  $user = $this->container->get('security.context')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $enfant = $em->getRepository('AppUserBundle:Enfant')->find($id);

    if (null === $enfant) {
      throw new NotFoundHttpException("L'enfant  d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
  
      $em->remove($enfant);
      $em->flush();
      
 return $this->redirectToRoute('show', array('username' => $user));    
    


  
  }


}