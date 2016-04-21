<?php
// src/OC/PlatformBundle/Controller/AdvertController.php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Advert;
use AppBundle\Form\AdvertType;
use AppBundle\Form\AdvertEditType;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdvertController extends Controller
{
  public function indexAction($page)
  {
    if ($page < 1) {
      throw $this->createNotFoundException("La page ".$page." n'existe pas.");
    }

    // Pour récupérer la liste de toutes les annonces : on utilise findAll()
    $listAdverts = $this->getDoctrine()
      ->getManager()
      ->getRepository('AppBundle:Advert')
      ->findAll()
    ;

    // L'appel de la vue ne change pas
    return $this->render('AppBundle:Advert:index.html.twig', array(
      'listAdverts' => $listAdverts
    ));
  }

  public function viewAction($id)
  {
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // Pour récupérer une annonce unique : on utilise find()
    $advert = $em->getRepository('AppBundle:Advert')->find($id);

    // On vérifie que l'annonce avec cet id existe bien
    if ($advert === null) {
      throw $this->createNotFoundException("L'annonce d'id ".$id." n'existe pas.");
    }

    // On récupère la liste des advertSkill pour l'annonce $advert
    $listAdvertSkills = $em->getRepository('AppBundle:AdvertSkill')->findByAdvert($advert);

    // Puis modifiez la ligne du render comme ceci, pour prendre en compte les variables :
    return $this->render('AppBundle:Advert:view.html.twig', array(
      'advert'           => $advert,
      'listAdvertSkills' => $listAdvertSkills,
    ));
  }

 

  public function addAction(Request $request)
  {
   

    $advert = new Advert();
    $form = $this->createForm(AdvertType::class, $advert);

    if ($form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($advert);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
    }
    // On passe la méthode createView() du formulaire à la vue
    // afin qu'elle puisse afficher le formulaire toute seule
    return $this->render('AppBundle:Advert:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }


  public function editAction($id, Request $request)
  {
    // On récupère l'EntityManager
    $em = $this->getDoctrine()->getManager();

    // On récupère l'entité correspondant à l'id $id
    $advert = $em->getRepository('AppBundle:Advert')->find($id);

   if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }

    $form = $this->createForm(AdvertEditType::class, $advert);

    if ($form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');

      return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
    }

    return $this->render('AppBundle:Advert:edit.html.twig', array(
      'form'   => $form->createView(),
      'advert' => $advert // Je passe également l'annonce à la vue si jamais elle veut l'afficher
    ));
  }

  public function deleteAction($id, Request $request)
  {
     $em = $this->getDoctrine()->getManager();

    // On récupère l'annonce $id
    $advert = $em->getRepository('AppBundle:Advert')->find($id);

    if (null === $advert) {
      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($advert);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");

      return $this->redirect($this->generateUrl('oc_platform_home'));
    }

    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
    return $this->render('AppBundle:Advert:delete.html.twig', array(
      'advert' => $advert,
      'form'   => $form->createView()
    ));
  }

  public function menuAction($limit = 3)
  {
    $listAdverts = $this->getDoctrine()
      ->getManager()
      ->getRepository('AppBundle:Advert')
      ->findBy(
        array(),                 // Pas de critère
        array('date' => 'desc'), // On trie par date décroissante
        $limit,                  // On sélectionne $limit annonces
        0                        // À partir du premier
    );

    return $this->render('AppBundle:Advert:menu.html.twig', array(
      'listAdverts' => $listAdverts
    ));
  }

  public function testAction()
  {
    return $this->render('AppBundle:Advert:test.html.twig'
      );
  }

   public function connexionAction()
  {
    return $this->render('AppBundle:Advert:connexion.html.twig'
      );
  }

   public function inscriptionAction()
  {
    return $this->render('AppBundle:Advert:inscription.html.twig'
    );
  }

  public function inscription2Action()
  {
    return $this->render('AppBundle:Advert:inscription2.html.twig'
    );
  }

}