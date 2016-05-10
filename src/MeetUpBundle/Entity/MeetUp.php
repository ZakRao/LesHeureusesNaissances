<?php

namespace MeetUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * MeetUp
 *
 * @ORM\Table(name="meet_up")
 * @ORM\Entity(repositoryClass="MeetUpBundle\Repository\MeetUpRepository")
 */
class MeetUp
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
     * @ORM\Column(name="departement", type="string", length=255)
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255)
     */
    private $localisation;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255)
     */
    private $theme;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour1", type="datetime")
     */
    private $jour1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour2", type="datetime")
     */
    private $jour2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="jour3", type="datetime")
     */
    private $jour3;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
    * @ORM\ManyToOne(targetEntity="AppUserBundle\Entity\User",inversedBy="enfants")
    * @ORM\JoinColumn(nullable=false)
    */
    private $user;

    /**
    *  @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", cascade={"persist", "remove"})
    * 
    */
    private $image;

    /**
    * @ORM\OneToMany(targetEntity="MeetUpBundle\Entity\CommentaireMeetUp", mappedBy="meetups", cascade={"persist","remove"})
    *
    */
    private $commentairesMeetUp; //Une MeetUp est liée à plusieurs commentaires

    /**
    * @var int
    * 
    * @ORM\Column(name="vote_jour1", type="integer")
    *
    */
    private $vote_jour1 = 0;

    /**
    * @var int
    * 
    * @ORM\Column(name="vote_jour2", type="integer")
    *
    */
    private $vote_jour2 = 0;

    /**
    * @var int
    * 
    * @ORM\Column(name="vote_jour3", type="integer")
    *
    */
    private $vote_jour3 = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var array
     * 
     * @ORM\ManyToMany(targetEntity="AppUserBundle\Entity\User", inversedBy="meetups")
     */
    private $listeparticipantes;

    public function __construct()
    {
        $this->commentairesMeetUp = new ArrayCollection();
        $this->listeparticipantes = new ArrayCollection();
    }


    

    /**
    * @param CommentaireMeetUp $commentaireMeetUp
    * @return CommentaireMeetUp
    */
    public function addCommentaireMeetUp(CommentaireMeetUp $commentaireMeetUp)
    {
    $this->commentaireMeetUp[] = $commentaireMeetUp;

    // On lie l'annonce à la candidature
    $commentaireMeetUp->setMeetUp($this);

    return $this;
    }

    /**
    * @param CommentaireMeetUp $commentaireMeetUp
    */
    public function removeCommentaireMeetUp(CommentaireMeetUp $commentaireMeetUp)
    {
    $this->commentaireMeetUp->removeElement($commentaireMeetUp);

    // Et si notre relation était facultative (nullable=true, ce qui n'est pas notre cas ici attention) :
    // $commentaire->setUser(null);
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
    * @return ArrayCollection
    */
    public function getCommentairesMeetUp()
    {
    return $this->commentairesMeetUp;
    }


    /**
     * Set departement
     *
     * @param string $departement
     *
     * @return MeetUp
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
     * Set localisation
     *
     * @param string $localisation
     *
     * @return MeetUp
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return MeetUp
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set jour1
     *
     * @param \DateTime $jour1
     *
     * @return MeetUp
     */
    public function setJour1($jour1)
    {
        $this->jour1 = $jour1;

        return $this;
    }

    /**
     * Get jour1
     *
     * @return \DateTime
     */
    public function getJour1()
    {
        return $this->jour1;
    }

    /**
     * Set jour2
     *
     * @param \DateTime $jour2
     *
     * @return MeetUp
     */
    public function setJour2($jour2)
    {
        $this->jour2 = $jour2;

        return $this;
    }

    /**
     * Get jour2
     *
     * @return \DateTime
     */
    public function getJour2()
    {
        return $this->jour2;
    }

    /**
     * Set jour3
     *
     * @param \DateTime $jour3
     *
     * @return MeetUp
     */
    public function setJour3($jour3)
    {
        $this->jour3 = $jour3;

        return $this;
    }

    /**
     * Get jour3
     *
     * @return \DateTime
     */
    public function getJour3()
    {
        return $this->jour3;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return MeetUp
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
     * Set user
     *
     * @param \AppUserBundle\Entity\User $user
     *
     * @return MeetUp
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

    /**
     * Set meetup
     *
     * @param \MeetUpBundle\Entity\MeetUp $meetup
     *
     * @return MeetUp
     */
    public function setMeetUp(\MeetUpBundle\Entity\MeetUp $meetup)
    {
        $this->meetup = $meetup;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MeetUpBundle\Entity\MeetUp
     */
    public function getMeetUp()
    {
        return $this->meetup;
    }

    /**
     * Add commentairesMeetUp
     *
     * @param \MeetUpBundle\Entity\CommentaireMeetUp $commentairesMeetUp
     *
     * @return MeetUp
     */
    public function addCommentairesMeetUp(\MeetUpBundle\Entity\CommentaireMeetUp $commentairesMeetUp)
    {
        $this->commentairesMeetUp[] = $commentairesMeetUp;

        return $this;
    }

    /**
     * Remove commentairesMeetUp
     *
     * @param \MeetUpBundle\Entity\CommentaireMeetUp $commentairesMeetUp
     */
    public function removeCommentairesMeetUp(\MeetUpBundle\Entity\CommentaireMeetUp $commentairesMeetUp)
    {
        $this->commentairesMeetUp->removeElement($commentairesMeetUp);
    }

    /**
     * Set vote_jour1
     *
     * @param int $vote_jour1
     *
     * @return MeetUp
     */
    public function setVote_Jour1($vote_jour1)
    {
        $this->vote_jour1 = $vote_jour1;

        return $this;
    }

    /**
     * Get jour1
     *
     * @return int
     */
    public function getVote_Jour1()
    {
        return $this->vote_jour1;
    }    

    /**
     * Set vote_jour2
     *
     * @param int $vote_jour2
     *
     * @return MeetUp
     */
    public function setVote_Jour2($vote_jour2)
    {
        $this->vote_jour2 = $vote_jour2;

        return $this;
    }

    /**
     * Get vote_jour2
     *
     * @return int
     */
    public function getVote_Jour2()
    {
        return $this->vote_jour2;
    } 

    /**
     * Set vote_jour3
     *
     * @param int $vote_jour3
     *
     * @return MeetUp
     */
    public function setVote_Jour3($vote_jour3)
    {
        $this->vote_jour3 = $vote_jour3;

        return $this;
    }

    /**
     * Get vote_jour3
     *
     * @return int
     */
    public function getVote_Jour3()
    {
        return $this->vote_jour3;
    } 

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return MeetUp
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }


    /**
     * Set voteJour1
     *
     * @param integer $voteJour1
     *
     * @return MeetUp
     */
    public function setVoteJour1($voteJour1)
    {
        $this->vote_jour1 = $voteJour1;

        return $this;
    }

    /**
     * Get voteJour1
     *
     * @return integer
     */
    public function getVoteJour1()
    {
        return $this->vote_jour1;
    }

    /**
     * Set voteJour2
     *
     * @param integer $voteJour2
     *
     * @return MeetUp
     */
    public function setVoteJour2($voteJour2)
    {
        $this->vote_jour2 = $voteJour2;

        return $this;
    }

    /**
     * Get voteJour2
     *
     * @return integer
     */
    public function getVoteJour2()
    {
        return $this->vote_jour2;
    }

    /**
     * Set voteJour3
     *
     * @param integer $voteJour3
     *
     * @return MeetUp
     */
    public function setVoteJour3($voteJour3)
    {
        $this->vote_jour3 = $voteJour3;

        return $this;
    }

    /**
     * Get voteJour3
     *
     * @return integer
     */
    public function getVoteJour3()
    {
        return $this->vote_jour3;
    }

    /**
     * Add listeparticipante
     *
     * @param \AppUserBundle\Entity\User $listeparticipante
     *
     * @return MeetUp
     */
    public function addListeparticipante(\AppUserBundle\Entity\User $listeparticipante)
    {
        $this->listeparticipantes[] = $listeparticipante;

        return $this;
    }

    /**
     * Remove listeparticipante
     *
     * @param \AppUserBundle\Entity\User $listeparticipante
     */
    public function removeListeparticipante(\AppUserBundle\Entity\User $listeparticipante)
    {
        $this->listeparticipantes->removeElement($listeparticipante);
    }

    /**
     * Get listeparticipantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListeparticipantes()
    {
        return $this->listeparticipantes;
    }
}
