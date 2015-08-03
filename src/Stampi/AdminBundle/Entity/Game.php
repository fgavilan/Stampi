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
     *
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist","remove"} , mappedBy="game", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="logo_id", referencedColumnName="id")
     */
    private $logoImage;

    /**
     *
     * @ORM\OneToMany(targetEntity="GameI18n", mappedBy="game", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $gameI18N;

    /**
     *
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
     * Set logoImage
     *
     * @param string $logoImage
     * @return Game
     */
    public function setlogoImage($logoImage)
    {
        $this->logoImage = $logoImage;

        return $this;
    }

    /**
     * Get logoImage
     *
     * @return string 
     */
    public function getlogoImage()
    {
        return $this->logoImage;
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
