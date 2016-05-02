<?php  
namespace AppUserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{

  public function searchAction(Request $request){
       $request = Request::createFromGlobals();

       $req = $request->request->get('username');

       
       $listUsers = $this->getDoctrine()
      ->getManager()
      ->getRepository('AppUserBundle:User')
      ->findByUsername($req);                      // À partir du premie 


        $listUsersByDpt = $this->getDoctrine()
          ->getManager()
          ->getRepository('AppUserBundle:User')
          ->findByDepartement($req); 


      if($listUsers) {
        
       return $this->render('AppUserBundle:Profile:result.html.twig', array(
      'listUsers' => $listUsers
      ));

       }

       else {
         return $this->render('AppUserBundle:Profile:resultDpt.html.twig', array(
      'listUsersByDpt' => $listUsersByDpt
      ));
        

       } 

  }
}
?>