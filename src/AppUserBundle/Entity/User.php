<?php

namespace AppUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;


/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppUserBundle\Repository\UserRepository")
 */
class User extends BaseUser
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
     * @ORM\Column(type="string")
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $parrain;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $prenom;

     /**
     * @ORM\Column(type="string")
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




    public function __construct()
  {
    parent::__construct();
    $this->enfants   = new ArrayCollection();
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

}
