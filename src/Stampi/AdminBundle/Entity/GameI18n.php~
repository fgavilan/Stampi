<?php

namespace Stampi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameI18n
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class GameI18n
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="gameI18N")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;
    /**
     *
     * @ORM\OneToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */

    private $language;

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
     * Set name
     *
     * @param string $name
     * @return GameI18n
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return GameI18n
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
     * Set language
     *
     * @param \Stampi\AdminBundle\Entity\Language $language
     * @return GameI18n
     */
    public function setLanguage(\Stampi\AdminBundle\Entity\Language $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Stampi\AdminBundle\Entity\Language 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set game
     *
     * @param \Stampi\AdminBundle\Entity\Game $game
     * @return GameI18n
     */
    public function setGame(\Stampi\AdminBundle\Entity\Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \Stampi\AdminBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->language = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add language
     *
     * @param \Stampi\AdminBundle\Entity\Language $language
     * @return GameI18n
     */
    public function addLanguage(\Stampi\AdminBundle\Entity\Language $language)
    {
        $this->language[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \Stampi\AdminBundle\Entity\Language $language
     */
    public function removeLanguage(\Stampi\AdminBundle\Entity\Language $language)
    {
        $this->language->removeElement($language);
    }
}
