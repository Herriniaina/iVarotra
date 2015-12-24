<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Image
 *
 * @ORM\Table(name="tblimage")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(name="chemin", type="string", length=255)
     */
    private $chemin;

    private $tempFile;
    
    public $file;
    
    public function getUploadRootDir(){
        return __dir__.'/../../../../public_html/uploads';
    }
    public function getAbsolutePath(){
        return null===$this->chemin ? null : $this->getUploadRootDir().'/'.$this->chemin;
    }
    /**
    * @ORM\PrePersist()
    * @ORM\PreUpdate()
    */

    public function preUpload(){
        $this->tempFile=$this->getAbsolutePath();
        $this->oldFile=$this->getChemin();
        if(null !== $this->file){ $this->chemin = sha1(uniqid(mt_rand(),true)).'.'. $this->file->guessExtension();}

    }
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload(){
        if(null !== $this->file){
            $this->file->move($this->getUploadRootDir(),$this->chemin);
            unset($this->file);
            if($this->oldFile !== null) unlink($this->tempFile);
        }
    }
    /**
     * @ORM\PreRemove()
     */
    
    public function preRemoveUpload(){
        $this->tempFile=$this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    
    public function removeUpload(){
       if(file_exists($this->tempFile)){
        unlink($this->tempFile);
    } 
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
     * Set chemin
     *
     * @param string $chemin
     * @return Image
     */
    public function setChemin($chemin)
    {
        $this->chemin = $chemin;
    
        return $this;
    }

    /**
     * Get chemin
     *
     * @return string 
     */
    public function getChemin()
    {
        return $this->chemin;
    }
}