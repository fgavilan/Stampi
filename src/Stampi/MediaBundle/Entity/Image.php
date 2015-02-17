<?php

namespace ByHours\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Image
 *
 * @ORM\Table("media_image")
 * @ORM\Entity(repositoryClass="ByHours\MediaBundle\Entity\ImageRepository")
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
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="context", type="string", length=255)
     */
    private $context;

    /**
     * @var string
     *
     * @ORM\Column(name="targetId", type="string", length=255)
     */
    private $targetId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumb;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    public function __toString()
    {
        return (string) $this->getId();
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    public function getThumb()
    {
        return null === $this->thumb
            ? null
            : $this->getUploadDir().'/'.$this->thumb;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'media/'.$this->getContext()."/".$this->getTargetId()."/";
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

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
     * Set filename
     *
     * @param string $filename
     * @return Image
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }
    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set context
     *
     * @param string $context
     * @return Image
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string 
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set targetId
     *
     * @param string $targetId
     * @return Image
     */
    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;

        return $this;
    }

    /**
     * Get targetId
     *
     * @return string 
     */
    public function getTargetId()
    {
        return $this->targetId;
    }

    public function delete(){

        if(is_file($this->getUploadRootDir().$this->filename) && file_exists($this->getUploadRootDir().$this->filename)){
            unlink($this->getUploadRootDir().$this->filename);
        }
        if(is_file($this->getUploadRootDir()."thumbnail/".$this->filename) && file_exists($this->getUploadRootDir()."thumbnail/".$this->filename)){
        unlink($this->getUploadRootDir()."thumbnail/".$this->filename);
        }
    }
    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // move takes the target directory and then the
        // target filename to move to
        $generated_name = str_replace('.', '-', microtime(true)).".";
        $filename=$generated_name.$this->getFile()->getClientOriginalExtension();
        $filename_thumb= $generated_name."jpg";

        //Check if path exists and create it
        $fs = new Filesystem();
        if (!file_exists($this->getUploadRootDir())) {
            $fs->mkdir($this->getUploadRootDir(), 0777);
            $fs->mkdir($this->getUploadRootDir()."/thumbnail", 0777);
        }
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $filename
        );

        //Generate Thumbnail

        $path_to_image_directory = $this->getUploadDir();
        $path_to_thumbs_directory = $this->getUploadDir()."thumbnail/";
        $final_width_of_image = 80;

        if(preg_match('/[.](jpg)$/', strtolower($filename))) {
            $im = imagecreatefromjpeg($path_to_image_directory . $filename);
        } else if (preg_match('/[.](gif)$/', strtolower($filename))) {
            $im = imagecreatefromgif($path_to_image_directory . $filename);
        } else if (preg_match('/[.](png)$/', strtolower($filename))) {
            $im = imagecreatefrompng($path_to_image_directory . $filename);
        }

        $ox = imagesx($im);
        $oy = imagesy($im);

        $nx = $final_width_of_image;
        $ny = floor($oy * ($final_width_of_image / $ox));

        $nm = imagecreatetruecolor($nx, $ny);

        imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);

        if(!file_exists($path_to_thumbs_directory)) {
            if(!mkdir($path_to_thumbs_directory)) {
                //die("There was a problem. Please try again!");
            }
        }

        imagejpeg($nm, $path_to_thumbs_directory . $filename_thumb);

        // set the path property to the filename where you've saved the file
        $this->path = "/".$this->getUploadDir().$filename;
        $this->filename = $filename;
        $this->thumb = "/".$this->getUploadDir()."thumbnail/".$filename_thumb;

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

}
