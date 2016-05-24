<?php

namespace MeetUpBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Vote1
 *
 * @ORM\Table(name="vote1")
 * @ORM\Entity(repositoryClass="MeetUpBundle\Repository\Vote1Repository")
 */
class Vote1
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
     * @var int
     *
     * @ORM\Column(name="vote1", type="integer")
     */
    private $vote1 = 0;

    /**
     * @ORM\ManyToMany(targetEntity="AppUserBundle\Entity\User", inversedBy="users1vote") 
     *
     * @ORM\JoinTable(name="vote1_users")
     */
    private $vote1users;


    /**
     * @ORM\OneToOne(targetEntity="MeetUpBundle\Entity\MeetUp", cascade={"persist"})
     *
     */
    private $meetup1;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vote1users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set vote1
     *
     * @param integer $vote1
     *
     * @return Vote1
     */
    public function setVote1($vote1)
    {
        $this->vote1 = $vote1;

        return $this;
    }

    /**
     * Get vote1
     *
     * @return integer
     */
    public function getVote1()
    {
        return $this->vote1;
    }

    /**
     * Add vote1user
     *
     * @param \AppUserBundle\Entity\User $vote1user
     *
     * @return Vote1
     */
    public function addVote1user(\AppUserBundle\Entity\User $user)
    {
        $this->vote1users[] = $user;
       
        return $this;
    }


    /**
     * Set meetup1
     *
     * @param \MeetUpBundle\Entity\MeetUp $meetup1
     *
     * @return Vote1
     */
    public function setMeetup1(\MeetUpBundle\Entity\MeetUp $meetup1 = null)
    {
        $this->meetup1 = $meetup1;

        return $this;
    }

    /**
     * Get meetup1
     *
     * @return \MeetUpBundle\Entity\MeetUp
     */
    public function getMeetup1()
    {
        return $this->meetup1;
    }

    /**
     * Remove vote1user
     *
     * @param \AppUserBundle\Entity\User $vote1user
     */
    public function removeVote1user(\AppUserBundle\Entity\User $vote1user)
    {
        $this->vote1users->removeElement($vote1user);
    }

    /**
     * Get vote1users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVote1users()
    {
        return $this->vote1users;
    }
}
