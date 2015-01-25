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
     * @ORM\Column(name="imageFolder", type="string", length=255)
     */
    private $imageFolder;

    /**
     * @ORM\OneToMany(targetEntity="TextI18n", mappedBy="game", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $gameI18n;

    /**
     * @ORM\OneToMany(targetEntity="Edition", mappedBy="game", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $editions;


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
        $this->editions = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add gameI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $gameI18n
     * @return Game
     */
    public function addGameI18n(\Stampi\AdminBundle\Entity\TextI18n $gameI18n)
    {
        $this->gameI18n[] = $gameI18n;

        return $this;
    }

    /**
     * Remove gameI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $gameI18n
     */
    public function removeGameI18n(\Stampi\AdminBundle\Entity\TextI18n $gameI18n)
    {
        $this->gameI18n->removeElement($gameI18n);
    }

    /**
     * Get gameI18n
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGameI18n()
    {
        return $this->gameI18n;
    }

    /**
     * Add editions
     *
     * @param \Stampi\AdminBundle\Entity\Edition $editions
     * @return Game
     */
    public function addEdition(\Stampi\AdminBundle\Entity\Edition $editions)
    {
        $this->editions[] = $editions;

        return $this;
    }

    /**
     * Remove editions
     *
     * @param \Stampi\AdminBundle\Entity\Edition $editions
     */
    public function removeEdition(\Stampi\AdminBundle\Entity\Edition $editions)
    {
        $this->editions->removeElement($editions);
    }

    /**
     * Get editions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEditions()
    {
        return $this->editions;
    }
}
