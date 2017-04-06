<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 4/6/2017
 * Time: 8:59 PM
 */

namespace Pbxg33k\FileBrowserBundle\Filter;


use Doctrine\Common\Collections\ArrayCollection;
use Pbxg33k\FileBrowserBundle\Model\File;

class ExtensionFilter implements FilterInterface
{
    /**
     * @var ArrayCollection
     */
    protected $extensions;

    /**
     * @var boolean
     */
    protected $enabled;

    /**
     * FilterInterface constructor.
     * @param $options
     */
    public function __construct($options, $enabled = true)
    {
        $this->extensions = new ArrayCollection($options);
        $this->enabled = (bool)$enabled;
    }

    public function getName()
    {
        return 'file_extension';
    }

    /**
     * Return if filter filters directories
     *
     * @return mixed
     */
    public function filtersDirectories()
    {
        return false;
    }

    /**
     * Return if filter filters files
     *
     * @return mixed
     */
    public function filtersFiles()
    {
        return true;
    }

    /**
     * Return if filter filters links
     *
     * @return mixed
     */
    public function filtersLinks()
    {
        return false;
    }

    public function isEnabled()
    {
        return $this->enabled === true;
    }

    public function enable()
    {
        $this->enabled = true;
    }

    public function disable()
    {
        $this->enabled = false;
    }

    /**
     * Return false if item does not pass filter
     *
     * @param $fileOrDirectory
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function filter($fileOrDirectory)
    {
        if(!$fileOrDirectory instanceof File) {
            throw new \Exception('Filter only supports files');
        }

        return in_array($fileOrDirectory->getExtension(), $this->extensions->toArray());
    }
}