<?php

namespace AppUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\MessageBundle\Model\ParticipantInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppUserBundle\Repository\UserRepository")
 */
class User extends BaseUser implements ParticipantInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;


    /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $parrain;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $prenom;

     /**
     * @ORM\Column(type="string",nullable=true)
     */
    protected $adresse;

    /**
     * @ORM\Column(type="string",nullable = true )
     */
    protected $telephone;

    /**
     * @ORM\Column(type="string", nullable = true )
     */
    protected $ville;

    /**
     * @ORM\Column(type="string", nullable = true )
     */
    protected $departement;


    /**
     * @ORM\Column(type="string" , nullable = true )
     */
    protected $loca;


    /**
     * @ORM\Column(type="string", nullable = true )
     */
    protected $profession;


    /**
     * @ORM\Column(name="datef", type="date", nullable = true )
     */
    private $datef;



    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $enceinte;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $personnalite;


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $description;

    /**
     * @ORM\OneToMany(targetEntity="AppUserBundle\Entity\Enfant", mappedBy="user",cascade={"persist"})
     */
    private $enfants;


    /**
     * @ORM\OneToMany(targetEntity="AppUserBundle\Entity\Commentaire", mappedBy="user", cascade={"persist"})
     */
    private $commentaires; // Notez le « s », une annonce est liée à plusieurs commentaires

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="anniversaire", type="date", nullable=true)
     */
    private $anniversaire;

    /**
     * @ORM\ManyToMany (targetEntity="MeetUpBundle\Entity\MeetUp", cascade={"persist"}, inversedBy="listeparticipantes")
     *
     */
    private $meetups;


    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Lundi_Matin = '0' ;

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Lundi_Midi = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Lundi_Soir = '0' ;

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Mardi_Matin = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Mardi_Midi = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Mardi_Soir = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Mercredi_Matin = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Mercredi_Midi = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Mercredi_Soir = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Jeudi_Matin = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Jeudi_Midi = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Jeudi_Soir = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Vendredi_Matin = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Vendredi_Midi = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Vendredi_Soir = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Samedi_Matin = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Samedi_Midi = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Samedi_Soir = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Dimanche_Matin = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Dimanche_Midi = '0';

    /**
     * @ORM\Column(type="boolean" , nullable = true )
     */
    protected $Dimanche_Soir = '0';

    /**
     * @ORM\ManyToMany(targetEntity="MeetUpBundle\Entity\Vote1", mappedBy="vote1users") 
     *
     * 
     */
    private $users1vote;

    /**
     * @ORM\ManyToMany(targetEntity="MeetUpBundle\Entity\Vote2", mappedBy="vote2users") 
     *
     * 
     */
    private $users2vote;

    /**
     * @ORM\ManyToMany(targetEntity="MeetUpBundle\Entity\Vote3", mappedBy="vote3users") 
     *
     * 
     */
    private $users3vote;


    public function __construct()
  {
    parent::__construct();
    $this->enfants   = new ArrayCollection();
    $this->commentaires = new ArrayCollection();
}


   // Notez le singulier, on ajoute un seul enfant à la fois
  public function addEnfant(Enfant $enfant)
  {
    // Ici, on utilise l'ArrayCollection vraiment comme un tableau
    $this->enfants[] = $enfant;
    
    $enfant->setUser($this);

    return $this;
  }

  public function removeEnfant(Enfant $enfant)
  {
    // Ici on utilise une méthode de l'ArrayCollection, pour supprimer l'enfant en argument
    $this->enfants->removeElement($enfant);
  }

  // Notez le pluriel, on récupère une liste d'enfants ici !
  public function getEnfants()
  {
    return $this->enfants;
  }


    /**
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return User
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    
    public function getNom(){
        return $this->nom;
    }
    
    public function setNom($nom){
        $this->nom = $nom;
        return $this;
    }
    

    public function getAdresse(){
        return $this->adresse;
    }
    
    public function setAdresse($adresse){
        $this->adresse = $adresse;
        return $this;
    }

    
    
    
    public function getTelephone(){
        return $this->telephone;
    }
    
    public function setTelephone($telephone){
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set parrain
     *
     * @param string $parrain
     *
     * @return User
     */
    public function setParrain($parrain)
    {
        $this->parrain = $parrain;

        return $this;
    }

    /**
     * Get parrain
     *
     * @return string
     */
    public function getParrain()
    {
        return $this->parrain;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return User
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set departement
     *
     * @param string $departement
     *
     * @return User
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set precision
     *
     * @param string $precision
     *
     * @return User
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;

        return $this;
    }

    /**
     * Get precision
     *
     * @return string
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Set profession
     *
     * @param string $profession
     *
     * @return User
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }



    /**
     * Set datef
     *
     * @param \DateTime $datef
     *
     * @return User
     */
    public function setDatef($datef)
    {
        $this->datef = $datef;

        return $this;
    }

    /**
     * Get datef
     *
     * @return \DateTime
     */
    public function getDatef()
    {
        return $this->datef;
    }

    /**
     * Set enceinte
     *
     * @param string $enceinte
     *
     * @return User
     */
    public function setEnceinte($enceinte)
    {
        $this->enceinte = $enceinte;

        return $this;
    }

    /**
     * Get enceinte
     *
     * @return string
     */
    public function getEnceinte()
    {
        return $this->enceinte;
    }

    /**
     * Set personnalite
     *
     * @param array $personnalite
     *
     * @return User
     */
    public function setLoca($personnalite)
    {
        $this->personnalite = $personnalite;

        return $this;
    }

    /**
     * Get personnalite
     *
     * @return array
     */
    public function getLoca()
    {
        return $this->personnalite;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set personnalite
     *
     * @param string $personnalite
     *
     * @return User
     */
    public function setPersonnalite($personnalite)
    {
        $this->personnalite = $personnalite;

        return $this;
    }

    /**
     * Get personnalite
     *
     * @return string
     */
    public function getPersonnalite()
    {
        return $this->personnalite;
    }

    /**
   * @param Commentaire $commentaire
   * @return Commentaire
   */
  public function addCommentaire(Commentaire $commentaire)
  {
    $this->commentaire[] = $commentaire;

    // On lie l'annonce à la candidature
    $commentaire->setUser($this);

    return $this;
  }

  /**
   * @param Commentaire $commentaire
   */
  public function removeCommentaire(Commentaire $commentaire)
  {
    $this->commentaire->removeElement($commentaire);

    // Et si notre relation était facultative (nullable=true, ce qui n'est pas notre cas ici attention) :
    // $commentaire->setUser(null);
  }

  /**
   * @return ArrayCollection
   */
  public function getCommentaires()
  {
    return $this->commentaires;
  }

   public function increaseCommentaire()
  {
    $this->nbCommentaires++;
  }

  public function decreaseCommentaire()
  {
    $this->nbCommentaires--;
  }


  /**
     * Set anniversaire
     *
     * @param \DateTime $anniversaire
     *
     * @return Enfant
     */
    public function setAnniversaire($anniversaire)
    {
        $this->anniversaire = $anniversaire;

        return $this;
    }

    /**
     * Get anniversaire
     *
     * @return \DateTime
     */
    public function getAnniversaire()
    {
        return $this->anniversaire;
    }

    public function getAge()
    {
        $dateInterval = $this->anniversaire->diff(new \DateTime());
 
        return $dateInterval->y;
    }


    /**
     * Add meetup
     *
     * @param \MeetUpBundle\Entity\MeetUp $meetup
     *
     * @return User
     */
    public function addMeetup(\MeetUpBundle\Entity\MeetUp $meetup)
    {
        $this->meetups[] = $meetup;

        return $this;
    }

    /**
     * Remove meetup
     *
     * @param \MeetUpBundle\Entity\MeetUp $meetup
     */
    public function removeMeetup(\MeetUpBundle\Entity\MeetUp $meetup)
    {
        $this->meetups->removeElement($meetup);
    }

    /**
     * Get meetups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetups()
    {
        return $this->meetups;
    }

    /**
     * Set dispos
     *
     * @param \AppUserBundle\Entity\Dispos $dispos
     *
     * @return User
     */
    public function setDispos(\AppUserBundle\Entity\Dispos $dispos = null)
    {
        $this->dispos = $dispos;

        return $this;
    }

    /**
     * Get dispos
     *
     * @return \AppUserBundle\Entity\Dispos
     */
    public function getDispos()
    {
        return $this->dispos;
    }

    /**
     * Set lundiMatin
     *
     * @param boolean $lundiMatin
     *
     * @return User
     */
    public function setLundiMatin($lundiMatin)
    {
        $this->Lundi_Matin = $lundiMatin;

        return $this;
    }

    /**
     * Get lundiMatin
     *
     * @return boolean
     */
    public function getLundiMatin()
    {
        return $this->Lundi_Matin;
    }

    /**
     * Set lundiMidi
     *
     * @param boolean $lundiMidi
     *
     * @return User
     */
    public function setLundiMidi($lundiMidi)
    {
        $this->Lundi_Midi = $lundiMidi;

        return $this;
    }

    /**
     * Get lundiMidi
     *
     * @return boolean
     */
    public function getLundiMidi()
    {
        return $this->Lundi_Midi;
    }

    /**
     * Set lundiSoir
     *
     * @param boolean $lundiSoir
     *
     * @return User
     */
    public function setLundiSoir($lundiSoir)
    {
        $this->Lundi_Soir = $lundiSoir;

        return $this;
    }

    /**
     * Get lundiSoir
     *
     * @return boolean
     */
    public function getLundiSoir()
    {
        return $this->Lundi_Soir;
    }

    /**
     * Set mardiMatin
     *
     * @param boolean $mardiMatin
     *
     * @return User
     */
    public function setMardiMatin($mardiMatin)
    {
        $this->Mardi_Matin = $mardiMatin;

        return $this;
    }

    /**
     * Get mardiMatin
     *
     * @return boolean
     */
    public function getMardiMatin()
    {
        return $this->Mardi_Matin;
    }

    /**
     * Set mardiMidi
     *
     * @param boolean $mardiMidi
     *
     * @return User
     */
    public function setMardiMidi($mardiMidi)
    {
        $this->Mardi_Midi = $mardiMidi;

        return $this;
    }

    /**
     * Get mardiMidi
     *
     * @return boolean
     */
    public function getMardiMidi()
    {
        return $this->Mardi_Midi;
    }

    /**
     * Set mardiSoir
     *
     * @param boolean $mardiSoir
     *
     * @return User
     */
    public function setMardiSoir($mardiSoir)
    {
        $this->Mardi_Soir = $mardiSoir;

        return $this;
    }

    /**
     * Get mardiSoir
     *
     * @return boolean
     */
    public function getMardiSoir()
    {
        return $this->Mardi_Soir;
    }

    /**
     * Set mercrediMatin
     *
     * @param boolean $mercrediMatin
     *
     * @return User
     */
    public function setMercrediMatin($mercrediMatin)
    {
        $this->Mercredi_Matin = $mercrediMatin;

        return $this;
    }

    /**
     * Get mercrediMatin
     *
     * @return boolean
     */
    public function getMercrediMatin()
    {
        return $this->Mercredi_Matin;
    }

    /**
     * Set mercrediMidi
     *
     * @param boolean $mercrediMidi
     *
     * @return User
     */
    public function setMercrediMidi($mercrediMidi)
    {
        $this->Mercredi_Midi = $mercrediMidi;

        return $this;
    }

    /**
     * Get mercrediMidi
     *
     * @return boolean
     */
    public function getMercrediMidi()
    {
        return $this->Mercredi_Midi;
    }

    /**
     * Set mercrediSoir
     *
     * @param boolean $mercrediSoir
     *
     * @return User
     */
    public function setMercrediSoir($mercrediSoir)
    {
        $this->Mercredi_Soir = $mercrediSoir;

        return $this;
    }

    /**
     * Get mercrediSoir
     *
     * @return boolean
     */
    public function getMercrediSoir()
    {
        return $this->Mercredi_Soir;
    }

    /**
     * Set jeudiMatin
     *
     * @param boolean $jeudiMatin
     *
     * @return User
     */
    public function setJeudiMatin($jeudiMatin)
    {
        $this->Jeudi_Matin = $jeudiMatin;

        return $this;
    }

    /**
     * Get jeudiMatin
     *
     * @return boolean
     */
    public function getJeudiMatin()
    {
        return $this->Jeudi_Matin;
    }

    /**
     * Set jeudiMidi
     *
     * @param boolean $jeudiMidi
     *
     * @return User
     */
    public function setJeudiMidi($jeudiMidi)
    {
        $this->Jeudi_Midi = $jeudiMidi;

        return $this;
    }

    /**
     * Get jeudiMidi
     *
     * @return boolean
     */
    public function getJeudiMidi()
    {
        return $this->Jeudi_Midi;
    }

    /**
     * Set jeudiSoir
     *
     * @param boolean $jeudiSoir
     *
     * @return User
     */
    public function setJeudiSoir($jeudiSoir)
    {
        $this->Jeudi_Soir = $jeudiSoir;

        return $this;
    }

    /**
     * Get jeudiSoir
     *
     * @return boolean
     */
    public function getJeudiSoir()
    {
        return $this->Jeudi_Soir;
    }

    /**
     * Set vendrediMatin
     *
     * @param boolean $vendrediMatin
     *
     * @return User
     */
    public function setVendrediMatin($vendrediMatin)
    {
        $this->Vendredi_Matin = $vendrediMatin;

        return $this;
    }

    /**
     * Get vendrediMatin
     *
     * @return boolean
     */
    public function getVendrediMatin()
    {
        return $this->Vendredi_Matin;
    }

    /**
     * Set vendrediMidi
     *
     * @param boolean $vendrediMidi
     *
     * @return User
     */
    public function setVendrediMidi($vendrediMidi)
    {
        $this->Vendredi_Midi = $vendrediMidi;

        return $this;
    }

    /**
     * Get vendrediMidi
     *
     * @return boolean
     */
    public function getVendrediMidi()
    {
        return $this->Vendredi_Midi;
    }

    /**
     * Set vendrediSoir
     *
     * @param boolean $vendrediSoir
     *
     * @return User
     */
    public function setVendrediSoir($vendrediSoir)
    {
        $this->Vendredi_Soir = $vendrediSoir;

        return $this;
    }

    /**
     * Get vendrediSoir
     *
     * @return boolean
     */
    public function getVendrediSoir()
    {
        return $this->Vendredi_Soir;
    }

    /**
     * Set samediMatin
     *
     * @param boolean $samediMatin
     *
     * @return User
     */
    public function setSamediMatin($samediMatin)
    {
        $this->Samedi_Matin = $samediMatin;

        return $this;
    }

    /**
     * Get samediMatin
     *
     * @return boolean
     */
    public function getSamediMatin()
    {
        return $this->Samedi_Matin;
    }

    /**
     * Set samediMidi
     *
     * @param boolean $samediMidi
     *
     * @return User
     */
    public function setSamediMidi($samediMidi)
    {
        $this->Samedi_Midi = $samediMidi;

        return $this;
    }

    /**
     * Get samediMidi
     *
     * @return boolean
     */
    public function getSamediMidi()
    {
        return $this->Samedi_Midi;
    }

    /**
     * Set samediSoir
     *
     * @param boolean $samediSoir
     *
     * @return User
     */
    public function setSamediSoir($samediSoir)
    {
        $this->Samedi_Soir = $samediSoir;

        return $this;
    }

    /**
     * Get samediSoir
     *
     * @return boolean
     */
    public function getSamediSoir()
    {
        return $this->Samedi_Soir;
    }

    /**
     * Set dimancheMatin
     *
     * @param boolean $dimancheMatin
     *
     * @return User
     */
    public function setDimancheMatin($dimancheMatin)
    {
        $this->Dimanche_Matin = $dimancheMatin;

        return $this;
    }

    /**
     * Get dimancheMatin
     *
     * @return boolean
     */
    public function getDimancheMatin()
    {
        return $this->Dimanche_Matin;
    }

    /**
     * Set dimancheMidi
     *
     * @param boolean $dimancheMidi
     *
     * @return User
     */
    public function setDimancheMidi($dimancheMidi)
    {
        $this->Dimanche_Midi = $dimancheMidi;

        return $this;
    }

    /**
     * Get dimancheMidi
     *
     * @return boolean
     */
    public function getDimancheMidi()
    {
        return $this->Dimanche_Midi;
    }

    /**
     * Set dimancheSoir
     *
     * @param boolean $dimancheSoir
     *
     * @return User
     */
    public function setDimancheSoir($dimancheSoir)
    {
        $this->Dimanche_Soir = $dimancheSoir;

        return $this;
    }

    /**
     * Get dimancheSoir
     *
     * @return boolean
     */
    public function getDimancheSoir()
    {
        return $this->Dimanche_Soir;
    }

   

    /**
     * Add users1vote
     *
     * @param \MeetUpBundle\Entity\Vote1 $users1vote
     *
     * @return User
     */
    public function addUsers1vote(\MeetUpBundle\Entity\Vote1 $users1vote)
    {
        $this->users1vote[] = $users1vote;

        return $this;
    }

    /**
     * Remove users1vote
     *
     * @param \MeetUpBundle\Entity\Vote1 $users1vote
     */
    public function removeUsers1vote(\MeetUpBundle\Entity\Vote1 $users1vote)
    {
        $this->users1vote->removeElement($users1vote);
    }

    /**
     * Get users1vote
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers1vote()
    {
        return $this->users1vote;
    }

    /**
     * Add users2vote
     *
     * @param \MeetUpBundle\Entity\Vote2 $users2vote
     *
     * @return User
     */
    public function addUsers2vote(\MeetUpBundle\Entity\Vote2 $users2vote)
    {
        $this->users2vote[] = $users2vote;

        return $this;
    }

    /**
     * Remove users2vote
     *
     * @param \MeetUpBundle\Entity\Vote2 $users2vote
     */
    public function removeUsers2vote(\MeetUpBundle\Entity\Vote2 $users2vote)
    {
        $this->users2vote->removeElement($users2vote);
    }

    /**
     * Get users2vote
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers2vote()
    {
        return $this->users2vote;
    }

    /**
     * Add users3vote
     *
     * @param \MeetUpBundle\Entity\Vote3 $users3vote
     *
     * @return User
     */
    public function addUsers3vote(\MeetUpBundle\Entity\Vote3 $users3vote)
    {
        $this->users3vote[] = $users3vote;

        return $this;
    }

    /**
     * Remove users3vote
     *
     * @param \MeetUpBundle\Entity\Vote3 $users3vote
     */
    public function removeUsers3vote(\MeetUpBundle\Entity\Vote3 $users3vote)
    {
        $this->users3vote->removeElement($users3vote);
    }

    /**
     * Get users3vote
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers3vote()
    {
        return $this->users3vote;
    }
}
