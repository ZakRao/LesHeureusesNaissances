<?php

namespace MeetUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentaireMeetUp
 *
 * @ORM\Table(name="commentaire_meet_up")
 * @ORM\Entity(repositoryClass="MeetUpBundle\Repository\CommentaireMeetUpRepository")
 */
class CommentaireMeetUp
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="MeetUpBundle\Entity\MeetUp", inversedBy="commentairesMeetUp")
     * @ORM\JoinColumn(nullable=false)
     */
    private $meetup;

    public function __construct()
    {

        $this->date = new \Datetime();
    }

    /**
     * Set meetup
     *
     * @param \MeetUpBundle\Entity\MeetUp $meetup
     *
     * @return CommentaireMeetUp
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
     * @return CommentaireMeetUp
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
     * @return CommentaireMeetUp
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
     * @param \DateTime $date
     *
     * @return CommentaireMeetUp
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set meetup
     *
     * @param \MeetUpBundle\Entity\CommentaireMeetUp $commentaireMeetUp
     *
     * @return CommentaireMeetUp
     */
    public function setCommentaireMeetUp(\MeetUpBundle\Entity\CommentaireMeetUp $commentaireMeetUp)
    {
        $this->commentaireMeetUp = $commentaireMeetUp;

        return $this;
    }
}
