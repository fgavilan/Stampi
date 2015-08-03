<?php

namespace Stampi\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Stampi\AdminBundle\Entity\ImageRepository")
 */
class Image
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
     * @ORM\ManyToOne(targetEntity="Language")
     * @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     */
    private $language;

    /**
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(name="original_id", referencedColumnName="id", nullable=true)
     */
    private $original;


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
     * Set language
     *
     * @param \Stampi\AdminBundle\Entity\Language $language
     * @return Image
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
     * Set original
     *
     * @param \Stampi\AdminBundle\Entity\Item $original
     * @return Image
     */
    public function setOriginal(\Stampi\AdminBundle\Entity\Item $original = null)
    {
        $this->original = $original;

        return $this;
    }

    /**
     * Get original
     *
     * @return \Stampi\AdminBundle\Entity\Item 
     */
    public function getOriginal()
    {
        return $this->original;
    }

}
