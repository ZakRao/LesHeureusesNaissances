<?php  
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SearchMamanController extends Controller
{

  public function searchAction(Request $request){

       $request = Request::createFromGlobals();

       $req = $request->request->get('departement');

            
        $listMaman = $this->getDoctrine()
          ->getManager()
          ->getRepository('AppUserBundle:User')
          ->findByDepartement($req); 

          $listMaman  = $this->get('knp_paginator')->paginate($listMaman, 
          $this->get('request')->query->get('page', 1)/*page number*/, 
          2/*limit per page*/  );           

      
        
       return $this->render('AppUserBundle:Profile:result_off.html.twig', array(
      'listMaman' => $listMaman));

    

  }
}
?>