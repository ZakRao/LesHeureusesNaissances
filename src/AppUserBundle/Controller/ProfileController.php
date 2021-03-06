<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppUserBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use AppUserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\UserBundle\Controller\ProfileController as BaseController;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends BaseController
{
   /**
 * @ParamConverter("post", class="AppUserBundle:User", options={"username" = "user"})
 */
    public function showAction(User $user = null )
    {
        $connecter = $this->container->get('security.context')->getToken()->getUser();
        if($connecter->getDescription()==null){


             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

    }
        
        $listMeetUp = $this->getDoctrine()
          ->getManager()
          ->getRepository('MeetUpBundle:MeetUp')
          ->findByUser($user)
        ;
       
        if( $user === null ) {
            $user = $this->getUser();
            if (!is_object($user) || !$user instanceof UserInterface) {
                throw new AccessDeniedException('This user does not have access to this section.');
            }
        }

        
return $this->container->get('templating')->renderResponse('AppUserBundle:Profile:show.html.'.$this->container->getParameter('fos_user.template.engine'), array('user' => $user,
                                                                                                                                                                'listMeetUp'=> $listMeetUp               ));
    }


    public function profilAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        if($user->getDescription()==null){


             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

    }

         $listMeetUp = $this->getDoctrine()
          ->getManager()
          ->getRepository('MeetUpBundle:MeetUp')
          ->findByUser($user)
        ;

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->container->get('templating')->renderResponse('AppUserBundle:Profile:show.html.'.$this->container->getParameter('fos_user.template.engine'), array('user' => $user, 'listMeetUp'=> $listMeetUp ));
    }

    
    /**
     * Edit the user
     */
    public function editAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->container->get('fos_user.profile.form');
        $formHandler = $this->container->get('fos_user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('fos_user_success', 'profile.flash.updated');

             return new RedirectResponse($this->getRedirectionUrl($user));    
        }

        return $this->container->get('templating')->renderResponse(
            'FOSUserBundle:Profile:edit.html.'.$this->container->getParameter('fos_user.template.engine'),
            array('form' => $form->createView())
        );
    }

    /**
     * Generate the redirection url when editing is completed.
     *
     * @param \FOS\UserBundle\Model\UserInterface $user
     *
     * @return string
     */
    protected function getRedirectionUrl(UserInterface $user)
    {
        return $this->container->get('router')->generate('profile');
    }

    /**
     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value)
    {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }

    protected function getDoctrine()
{
    if (!$this->container->has('doctrine')) {
        throw new \LogicException('The DoctrineBundle is not registered in your application.');
    }

    return $this->container->get('doctrine');
}


}
