<?php

namespace Pbxg33k\FileBrowserBundle\Controller;

use Pbxg33k\FileBrowserBundle\Service\FileBrowser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @var FileBrowser
     */
    protected $fileBrowser;

    protected function init()
    {
        $this->fileBrowser = $this->get('pbxg33k_file_browser');
    }

    public function indexAction()
    {
        dump($this->fileBrowser);die();
        return $this->render('Pbxg33kFileBrowserBundle:Default:index.html.twig');
    }
}
