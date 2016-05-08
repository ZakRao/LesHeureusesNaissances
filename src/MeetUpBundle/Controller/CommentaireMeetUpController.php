<?php


namespace MeetUpBundle\Controller;
use MeetUpBundle\Entity\CommentaireMeetUp;
use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use MeetUpBundle\Entity\MeetUp;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class CommentaireMeetUpController extends Controller
{


public function add_CommentaireMeetUpAction (MeetUp $meetup, Request $request)
  {
    $auteur = $this->container->get('security.context')->getToken()->getUser(); 
    $em = $this->getDoctrine()->getManager();
   

    $commentaireMeetUp = new CommentaireMeetUp();


     if (null === $meetup) {
      throw new NotFoundHttpException("La Rencontre n'existe pas.");
    }

      else{
      $request = request::createFromGlobals();

      $req = $request->request->get('commentaire');

      $commentaireMeetUp->setAuteur($auteur->getUsername());
      $commentaireMeetUp->setMeetup($meetup);
      $commentaireMeetUp->setContenu($req);
      $meetup->addCommentaireMeetUp($commentaireMeetUp);

      $em->persist($commentaireMeetUp);
      $em->flush();

    }
    return $this->redirectToRoute('meet_up_view', array('id' => $meetup->getId()));
    }


  public function delete_CommentaireMeetUpAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();


    // On récupère l'annonce $id
    $commentaireMeetUp = $em->getRepository('MeetUpBundle:CommentaireMeetUp')->find($id);

    if (null === $commentaireMeetUp) {
      throw new NotFoundHttpException("Le commentaire meet up  d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
  
      $em->remove($commentaireMeetUp);
      $em->flush();

    return $this->redirectToRoute('meet_up_view', array('id' => $meetup));
}

}