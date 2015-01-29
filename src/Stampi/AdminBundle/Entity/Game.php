<?php

namespace Stampi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stampi\AdminBundle\Entity\GameRepository")
 */
class Game
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishDate", type="datetime")
     */
    private $publishDate;

    /**
     * @var string
     *
     * @ORM\Column(name="imageFolder", type="string", length=255, nullable=true)
     */
    private $imageFolder;

    /**
     *
     * @ORM\OneToMany(targetEntity="GameI18n", mappedBy="game", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $gameI18N;

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
     * Set publishDate
     *
     * @param \DateTime $publishDate
     * @return Game
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return \DateTime 
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set imageFolder
     *
     * @param string $imageFolder
     * @return Game
     */
    public function setImageFolder($imageFolder)
    {
        $this->imageFolder = $imageFolder;

        return $this;
    }

    /**
     * Get imageFolder
     *
     * @return string 
     */
    public function getImageFolder()
    {
        return $this->imageFolder;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gameI18n = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add gameI18N
     *
     * @param \Stampi\AdminBundle\Entity\GameI18n $gameI18N
     * @return Game
     */
    public function addGameI18N(\Stampi\AdminBundle\Entity\GameI18n $gameI18N)
    {
        $this->gameI18N[] = $gameI18N;

        return $this;
    }

    /**
     * Remove gameI18N
     *
     * @param \Stampi\AdminBundle\Entity\GameI18n $gameI18N
     */
    public function removeGameI18N(\Stampi\AdminBundle\Entity\GameI18n $gameI18N)
    {
        $this->gameI18N->removeElement($gameI18N);
    }

    /**
     * Get gameI18N
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGameI18N()
    {
        return $this->gameI18N;
    }
}
