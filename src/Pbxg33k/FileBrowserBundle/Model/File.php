<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 4/6/2017
 * Time: 8:14 PM
 */

namespace Pbxg33k\FileBrowserBundle\Model;


use Psr\Http\Message\UriInterface;

/**
 * Class File
 * @package Pbxg33k\FileBrowserBundle\Model
 */
class File
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
     * @var integer
     */
    protected $size;

    /**
     * @var string
     */
    protected $extension;

    /**
     * @var \DateTimeInterface
     */
    protected $created_date;

    /**
     * @var \DateTimeInterface
     */
    protected $modified_date;

    /**
     * @var UriInterface
     */
    protected $thumbnail;

    /**
     * @var boolean
     */
    protected $downloadable;

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
     * @return File
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
     * @return File
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @return File
     */
    public function setSize($size)
    {
        $this->size = $size;

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
     * @return File
     */
    public function setCreatedDate(\DateTimeInterface $created_date)
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
     * @return File
     */
    public function setModifiedDate(\DateTimeInterface $modified_date)
    {
        $this->modified_date = $modified_date;

        return $this;
    }

    /**
     * @return UriInterface
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param UriInterface $thumbnail
     *
     * @return File
     */
    public function setThumbnail(UriInterface $thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDownloadable()
    {
        return $this->downloadable;
    }

    /**
     * @param bool $downloadable
     *
     * @return File
     */
    public function setDownloadable($downloadable)
    {
        $this->downloadable = $downloadable;

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
     * @return File
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        if(null === $this->extension) {
            // Extension is empty, try guessing
            if($this->path) {
                $fileInfo = pathinfo($this->path);
                $this->setExtension($fileInfo['extension']);
            } else {
                throw \Exception('Unable to get extension');
            }
        }

        return $this->extension;
    }

    /**
     * @param string $extension
     * @return File
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

}