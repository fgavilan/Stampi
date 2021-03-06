<?php

namespace Stampi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inventory
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stampi\AdminBundle\Entity\InventoryRepository")
 */
class Inventory
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
     * @var boolean
     *
     * @ORM\Column(name="altered", type="boolean")
     */
    private $altered;

    /**
     * @var boolean
     *
     * @ORM\Column(name="signed", type="boolean")
     */
    private $signed;

    /**
     * @var integer
     *
     * @ORM\Column(name="blocked", type="integer")
     */
    private $blocked;

    /**
     *
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist","remove"} , mappedBy="inventory")
     * @ORM\JoinColumn(name="custom_image_id", referencedColumnName="id")
     */
    private $customImage;


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
     * Set altered
     *
     * @param boolean $altered
     * @return Inventory
     */
    public function setAltered($altered)
    {
        $this->altered = $altered;

        return $this;
    }

    /**
     * Get altered
     *
     * @return boolean 
     */
    public function getAltered()
    {
        return $this->altered;
    }

    /**
     * Set signed
     *
     * @param boolean $signed
     * @return Inventory
     */
    public function setSigned($signed)
    {
        $this->signed = $signed;

        return $this;
    }

    /**
     * Get signed
     *
     * @return boolean 
     */
    public function getSigned()
    {
        return $this->signed;
    }

    /**
     * Set blocked
     *
     * @param boolean $blocked
     * @return Inventory
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get blocked
     *
     * @return boolean 
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * Set customImage
     *
     * @param \Stampi\AdminBundle\Entity\Image $customImage
     * @return Inventory
     */
    public function setCustomImage(\Stampi\AdminBundle\Entity\Image $customImage = null)
    {
        $this->customImage = $customImage;

        return $this;
    }

    /**
     * Get customImage
     *
     * @return \Stampi\AdminBundle\Entity\Image 
     */
    public function getCustomImage()
    {
        return $this->customImage;
    }
}
