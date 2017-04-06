<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 4/6/2017
 * Time: 8:25 PM
 */

namespace Pbxg33k\FileBrowserBundle\Model;


use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Mount
 * @package Pbxg33k\FileBrowserBundle\Model
 */
class Mount
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var ArrayCollection
     */
    protected $directories;

    /**
     * @var ArrayCollection
     */
    protected $files;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Mount
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @return Mount
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
     * @return Mount
     */
    public function setDirectories(ArrayCollection $directories)
    {
        $this->directories = $directories;

        return $this;
    }
}