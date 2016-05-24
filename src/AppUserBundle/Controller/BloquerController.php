<?php
// src/OC/UserBundle/Controller/SecurityController.php;

namespace AppUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class BloquerController extends Controller
{

  
  public function bloquerAction (Request $request)
  {
    $user = $this->container->get('security.context')->getToken()->getUser();

      $em = $this->getDoctrine()->getManager();

      $user->setEnabled("0");
       $recipient = $user->getEmailCanonical();

      $messagemail = \Swift_Message::newInstance()
            ->setSubject('Vous avez demandé à bloquer votre compte ')

            //Mettre l'adresse mail des Heureuses naissances à la place de la mienne!!
            ->setFrom($this->getParameter('mailer_user')) 
            ->setTo($recipient)
            ->setCharset('utf-8')
            ->setBody(
                $this->container->get('templating')->render(
                    'MessagerieBundle:Emails:notification_commentaire.html.twig'
                ),
                'text/html'
            );
                            
            $this->container->get('mailer')->send($messagemail);

      $em->persist($user);
      $em->flush();

     

      return $this->redirectToRoute('fos_user_security_logout');

  
  }

  


}