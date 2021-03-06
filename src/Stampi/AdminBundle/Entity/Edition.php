<?php

namespace Stampi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Edition
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stampi\AdminBundle\Entity\EditionRepository")
 */
class Edition
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
     * @ORM\Column(name="symbol", type="string", length=255)
     */
    private $symbol;

    /**
     * @ORM\ManyToMany(targetEntity="TextI18n", cascade={"persist","remove"})
     * @ORM\JoinTable(name="editions_texts",
     *      joinColumns={@ORM\JoinColumn(name="edition_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="text_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $textI18n;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="edition", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="edition_id", referencedColumnName="id")
     */
    private $items;

    /**
     * @ORM\ManyToOne(targetEntity="Game", inversedBy="editions")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
     */
    private $game;



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
     * @return Edition
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
     * Set symbol
     *
     * @param string $symbol
     * @return Edition
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * Get symbol
     *
     * @return string 
     */
    public function getSymbol()
    {
        return $this->symbol;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->textI18n = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add textI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $textI18n
     * @return Edition
     */
    public function addTextI18n(\Stampi\AdminBundle\Entity\TextI18n $textI18n)
    {
        $this->textI18n[] = $textI18n;

        return $this;
    }

    /**
     * Remove textI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $textI18n
     */
    public function removeTextI18n(\Stampi\AdminBundle\Entity\TextI18n $textI18n)
    {
        $this->textI18n->removeElement($textI18n);
    }

    /**
     * Get textI18n
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTextI18n()
    {
        return $this->textI18n;
    }

    /**
     * Add items
     *
     * @param \Stampi\AdminBundle\Entity\Item $items
     * @return Edition
     */
    public function addItem(\Stampi\AdminBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \Stampi\AdminBundle\Entity\Item $items
     */
    public function removeItem(\Stampi\AdminBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set game
     *
     * @param \Stampi\AdminBundle\Entity\Game $game
     * @return Edition
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
}
