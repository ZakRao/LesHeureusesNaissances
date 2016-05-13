<?php


namespace AppUserBundle\Controller;
use AppUserBundle\Entity\Dispos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;
use AppUserBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class DisposController extends Controller
{

  public function edit_disposAction ()
  {
    $request = request::createFromGlobals();     

    $user = $this->container->get('security.context')->getToken()->getUser();

    $em = $this->getDoctrine()->getManager();

    $un = $request->request->get('1');
    $deux = $request->request->get('2');
    $trois = $request->request->get('3');
    $quatre = $request->request->get('4');
    $cinq = $request->request->get('5');
    $six = $request->request->get('6');
    $sept = $request->request->get('7');
    $huit = $request->request->get('8');
    $neuf = $request->request->get('9');
    $dix = $request->request->get('10');
    $onze = $request->request->get('11');
    $douze = $request->request->get('12');
    $treize = $request->request->get('13');
    $quatorze = $request->request->get('14');
    $quinze = $request->request->get('15');
    $seize = $request->request->get('16');
    $dix_sept = $request->request->get('17');
    $dix_huit = $request->request->get('18');
    $dix_neuf = $request->request->get('19');
    $vingt = $request->request->get('20');
    $vingt_un = $request->request->get('21');

   
      if($un ==  "1" ){
        $user->setLundiMatin(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($un == "0"){
        $user->setLundiMatin(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($deux ==  "1" ){
        $user->setLundiMidi(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($deux == "0"){
        $user->setLundiMidi(false);
        $em->persist($user);
        $em->flush();
        }

      if($trois ==  "1" ){
        $user->setLundiSoir(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($trois == "0"){
        $user->setLundiSoir(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($quatre ==  "1" ){
        $user->setMardiMatin(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($quatre == "0"){
        $user->setMardiMatin(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($cinq ==  "1" ){
        $user->setMardiMidi(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($cinq == "0"){
        $user->setMardiMidi(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($six ==  "1" ){
        $user->setMardiSoir(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($six == "0"){
        $user->setMardiSoir(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($sept ==  "1" ){
        $user->setMercrediMatin(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($sept == "0"){
        $user->setMercrediMatin(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($huit ==  "1" ){
        $user->setMercrediMidi(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($huit == "0"){
        $user->setMercrediMidi(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($neuf ==  "1" ){
        $user->setMercrediSoir(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($neuf == "0"){
        $user->setMercrediSoir(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($dix ==  "1" ){
        $user->setJeudiMatin(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($dix == "0"){
        $user->setJeudiMatin(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($onze ==  "1" ){
        $user->setJeudiMidi(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($onze == "0"){
        $user->setJeudiMidi(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($douze ==  "1" ){
        $user->setJeudiSoir(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($douze == "0"){
        $user->setJeudiSoir(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($treize ==  "1" ){
        $user->setVendrediMatin(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($treize == "0"){
        $user->setVendrediMatin(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($quatorze ==  "1" ){
        $user->setVendrediMidi(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($quatorze == "0"){
        $user->setVendrediMidi(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($quinze ==  "1" ){
        $user->setVendrediSoir(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($quinze == "0"){
        $user->setVendrediSoir(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($seize ==  "1" ){
        $user->setSamediMatin(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($seize == "0"){
        $user->setSamediMatin(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($dix_sept ==  "1" ){
        $user->setSamediMidi(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($dix_sept == "0"){
        $user->setSamediMidi(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($dix_huit ==  "1" ){
        $user->setSamediSoir(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($dix_huit == "0"){
        $user->setSamediSoir(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($dix_neuf ==  "1" ){
        $user->setDimancheMatin(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($dix_neuf == "0"){
        $user->setDimancheMatin(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($vingt ==  "1" ){
        $user->setDimancheMidi(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($vingt == "0"){
        $user->setDimancheMidi(false);
        $em->persist($user);
        $em->flush();
        
      }

      if($vingt_un ==  "1" ){
        $user->setDimancheSoir(true);
        $em->persist($user);
        $em->flush();
        
      }
      if($vingt_un == "0"){
        $user->setDimancheSoir(false);
        $em->persist($user);
        $em->flush();
        
      }


      if($un != null ){
        return $this->redirectToRoute('show', array('username' => $user));
      }

      
    //var_dump($listDispos->first());


    /*if(empty($listDispos)){
      $un = $request->request->get('1');
      $deux = $request->request->get('2');
      $trois = $request->request->get('3');
      $quatre = $request->request->get('4');
      $cinq = $request->request->get('5');
      $six = $request->request->get('6');
      $sept = $request->request->get('7');
      $huit = $request->request->get('8');
      $neuf = $request->request->get('9');
      $dix = $request->request->get('10');
      $onze = $request->request->get('11');
      $douze = $request->request->get('12');
      $treize = $request->request->get('13');
      $quatorze = $request->request->get('14');
      $quinze = $request->request->get('15');
      $seize = $request->request->get('16');
      $dix_sept = $request->request->get('17');
      $dix_huit = $request->request->get('18');
      $dix_neuf = $request->request->get('19');
      $vingt = $request->request->get('20');
      $vingt_un = $request->request->get('21');

      $dispo_un = new Dispos();
      $dispo_deux = new Dispos();
      $dispo_trois = new Dispos();
      $dispo_quatre = new Dispos();
      $dispo_cinq = new Dispos();
      $dispo_six = new Dispos();
      $dispo_sept = new Dispos();
      $dispo_huit = new Dispos();
      $dispo_neuf = new Dispos();
      $dispo_dix = new Dispos();
      $dispo_onze = new Dispos();
      $dispo_douze = new Dispos();
      $dispo_treize = new Dispos();
      $dispo_quatorze = new Dispos();
      $dispo_quinze = new Dispos();
      $dispo_seize = new Dispos();
      $dispo_dix_sept = new Dispos();
      $dispo_dix_huit = new Dispos();
      $dispo_dix_neuf = new Dispos();
      $dispo_vingt = new Dispos();
      $dispo_vingt_un = new Dispos();

      $dispo_un->setUser($user);
      $dispo_deux->setUser($user);
      $dispo_trois->setUser($user);
      $dispo_quatre->setUser($user);
      $dispo_cinq->setUser($user);
      $dispo_six->setUser($user);
      $dispo_sept->setUser($user);
      $dispo_huit->setUser($user);
      $dispo_neuf->setUser($user);
      $dispo_dix->setUser($user);
      $dispo_onze->setUser($user);
      $dispo_douze->setUser($user);
      $dispo_treize->setUser($user);
      $dispo_quatorze->setUser($user);
      $dispo_quinze->setUser($user);
      $dispo_seize->setUser($user);
      $dispo_dix_sept->setUser($user);
      $dispo_dix_huit->setUser($user);
      $dispo_dix_neuf->setUser($user);
      $dispo_vingt->setUser($user);
      $dispo_vingt_un->setUser($user);


      $dispo_un->setDisponibilite($un);
      $dispo_deux->setDisponibilite($deux);
      $dispo_trois->setDisponibilite($trois);
      $dispo_quatre->setDisponibilite($quatre);
      $dispo_cinq->setDisponibilite($cinq);
      $dispo_six->setDisponibilite($six);
      $dispo_sept->setDisponibilite($sept);
      $dispo_huit->setDisponibilite($huit);
      $dispo_neuf->setDisponibilite($neuf);
      $dispo_dix->setDisponibilite($dix);
      $dispo_onze->setDisponibilite($onze);
      $dispo_douze->setDisponibilite($douze);
      $dispo_treize->setDisponibilite($treize);
      $dispo_quatorze->setDisponibilite($quatorze);
      $dispo_quinze->setDisponibilite($quinze);
      $dispo_seize->setDisponibilite($seize);
      $dispo_dix_sept->setDisponibilite($dix_sept);
      $dispo_dix_huit->setDisponibilite($dix_huit);
      $dispo_dix_neuf->setDisponibilite($dix_neuf);
      $dispo_vingt->setDisponibilite($vingt);
      $dispo_vingt_un->setDisponibilite($vingt_un);

      $em->persist($dispo_un);
      $em->persist($dispo_deux);
      $em->persist($dispo_trois);
      $em->persist($dispo_quatre);
      $em->persist($dispo_cinq);
      $em->persist($dispo_six);
      $em->persist($dispo_sept);
      $em->persist($dispo_huit);
      $em->persist($dispo_neuf);
      $em->persist($dispo_dix);
      $em->persist($dispo_onze);
      $em->persist($dispo_douze);
      $em->persist($dispo_treize);
      $em->persist($dispo_quatorze);
      $em->persist($dispo_quinze);
      $em->persist($dispo_seize);
      $em->persist($dispo_dix_sept);
      $em->persist($dispo_dix_huit);
      $em->persist($dispo_dix_neuf);
      $em->persist($dispo_vingt);
      $em->persist($dispo_vingt_un);
      $em->flush();
    
      #get id de la dispo avec la value du champs "disponibilite qui vaut 1"

      
      var_dump("La liste été vide donc je l'ai rempli");
    }

  else{ 

      $un = $request->request->get('1');
      $deux = $request->request->get('2');
      $trois = $request->request->get('3');
      $quatre = $request->request->get('4');
      $cinq = $request->request->get('5');
      $six = $request->request->get('6');
      $sept = $request->request->get('7');
      $huit = $request->request->get('8');
      $neuf = $request->request->get('9');
      $dix = $request->request->get('10');
      $onze = $request->request->get('11');
      $douze = $request->request->get('12');
      $treize = $request->request->get('13');
      $quatorze = $request->request->get('14');
      $quinze = $request->request->get('15');
      $seize = $request->request->get('16');
      $dix_sept = $request->request->get('17');
      $dix_huit = $request->request->get('18');
      $dix_neuf = $request->request->get('19');
      $vingt = $request->request->get('20');
      $vingt_un = $request->request->get('21');

      $start = $user->getDisponibilites()->first()->getId();

      var_dump($start);

      foreach ($listDispos as $dispo) {

        if($dispo->getId() == $start){
          if($un == '1'){
            $dispo->setDisponibilite('1');
          }
          else{
            $dispo->setDisponibilite('0');
          }
          $em->persist($dispo);
        }
        if($dispo->getId() == $start+1){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+2){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+3){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+4){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+5){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+6){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+7){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+8){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+9){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+10){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+11){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+12){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+13){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+14){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+15){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+16){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+17){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+18){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+19){
          var_dump($dispo->getDisponibilite());
        }
        if($dispo->getId() == $start+20){
          var_dump($dispo->getDisponibilite());
        }

      
      $em->flush();
    

      }
   

    var_dump("La liste est pleine donc je la met a jour avec les valeurs du form");*/
  //}
    
    //$dispo->setUser($user);
    //$dispo->setDisponibilite($un);

    


    return $this->render('AppUserBundle:Profile:edit_dispos.html.twig');    
  }

}