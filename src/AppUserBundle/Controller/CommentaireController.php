<?php


namespace AppUserBundle\Controller;
use AppUserBundle\Entity\Commentaire;
use AppBundle\Entity\Image;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use AppUserBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class CommentaireController extends Controller
{

  /**
 * @ParamConverter("post", class="AppUserBundle:User", options={"username" = "user"})
 */
  public function add_CommentaireAction (User $user, Request $request)
  {

    $auteur = $this->container->get('security.context')->getToken()->getUser(); 
    $commentaire = new Commentaire();


     if (null === $user) {
      throw new NotFoundHttpException("L'user n'existe pas.");
    }

      else{
      $request = request::createFromGlobals();

      $req = $request->request->get('commentaire');
      $file = $request->files->get('image');

      $image = new Image();
      if(!empty($file)){
      $image->setFile($file);
    }
      else{
        $image=null;
      }




      $commentaire->setAuteur($auteur->getUsername());
      $commentaire->setUser($user);
      $commentaire->setContenu($req);
      $commentaire->setImage($image);
      $user->addCommentaire($commentaire );

      $em = $this->getDoctrine()->getManager();
      $em->persist($commentaire);
      $em->flush();

}
  return $this->redirectToRoute('show', array('username' => $user));    


    }



  

  public function delete_CommentaireAction($id, Request $request)
  {

  $user = $this->container->get('security.context')->getToken()->getUser();
    $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $commentaire = $em->getRepository('AppUserBundle:Commentaire')->find($id);

    if (null === $commentaire) {
      throw new NotFoundHttpException("Le commentaire  d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
  
      $em->remove($commentaire);
      $em->flush();

    return $this->redirectToRoute('show', array('username' => $user));    
      
  

}

}