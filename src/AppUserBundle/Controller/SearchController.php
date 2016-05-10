<?php  
namespace AppUserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MeetUpBundle\Entity\MeetUp;

class SearchController extends Controller
{

  public function searchAction(Request $request){

     $user = $this->container->get('security.context')->getToken()->getUser();
     if($user->getDescription()==null){


            return $this->redirectToRoute('fos_user_profile_edit');

    }
       $request = Request::createFromGlobals();

       $req = $request->request->get('username');

       
       $listUsers = $this->getDoctrine()
      ->getManager()
      ->getRepository('AppUserBundle:User')
      ->findByUsername($req);                      // À partir du premie 

       $listMeetUps = $this->getDoctrine()
      ->getManager()
      ->getRepository('MeetUpBundle:MeetUp')
      ->findByTitre($req);                      


        $listMeetUpsByDpt = $this->getDoctrine()
          ->getManager()
          ->getRepository('MeetUpBundle:MeetUp')
          ->findByDepartement($req); 


        /*$listUsersByDpt = $this->getDoctrine()
          ->getManager()
          ->getRepository('AppUserBundle:User')
          ->findByDepartement($req); 


      if($listUsers) {*/
        
       return $this->render('AppUserBundle:Profile:result.html.twig', array(
      'listUsers' => $listUsers,
      'listMeetUps' => $listMeetUps,
      'listUsersByDpt' => $listMeetUpsByDpt
      ));

      /* }

       else {
         return $this->render('AppUserBundle:Profile:resultDpt.html.twig', array(
      'listUsersByDpt' => $listUsersByDpt
      ));
        

       }*/ 

  }
}
?>