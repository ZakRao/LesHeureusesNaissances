<?php

namespace AppUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="AppUserBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="string", length=255)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image",  cascade={"persist", "remove"})
     * @ORM\JoinColumn( nullable=true )
     */
    private $image;

    /**
   * @ORM\ManyToOne(targetEntity="AppUserBundle\Entity\User", inversedBy="commentaires")
   * @ORM\JoinColumn(nullable=false)
   */
  private $user;


    public function __construct()
  {
    $this->date = new \Datetime();
  }

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
     * Set auteur
     *
     * @param string $auteur
     *
     * @return Commentaire
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Commentaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    

    /**
     * Set user
     *
     * @param \AppUserBundle\Entity\User $user
     *
     * @return Commentaire
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
   * @ORM\PrePersist
   */
  public function increase()
  {
    $this->getUser()->increaseCommentaire();
  }

  /**
   * @ORM\PreRemove
   */
  public function decrease()
  {
    $this->getUser()->decreaseCommentaire();
  }

    /**
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Commentaire
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
}
