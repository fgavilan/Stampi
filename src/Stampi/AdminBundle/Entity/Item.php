<?php

namespace Stampi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stampi\AdminBundle\Entity\ItemRepository")
 */
class Item
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
     * @var integer
     *
     * @ORM\Column(name="playset", type="integer")
     */
    private $playset;

    /**
     * @ORM\ManyToMany(targetEntity="TextI18n", cascade={"persist","remove"})
     * @ORM\JoinTable(name="items_texts",
     *      joinColumns={@ORM\JoinColumn(name="item_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="text_id", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $textI18n;

    /**
     * @ORM\ManyToOne(targetEntity="Rarity")
     * @ORM\JoinColumn(name="rarity_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $rarity;

    /**
     * @ORM\ManyToOne(targetEntity="Edition", inversedBy="items")
     * @ORM\JoinColumn(name="edition_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $edition;

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
     * Set playset
     *
     * @param integer $playset
     * @return Item
     */
    public function setPlayset($playset)
    {
        $this->playset = $playset;

        return $this;
    }

    /**
     * Get playset
     *
     * @return integer 
     */
    public function getPlayset()
    {
        return $this->playset;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->itemI18n = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add itemI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $itemI18n
     * @return Item
     */
    public function addItemI18n(\Stampi\AdminBundle\Entity\TextI18n $itemI18n)
    {
        $this->itemI18n[] = $itemI18n;

        return $this;
    }

    /**
     * Remove itemI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $itemI18n
     */
    public function removeItemI18n(\Stampi\AdminBundle\Entity\TextI18n $itemI18n)
    {
        $this->itemI18n->removeElement($itemI18n);
    }

    /**
     * Get itemI18n
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItemI18n()
    {
        return $this->itemI18n;
    }

    /**
     * Set rarity
     *
     * @param \Stampi\AdminBundle\Entity\Rarity $rarity
     * @return Item
     */
    public function setRarity(\Stampi\AdminBundle\Entity\Rarity $rarity = null)
    {
        $this->rarity = $rarity;

        return $this;
    }

    /**
     * Get rarity
     *
     * @return \Stampi\AdminBundle\Entity\Rarity 
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * Set edition
     *
     * @param \Stampi\AdminBundle\Entity\Edition $edition
     * @return Item
     */
    public function setEdition(\Stampi\AdminBundle\Entity\Edition $edition = null)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get edition
     *
     * @return \Stampi\AdminBundle\Entity\Edition 
     */
    public function getEdition()
    {
        return $this->edition;
    }
}
