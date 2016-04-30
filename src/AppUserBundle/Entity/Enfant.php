<?php

namespace AppUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Enfant
 *
 * @ORM\Table(name="enfant")
 * @ORM\Entity(repositoryClass="AppUserBundle\Repository\EnfantRepository")
 */
class Enfant
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * 
     *
     * @ORM\Column(name="prenom", type="string")
     */
    private $prenom;


    /**
     * 
     *
     * @ORM\Column(name="sexe", type="string")
     */
    private $sexe;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="anniversaire", type="datetime")
     */
    private $anniversaire;


    /**
   * @ORM\ManyToOne(targetEntity="AppUserBundle\Entity\User",inversedBy="enfants")
   * @ORM\JoinColumn(nullable=false)
   */
  private $user;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Enfant
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
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Enfant
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set user
     *
     * @param \AppUserBundle\Entity\User $user
     *
     * @return Enfant
     */
    public function setUser(\AppUserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppUserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }


    public function getAge()
    {
        $dateInterval = $this->anniversaire->diff(new \DateTime());
 
        return $dateInterval->y;
    }

    public function getMois()
    {
        $dateInterval = $this->anniversaire->diff(new \DateTime());
 
        return $dateInterval->m;
    }
}
