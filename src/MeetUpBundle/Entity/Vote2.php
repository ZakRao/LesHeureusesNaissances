<?php

namespace MeetUpBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote2
 *
 * @ORM\Table(name="vote2")
 * @ORM\Entity(repositoryClass="MeetUpBundle\Repository\Vote2Repository")
 */
class Vote2
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
     * @ORM\Column(name="vote2", type="integer")
     */
    private $vote2 = 0;

    /**
     * @ORM\OneToOne(targetEntity="MeetUpBundle\Entity\MeetUp", cascade={"persist"})
     *
     */
    private $meetup2;

    /**
     * @ORM\ManyToMany(targetEntity="AppUserBundle\Entity\User", inversedBy="users2vote") 
     *
     * @ORM\JoinTable(name="vote2_users")
     */
    private $vote2users;


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
     * Set vote2
     *
     * @param integer $vote2
     *
     * @return Vote2
     */
    public function setVote2($vote2)
    {
        $this->vote2 = $vote2;

        return $this;
    }

    /**
     * Get vote2
     *
     * @return int
     */
    public function getVote2()
    {
        return $this->vote2;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vote2users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vote2user
     *
     * @param \AppUserBundle\Entity\User $vote2user
     *
     * @return Vote2
     */
    public function addVote2user(\AppUserBundle\Entity\User $vote2user)
    {
        $this->vote2users[] = $vote2user;

        return $this;
    }

    /**
     * Remove vote2user
     *
     * @param \AppUserBundle\Entity\User $vote2user
     */
    public function removeVote2user(\AppUserBundle\Entity\User $vote2user)
    {
        $this->vote2users->removeElement($vote2user);
    }

    /**
     * Get vote2users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVote2users()
    {
        return $this->vote2users;
    }

    /**
     * Set meetup2
     *
     * @param \MeetUpBundle\Entity\MeetUp $meetup2
     *
     * @return Vote2
     */
    public function setMeetup2(\MeetUpBundle\Entity\MeetUp $meetup2 = null)
    {
        $this->meetup2 = $meetup2;

        return $this;
    }

    /**
     * Get meetup2
     *
     * @return \MeetUpBundle\Entity\MeetUp
     */
    public function getMeetup2()
    {
        return $this->meetup2;
    }
}
