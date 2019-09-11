<?php

namespace Aropixel\AdminBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Aropixel\AdminBundle\Repository\ImageRepository")
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;


    /**
     * Path du fichier temporaire
     */
    private $temp;


    /**
     * @Assert\File(maxSize = "25M")
     */
    public $file;

    /**
     * @var string
     *
     * @ORM\Column(name="attr_title", type="string", length=255, nullable=true)
     */
    private $attrTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="attr_alt", type="string", length=255, nullable=true)
     */
    private $attrAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="attr_description", type="string", length=255, nullable=true)
     */
    private $attrDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=20)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="import", type="text", nullable=true)
     */
    private $import;

    /**
     * @var boolean
     */
    private $isNew;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


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
     * Set titre
     *
     * @param string $titre
     * @return Image
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set attrTitle
     *
     * @param string $attrTitle
     * @return Image
     */
    public function setAttrTitle($attrTitle)
    {
        $this->attrTitle = $attrTitle;

        return $this;
    }

    /**
     * Get attrTitle
     *
     * @return string
     */
    public function getAttrTitle()
    {
        return $this->attrTitle;
    }

    /**
     * Set attrAlt
     *
     * @param string $attrAlt
     * @return Image
     */
    public function setAttrAlt($attrAlt)
    {
        $this->attrAlt = $attrAlt;

        return $this;
    }

    /**
     * Get attrAlt
     *
     * @return string
     */
    public function getAttrAlt()
    {
        return $this->attrAlt;
    }

    /**
     * Set attrDescription
     *
     * @param string $attrDescription
     * @return Image
     */
    public function setAttrDescription($attrDescription)
    {
        $this->attrDescription = $attrDescription;

        return $this;
    }

    /**
     * Get attrDescription
     *
     * @return string
     */
    public function getAttrDescription()
    {
        return $this->attrDescription;
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
     * Set extension
     *
     * @param string $extension
     * @return Image
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Image
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Image
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get image absolute path
     *
     * @return string
     */
    public function getAbsolutePath()
    {
        return null === $this->filename ? null : $this->getUploadRootDir().'/'.$this->filename;
    }

    /**
     * Get image url
     *
     * @return string
     */
    public function getWebPath()
    {
        return null === $this->filename ? null : $this->getUploadDir().'/'.$this->filename;
    }

    /**
     * Get upload directory absolute path from root
     *
     * @return string
     */
    public function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../private/'.$this->getUploadDir();
    }

    /**
     * Get image absolute path
     *
     * @return string
     */
    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'images';
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
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->filename = $filename.'.'.$this->getFile()->guessExtension();
            $this->extension = $this->getFile()->guessExtension();

            $i = strrpos($this->titre, '.');
            if ($i!==false) {
                $this->titre = substr($this->titre, 0, $i);
            }

        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->filename);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if ($file && file_exists($file)) {
            unlink($file);
        }
    }


    /**
     * Set category
     *
     * @param string $category
     * @return Image
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->crops = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add crops
     *
     * @param Crop $crops
     * @return Image
     */
    public function addCrop(Crop $crops)
    {
        $this->crops[] = $crops;

        return $this;
    }

    /**
     * Remove crops
     *
     * @param Crop $crops
     */
    public function removeCrop(Crop $crops)
    {
        $this->crops->removeElement($crops);
    }

    /**
     * Get crops
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCrops()
    {
        return $this->crops;
    }

    /**
     * Set import
     *
     * @param string $import
     * @return Image
     */
    public function setImport($import)
    {
        $this->import = $import;

        return $this;
    }

    /**
     * Get import
     *
     * @return string
     */
    public function getImport()
    {
        return $this->import;
    }

    /**
     * Set isNew
     *
     * @param string $import
     * @return Image
     */
    public function setIsNew($is_new)
    {
        $this->isNew = $is_new;

        return $this;
    }

    /**
     * Get import
     *
     * @return string
     */
    public function isNew()
    {
        return $this->isNew;
    }
}
