<?php

namespace MeetUpBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use MeetUpBundle\Entity\MeetUp;
use MeetUpBundle\Form\MeetUpType;
use AppBundle\Entity\Image;
use MeetUpBundle\Entity\Vote1;
use MeetUpBundle\Entity\Vote2;
use MeetUpBundle\Entity\Vote3;


use AppUserBundle\Entity\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class MeetUpController extends Controller
{
	public function addAction(Request $request)
	{
	 $user = $this->container->get('security.context')->getToken()->getUser();

	     if($user->getDescription()==null){
	     	return $this->redirectToRoute('fos_user_profile_edit');

	    }
	$meetup = new MeetUp();
	$vote1 = new Vote1();
	$vote2 = new Vote2();
	$vote3 = new Vote3();
	$form = $this->createForm(MeetUpType::class, $meetup);
	$em = $this->getDoctrine()->getManager();


	
	//if(isset($_POST['fos_user_registration_form']) AND$parrain = $_POST['fos_user_registration_form']['parrain'] AND isset($parrain) AND !empty($parrain)){

	if( $form->handleRequest($request)->isValid()){

        $meetup->setUser($user);

  		$meetup->setVote1($vote1);
        $meetup->setVote2($vote2);        
        $meetup->setVote3($vote3);

       	
        $em->persist($vote1);
        $em->persist($vote2);
        $em->persist($vote3);

		$em->persist($meetup);
		$em->flush();
	

		$request->getSession()->getFlashBag()->add('notice', 'Rencontre bien enregistrée.');

  		return $this->redirect($this->generateUrl('meet_up_view', array(
  			'id' => $meetup->getId())));

	}

	return $this->render('MeetUpBundle:MeetUp:addMeetUp.html.twig', array('form' => $form->createView(),));
	}	

	public function showAction($id)
	{
	// On récupère l'EntityManager
	$em = $this->getDoctrine()->getManager();

	// Pour récupérer une rencontre unique : on utilise find()
	
	$meet_up = $em->getRepository('MeetUpBundle:MeetUp')->find($id);

	
	// On vérifie que la rencontre avec cet id existe bien
	if ($meet_up === null) {
  		throw $this->createNotFoundException("La Rencontre d'id ".$id." n'existe pas.");
  		  }
  	

	return $this->render('MeetUpBundle:MeetUp:view.html.twig', array('meet_up' => $meet_up));
	}

	public function lesrencontresAction()
	{
	    // Pour récupérer la liste de toutes les annonces : on utilise findAll()
	    $findlistMeetUp = $this->getDoctrine()
	      ->getManager()
	      ->getRepository('MeetUpBundle:MeetUp')
	      ->findAll()
	    ;

	    $listMeetUp  = $this->get('knp_paginator')->paginate($findlistMeetUp,
	        $this->get('request')->query->get('page', 1)/*page number*/,
	        2/*limit per page*/
	    );
			return $this->render('MeetUpBundle:MeetUp:lesrencontres.html.twig', array(
	      'listMeetUp' => $listMeetUp
	    ));
	}


	 public function deleteAction($id)
 	 {

  	$user = $this->container->get('security.context')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();

    // On récupère la meet up $id
    $meet_up = $em->getRepository('MeetUpBundle:MeetUp')->find($id);

    if (null === $meet_up) {
      throw new NotFoundHttpException("La Rencontre d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
  
      $em->remove($meet_up);
      $em->flush();

    return $this->RedirectToRoute('profile');
	}



	public function editAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();

   		 // On récupère la meet up $id
   		$meet_up = $em->getRepository('MeetUpBundle:MeetUp')->find($id);
   		$form = $this->createForm(MeetUpType::class, $meet_up);

   		if (null === $meet_up) {
      		throw new NotFoundHttpException("La Rencontre d'id ".$id." n'existe pas.");
      	}

      	if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
      		$em->persist($meet_up);
      		$em->flush(); 

      		$request->getSession()->getFlashBag()->add('notice', 'La Rencontre bien modifiée');

      		return $this->RedirectToRoute('meet_up_view', array('id' => $meet_up->getId()));
      	}

      	return $this->render('MeetUpBundle:MeetUp:edit.html.twig', array(
      		'form' => $form->createView(),
      		'meet_up' => $meet_up));
	}
	
	public function increment_voteAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$meet_up = $em->getRepository('MeetUpBundle:MeetUp')->find($id);
		$request = Request::createFromGlobals();
	
		if ($meet_up === null) {
  		throw $this->createNotFoundException("La Rencontre d'id ".$id." n'existe pas.");
  		  }
		
		$path = $request->getPathInfo();
		if('/ajout_vote_jour1/'.$id === $path){
			$vote1 = $meet_up->getVote_Jour1()+1;
			$meet_up->setVote_Jour1($vote1);
			$em->persist($meet_up);
			$em->flush();
		}
  		elseif('/ajout_vote_jour2/'.$id === $path){
			$vote2 = $meet_up->getVote_Jour2()+1;
			$meet_up->setVote_Jour2($vote2);
			$em->persist($meet_up);
			$em->flush();
		}
		elseif('/ajout_vote_jour3/'.$id === $path){
			$vote3 = $meet_up->getVote_Jour3()+1;
			$meet_up->setVote_Jour3($vote3);
			$em->persist($meet_up);
			$em->flush();
		}

		return $this->redirectToRoute('meet_up_view', array('id' => $meet_up->getId()));
	}

	 public function mesrencontresAction(){ 


      $findlistMeetUp = $this->getDoctrine() 
        ->getManager() 
        ->getRepository('MeetUpBundle:MeetUp') 
        ->findByUser($this->getUser()) 
      ; 
 
      $listMeetUp  = $this->get('knp_paginator')->paginate($findlistMeetUp, 
          $this->get('request')->query->get('page', 1)/*page number*/, 
          6/*limit per page*/ 
      ); 
      return $this->render('MeetUpBundle:MeetUp:mesrencontres.html.twig', array( 
        'listMeetUp' => $listMeetUp 
      )); 
  }   
	public function ajoutparticipanteAction($id){

		$user = $this->container->get('security.context')->getToken()->getUser();

    	$em = $this->getDoctrine()->getManager();
    	$meet_up = $em->getRepository('MeetUpBundle:MeetUp')->find($id);

    	if($meet_up->getListeparticipantes()->contains($user)){
    		throw new NotFoundHttpException("Déjà présent ");
    	}

    	$meet_up->addListeparticipante($user);
    	$user->addMeetup($meet_up);
    	$em->persist($meet_up);
    	$em->flush();

    	return $this->redirectToRoute('meet_up_view', array('id' => $meet_up->getId()));

	}

	public function suppressionparticipanteAction($id){

		$user = $this->container->get('security.context')->getToken()->getUser();

    	$em = $this->getDoctrine()->getManager();
    	$meet_up = $em->getRepository('MeetUpBundle:MeetUp')->find($id);

    	$meet_up->removeListeparticipante($user);
    	$user->removeMeetup($meet_up);
    	$em->persist($meet_up);
    	$em->flush();

    	return $this->redirectToRoute('meet_up_view', array('id' => $meet_up->getId()));

	}

	 public function rencontresavenirAction(){  
 
 
      $findlistMeetUp = $this->getDoctrine()  
        ->getManager()  
        ->getRepository('MeetUpBundle:MeetUp')  
        ->findByUser($this->getUser())  
      ;  
  
      $listMeetUp  = $this->get('knp_paginator')->paginate($findlistMeetUp,  
          $this->get('request')->query->get('page', 1)/*page number*/,  
          6/*limit per page*/  
      );  
      return $this->render('MeetUpBundle:MeetUp:rencontres_a_venir.html.twig', array(  
        'listMeetUp' => $listMeetUp  
      ));  
  }    

}

?>