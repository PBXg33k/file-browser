<?php
/**
 * Created by PhpStorm.
 * User: PBX_g33k
 * Date: 4/6/2017
 * Time: 8:57 PM
 */

namespace Pbxg33k\FileBrowserBundle\Filter;


/**
 * Interface FilterInterface
 * @package Pbxg33k\FileBrowserBundle\Filter
 */
interface FilterInterface
{
    /**
     * FilterInterface constructor.
     * @param $options
     */
    public function __construct($options);

    /**
     * @return string
     */
    public function getName();

    /**
     * Return if filter filters directories
     *
     * @return mixed
     */
    public function filtersDirectories();

    /**
     * Return if filter filters files
     *
     * @return mixed
     */
    public function filtersFiles();

    /**
     * Return if filter filters links
     *
     * @return mixed
     */
    public function filtersLinks();

    /**
     * @return boolean
     */
    public function isEnabled();

    public function enable();

    public function disable();

    /**
     * Return false if item does not pass filter
     *
     * @param $fileOrDirectory
     *
     * @return boolean
     */
    public function filter($fileOrDirectory);
}