<?php

namespace Stampi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rarity
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stampi\AdminBundle\Entity\RarityRepository")
 */
class Rarity
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
     * @ORM\Column(name="scale", type="integer")
     */
    private $scale;

    /**
     * @var integer
     *
     * @ORM\Column(name="percentile", type="integer")
     */
    private $percentile;

    /**
     * @ORM\OneToMany(targetEntity="TextI18n", mappedBy="rarity", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="rarity_i18n", referencedColumnName="id")
     */
    private $rarityI18n;


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
     * Set scale
     *
     * @param integer $scale
     * @return Rarity
     */
    public function setScale($scale)
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get scale
     *
     * @return integer 
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Set percentile
     *
     * @param integer $percentile
     * @return Rarity
     */
    public function setPercentile($percentile)
    {
        $this->percentile = $percentile;

        return $this;
    }

    /**
     * Get percentile
     *
     * @return integer 
     */
    public function getPercentile()
    {
        return $this->percentile;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rarityI18n = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add rarityI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $rarityI18n
     * @return Rarity
     */
    public function addRarityI18n(\Stampi\AdminBundle\Entity\TextI18n $rarityI18n)
    {
        $this->rarityI18n[] = $rarityI18n;

        return $this;
    }

    /**
     * Remove rarityI18n
     *
     * @param \Stampi\AdminBundle\Entity\TextI18n $rarityI18n
     */
    public function removeRarityI18n(\Stampi\AdminBundle\Entity\TextI18n $rarityI18n)
    {
        $this->rarityI18n->removeElement($rarityI18n);
    }

    /**
     * Get rarityI18n
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRarityI18n()
    {
        return $this->rarityI18n;
    }
}
