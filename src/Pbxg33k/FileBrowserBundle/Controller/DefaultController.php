<?php

namespace Pbxg33k\FileBrowserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Pbxg33kFileBrowserBundle:Default:index.html.twig');
    }
}
