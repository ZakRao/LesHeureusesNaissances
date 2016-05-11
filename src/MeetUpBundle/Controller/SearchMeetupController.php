<?php  
namespace MeetUpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MeetUpBundle\Entity\MeetUp;

class SearchMeetupController extends Controller
{

  public function searchAction(Request $request){

     $user = $this->container->get('security.context')->getToken()->getUser();
     if($user->getDescription()==null){


            return $this->redirectToRoute('fos_user_profile_edit');

    }
       $request = Request::createFromGlobals();

       $req = $request->request->get('departement');

      /* $listMeetUps = $this->getDoctrine()
      ->getManager()
      ->getRepository('MeetUpBundle:MeetUp')
      ->findByTitre($req); 
*/
               

        var_dump($req);
        $listMeetUpsByDpt = $this->getDoctrine()
          ->getManager()
          ->getRepository('MeetUpBundle:MeetUp')
          ->findByDepartement($req); 

          $listMeetUp  = $this->get('knp_paginator')->paginate($listMeetUpsByDpt, 
          $this->get('request')->query->get('page', 1)/*page number*/, 
          2/*limit per page*/  );           

        /*$listUsersByDpt = $this->getDoctrine()
          ->getManager()
          ->getRepository('AppUserBundle:User')
          ->findByDepartement($req); 


      if($listUsers) {*/
        
       return $this->render('MeetUpBundle:MeetUp:lesrencontres.html.twig', array(
      'listMeetUp' => $listMeetUp));

      /* }

       else {
         return $this->render('AppUserBundle:Profile:resultDpt.html.twig', array(
      'listUsersByDpt' => $listUsersByDpt
      ));
        

       }*/ 

  }
}
?>