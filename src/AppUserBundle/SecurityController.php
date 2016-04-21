<?php
// src/OC/UserBundle/Controller/SecurityController.php;

namespace AppUserBundle\Controller;
use AppUserBundle\Entity\Enfant;
use AppUserBundle\Form\Type\EnfantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\SecurityContext;


class SecurityController extends Controller
{

  public function loginAction()
    {
        $request = $this->container->get('request');
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $session = $request->getSession();
        /* @var $session \Symfony\Component\HttpFoundation\Session\Session */

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        if ($error) {
            // TODO: this is a potential security risk (see http://trac.symfony-project.org/ticket/9523)
            $error = $error->getMessage();
        }
        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContext::LAST_USERNAME);

        $csrfToken = $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate');

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf_token' => $csrfToken,
        ));
    }

  public function add_enfantAction (Request $request)
  {
  
    $enfant = new Enfant();
        $form = $this->createForm(EnfantType::class, $enfant);
        
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

           // Associate User Entity To Product 
            $user = $this->container->get('security.context')->getToken()->getUser();
            $enfant->setUser($user);

            $em->persist($enfant);
            $em->flush();

            return $this->container->get('templating')->renderResponse('FOSUserBundle:Profile:show.html.twig', array('user' => $user)); 
        }

        return $this->render('AppUserBundle:Profile:add_enfant.html.twig', array(
            'enfant' => $enfant,
            'form'   => $form->createView(),
        ));
  
  
  
  }


}