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
     * @ORM\OneToMany(targetEntity="TextI18n", mappedBy="edition", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="edition_id", referencedColumnName="id")
     */
    private $editionI18n;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="edition", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="edition_id", referencedColumnName="id")
     */
    private $items;


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
        $this->editionI18n = new \Doctrine\Common\Collections\ArrayCollection();
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add editionI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $editionI18n
     * @return Edition
     */
    public function addEditionI18n(\Stampi\AdminBundle\Entity\TextI18n $editionI18n)
    {
        $this->editionI18n[] = $editionI18n;

        return $this;
    }

    /**
     * Remove editionI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $editionI18n
     */
    public function removeEditionI18n(\Stampi\AdminBundle\Entity\TextI18n $editionI18n)
    {
        $this->editionI18n->removeElement($editionI18n);
    }

    /**
     * Get editionI18n
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEditionI18n()
    {
        return $this->editionI18n;
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
}
