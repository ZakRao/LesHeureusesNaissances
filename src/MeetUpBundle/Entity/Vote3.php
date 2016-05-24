<?php

namespace MeetUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote3
 *
 * @ORM\Table(name="vote3")
 * @ORM\Entity(repositoryClass="MeetUpBundle\Repository\Vote3Repository")
 */
class Vote3
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
     * @ORM\Column(name="vote3", type="integer")
     */
    private $vote3 =0;

    /**
     * @ORM\OneToOne(targetEntity="MeetUpBundle\Entity\MeetUp", cascade={"persist","remove"})
     *
     */
    private $meetup3;

    /**
     * @ORM\ManyToMany(targetEntity="AppUserBundle\Entity\User", inversedBy="users3vote") 
     *
     * @ORM\JoinTable(name="vote3_users")
     */
    private $vote3users;


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
     * Set vote3
     *
     * @param integer $vote3
     *
     * @return Vote3
     */
    public function setVote3($vote3)
    {
        $this->vote3 = $vote3;

        return $this;
    }

    /**
     * Get vote3
     *
     * @return int
     */
    public function getVote3()
    {
        return $this->vote3;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vote3users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set meetup3
     *
     * @param \MeetUpBundle\Entity\MeetUp $meetup3
     *
     * @return Vote3
     */
    public function setMeetup3(\MeetUpBundle\Entity\MeetUp $meetup3 = null)
    {
        $this->meetup3 = $meetup3;

        return $this;
    }

    /**
     * Get meetup3
     *
     * @return \MeetUpBundle\Entity\MeetUp
     */
    public function getMeetup3()
    {
        return $this->meetup3;
    }

    /**
     * Add vote3user
     *
     * @param \AppUserBundle\Entity\User $vote3user
     *
     * @return Vote3
     */
    public function addVote3user(\AppUserBundle\Entity\User $vote3user)
    {
        $this->vote3users[] = $vote3user;

        return $this;
    }

    /**
     * Remove vote3user
     *
     * @param \AppUserBundle\Entity\User $vote3user
     */
    public function removeVote3user(\AppUserBundle\Entity\User $vote3user)
    {
        $this->vote3users->removeElement($vote3user);
    }

    /**
     * Get vote3users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVote3users()
    {
        return $this->vote3users;
    }
}
