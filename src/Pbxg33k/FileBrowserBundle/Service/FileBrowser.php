<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 4/6/2017
 * Time: 8:06 PM
 */

namespace Pbxg33k\FileBrowserBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use function GuzzleHttp\debug_resource;
use League\Flysystem\MountManager;
use Pbxg33k\FileBrowserBundle\Filter\FilterInterface;
use Pbxg33k\FileBrowserBundle\Model\Mount;

class FileBrowser
{
    /**
     * @var MountManager
     */
    protected $mountManager;

    /**
     * @var ArrayCollection
     */
    protected $filters;

    /**
     * @var ArrayCollection
     */
    protected $mounts;

    public function __construct(MountManager $mountManager, ArrayCollection $mounts = null)
    {
        if($mounts === null) {
            $mounts = new ArrayCollection();
        }

        $this->mountManager = $mountManager;

        foreach($mounts as $mountConfig)
        {
            $this->addMount($this->createMount($mountConfig));
        }

        $this->filters = new ArrayCollection();
        $this->mounts  = new ArrayCollection();
    }

    public function addMountFromConfig($config)
    {
        $this->mounts->set($config, $this->mountManager->getFilesystem($config));

        return $this;
    }

    public function addMount(Mount $mount)
    {
        $this->mounts->set($mount->getName(), $mount);

        return $this;
    }

    public function addFilterFromConfig($filterConfig)
    {
        $filterClass = $filterConfig['adapter'];
        $relativeClassPath = (strpos($filterClass, "\\") === FALSE);

        if($relativeClassPath) {
            $filterClass = "Pbxg33k\\FileBrowserBundle\\Filter\\".$filterClass;
        }

        if(!class_exists($filterClass)) {
            throw new \Exception('Invalid Filter class, got ' . $filterClass);
        }

        $filterClass = new $filterClass($filterConfig['options'], $filterConfig['enabled']);
        if(!$filterClass instanceof FilterInterface) {
            throw new \Exception('Filter must implement FilterInterface');
        }

        return $this->addFilter($filterClass);
    }

    public function addFilter(FilterInterface $filter)
    {
        $this->filters->set($filter->getName(), $filter);

        return $this;
    }

    /**
     * @param $mount
     *
     * @return Mount
     */
    public function createMount($mount)
    {

    }

    public function getMount($mount)
    {
        return $this->mounts->get($mount);
    }

    public function getMounts()
    {
        return $this->mounts->toArray();
    }

    public function resolvePath($path)
    {

    }
}