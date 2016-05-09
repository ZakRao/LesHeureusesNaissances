<?php

namespace MessagerieBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\MessageBundle\Provider\ProviderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use MessagerieBundle\Entity\Thread;

//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;




class MessageController extends ContainerAware
{


    public function indexAction()
    {
        return $this->container->get('templating')->renderResponse('MessagerieBundle:Message:formreplytest.html.twig');
    }


    /**
     * Displays the authenticated participant inbox
	 *
     * @return Response
     */
    public function inboxAction()
    {
        $threads = $this->getProvider()->getInboxThreads();

        $user = $this->container->get('security.context')->getToken()->getUser();
        

         if($user->getDescription()==null){

             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

        }

        return $this->container->get('templating')->renderResponse('MessagerieBundle:Message:inbox.html.twig', array(
            'threads' => $threads
        ));
    }

    /**
     * Displays the authenticated participant messages sent
     *
     * @return Response
     */
    public function sentAction()
    {
        $threads = $this->getProvider()->getSentThreads();

        $user = $this->container->get('security.context')->getToken()->getUser();
        

         if($user->getDescription()==null){

             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

        }

        return $this->container->get('templating')->renderResponse('MessagerieBundle:Message:sent.html.twig', array(
            'threads' => $threads
        ));
    }

    /**
     * Displays the authenticated participant deleted threads
     *
     * @return Response
     */
    public function deletedAction()
    {
        $threads = $this->getProvider()->getDeletedThreads();


        $user = $this->container->get('security.context')->getToken()->getUser();
        

         if($user->getDescription()==null){

             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

        }

        return $this->container->get('templating')->renderResponse('MessagerieBundle:Message:deleted.html.twig', array(
            'threads' => $threads
        ));
    }

    /**
     * Displays a thread, also allows to reply to it
     *
     * @param string $threadId the thread id
     * 
     * @return Response
     */
    public function threadAction($threadId)
    {
        $thread = $this->getProvider()->getThread($threadId);
        $form = $this->container->get('fos_message.reply_form.factory')->create($thread);
        $formHandler = $this->container->get('fos_message.reply_form.handler');


        $user = $this->container->get('security.context')->getToken()->getUser();
        

         if($user->getDescription()==null){

             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

        }


        //Mail 
        if ($message = $formHandler->process($form)) {

            //echo (print_r($thread->getParticipants()));

            //TODO Remplacer $mailrecipient il faut récupérer le destinataire dans la boite de reception, pas dans le formulaire
            /*$mailRecipient = $form->get('recipient')->getData()->getEmailCanonical(); 

            $messagemail = \Swift_Message::newInstance()
                ->setSubject('Message reçu')

                //TODO Mettre l'adresse mail des Heureuses naissances à la place de la mienne !!
                ->setFrom(array('mbey.emmanuel@gmail.com' => "Les Heureuses Naissances")) 

                ->setTo($mailRecipient)
                ->setCharset('utf-8')
                ->setBody(
                    $this->container->get('templating')->render(
                        'MessagerieBundle:Emails:notification.html.twig'
                    ),
                    'text/html'
                );
                            
            $this->container->get('mailer')->send($messagemail);*/

            //Page de redirection
            return new RedirectResponse($this->container->get('router')->generate('fos_message_thread_view', array(
                'threadId' => $message->getThread()->getId()
            )));
        }
        //Formulaire d'envoi
        return $this->container->get('templating')->renderResponse('MessagerieBundle:Message:thread.html.twig', array(
            'form' => $form->createView(),
            'thread' => $thread
        ));
    }

    /**
     * Create a new message thread
     *
     * @return Response
     */
    public function newThreadAction()
    {

        $form = $this->container->get('fos_message.new_thread_form.factory')->create();
        $formHandler = $this->container->get('fos_message.new_thread_form.handler');


        $user = $this->container->get('security.context')->getToken()->getUser();
        

         if($user->getDescription()==null){

             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

        }
        
      

        //Bloc du mail 
        if ($message = $formHandler->process($form)) {
    
           $mailRecipient = $form->get('recipient')->getData()->getEmailCanonical(); 
           $messagemail = \Swift_Message::newInstance()
            ->setSubject('Message reçu')

            //Mettre l'adresse mail des Heureuses naissances à la place de la mienne!!
            ->setFrom(array('mbey.emmanuel@gmail.com' => "Les Heureuses Naissances")) 

            ->setTo($mailRecipient)
            ->setCharset('utf-8')
            ->setBody(
                $this->container->get('templating')->render(
                    'MessagerieBundle:Emails:notification.html.twig'
                ),
                'text/html'
            );
                            
            $this->container->get('mailer')->send($messagemail);

            //Message d'alerte 
            $this->container->get('session')->getFlashBag()->add(
                'notice',
                'Votre message a bien été envoyé !'
            );

            //Redirection
            return new RedirectResponse($this->container->get('router')->generate('fos_message_thread_view', array(
                'threadId' => $message->getThread()->getId()
            )));
        }
        //Formulaire du nouveau message
        return $this->container->get('templating')->renderResponse('MessagerieBundle:Message:newThread.html.twig', array(
            'form' => $form->createView(),
            'data' => $form->getData()
        ));
    }

    /**
     * Deletes a thread
     * 
     * @param string $threadId the thread id
     * 
     * @return RedirectResponse
     */
    public function deleteAction($threadId)
    {
        $thread = $this->getProvider()->getThread($threadId);
        $this->container->get('fos_message.deleter')->markAsDeleted($thread);
        $this->container->get('fos_message.thread_manager')->saveThread($thread);


        $user = $this->container->get('security.context')->getToken()->getUser();
        

         if($user->getDescription()==null){

             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

        }

        return new RedirectResponse($this->container->get('router')->generate('fos_message_inbox'));
    }
    
    /**
     * Undeletes a thread
     * 
     * @param string $threadId
     * 
     * @return RedirectResponse
     */
    public function undeleteAction($threadId)
    {
        $thread = $this->getProvider()->getThread($threadId);
        $this->container->get('fos_message.deleter')->markAsUndeleted($thread);
        $this->container->get('fos_message.thread_manager')->saveThread($thread);


        $user = $this->container->get('security.context')->getToken()->getUser();
        

         if($user->getDescription()==null){

             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

        }

        return new RedirectResponse($this->container->get('router')->generate('fos_message_inbox'));
    }

    /**
     * Searches for messages in the inbox and sentbox
     *
     * @return Response
     */
    public function searchAction()
    {
        $query = $this->container->get('fos_message.search_query_factory')->createFromRequest();
        $threads = $this->container->get('fos_message.search_finder')->find($query);

        
        $user = $this->container->get('security.context')->getToken()->getUser();
        

         if($user->getDescription()==null){

             return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));

        }

        return $this->container->get('templating')->renderResponse('MessagerieBundle:Message:search.html.twig', array(
            'query' => $query,
            'threads' => $threads
        ));
    }

    /**
     * Gets the provider service
     *
     * @return ProviderInterface
     */
    protected function getProvider()
    {
        return $this->container->get('fos_message.provider');
    }

     public function getDoctrine()
 {
    if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application.');
 }
 
    return $this->container->get('doctrine');
 }

    
}
