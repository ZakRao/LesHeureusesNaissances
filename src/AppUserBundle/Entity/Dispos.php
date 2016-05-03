<?php

namespace AppUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dispos
 *
 * @ORM\Table(name="dispos")
 * @ORM\Entity(repositoryClass="AppUserBundle\Repository\DisposRepository")
 */
class Dispos
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
     * @ORM\ManyToOne(targetEntity="AppUserBundle\Entity\User",inversedBy="disponibilites")
     * @ORM\JoinColumn(nullable=false)
    */
    private $user;

    /**
     * @ORM\Column(name="disponibilite", type="integer", nullable=true)
     */
    private $disponibilite;


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
     * Set user
     *
     * @param \AppUserBundle\Entity\User $user
     *
     * @return Dispos
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

    /**
     * Set disponibilite
     *
     * @param integer $disponibilite
     *
     * @return Dispos
     */
    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * Get disponibilite
     *
     * @return integer
     */
    public function getDisponibilite()
    {
        return $this->disponibilite;
    }
}
