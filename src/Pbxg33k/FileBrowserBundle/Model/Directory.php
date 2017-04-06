<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 4/6/2017
 * Time: 8:11 PM
 */

namespace Pbxg33k\FileBrowserBundle\Model;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Directory
 * @package Pbxg33k\FileBrowserBundle\Model
 */
class Directory
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var \DateTimeInterface
     */
    protected $created_date;

    /**
     * @var \DateTimeInterface
     */
    protected $modified_date;

    /**
     * @var boolean
     */
    protected $archivable;

    /**
     * @var ArrayCollection
     */
    protected $files;

    /**
     * @var ArrayCollection
     */
    protected $directories;

    /**
     * @var Directory
     */
    protected $parent;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Directory
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return Directory
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedDate()
    {
        return $this->created_date;
    }

    /**
     * @param \DateTimeInterface $created_date
     *
     * @return Directory
     */
    public function setCreatedDate($created_date)
    {
        $this->created_date = $created_date;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getModifiedDate()
    {
        return $this->modified_date;
    }

    /**
     * @param \DateTimeInterface $modified_date
     *
     * @return Directory
     */
    public function setModifiedDate($modified_date)
    {
        $this->modified_date = $modified_date;
        return $this;
    }

    /**
     * @return bool
     */
    public function isArchivable()
    {
        return $this->archivable;
    }

    /**
     * @param bool $archivable
     *
     * @return Directory
     */
    public function setArchivable($archivable)
    {
        $this->archivable = $archivable;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param File $file
     *
     * @return ArrayCollection
     */
    public function addFile(File $file)
    {
        $this->files->set($file->getName(), $file);

        return $this->files;
    }

    /**
     * @param $filename
     *
     * @return ArrayCollection
     */
    public function removeFile($filename)
    {
        if($filename instanceof File)
        {
            $filename = $filename->getName();
        }

        $this->files->remove($filename);

        return $this->files;
    }

    /**
     * @param ArrayCollection $files
     *
     * @return Directory
     */
    public function setFiles(ArrayCollection $files)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getDirectories()
    {
        return $this->directories;
    }

    /**
     * @param Directory $directory
     *
     * @return ArrayCollection
     */
    public function addDirectory(Directory $directory)
    {
        $this->directories->set($directory->getName(), $directory);

        return $this->directories;
    }

    /**
     * @param $directory
     *
     * @return ArrayCollection
     */
    public function removeDirectory($directory)
    {
        if($directory instanceof Directory)
        {
            $directory = $directory->getName();
        }

        $this->directories->remove($directory);

        return $this->directories;
    }

    /**
     * @param ArrayCollection $directories
     *
     * @return Directory
     */
    public function setDirectories(ArrayCollection $directories)
    {
        $this->directories = $directories;

        return $this;
    }

    /**
     * @return Directory
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Directory $parent
     *
     * @return Directory
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }
}