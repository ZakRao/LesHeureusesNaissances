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

       

        $searchterm = $request->get('username');
        $em = $this->getDoctrine()->getEntityManager();

       $qb = $em->createQueryBuilder();
       $listUsers = $qb->select('u')->from('AppUserBundle\Entity\User', 'u')
      ->where( $qb->expr()->like('u.username', $qb->expr()->literal('%' . $searchterm . '%')) )
      ->getQuery()
      ->getResult();
          
       return $this->render('AppUserBundle:Profile:result.html.twig', array(
      'listUsers' => $listUsers
      ));
  


  }
}
?>