<?php

namespace AppBundle\Controller;

use League\Flysystem\FilesystemInterface;
use League\Flysystem\MountManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @var array
     */
    protected $fileSystems;

    /**
     * @var MountManager
     */
    protected $mountManager;

    protected function init()
    {
        $this->fileSystems  = $this->container->getParameter('davfs.filesystems');
        $this->mountManager = $this->get('oneup_flysystem.mount_manager');
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->init();

        $mounts = [];
        foreach($this->fileSystems as $fileSystem) {
            /** @var FilesystemInterface $currentMount */
            $mounts[$fileSystem] = $currentMount = $this->mountManager->getFilesystem($fileSystem);
            dump(
                $currentMount,
                $currentMount->listContents()
            );
        }

        return new Response();

        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', array(
//            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
//        ));
    }

    /**
     * @param Request $request
     * @Route("/{vfs_mount}", name="vfs_root")
     */
    public function getVfsRootAction(Request $request, $vfs_mount)
    {
        $this->init();

        if(!in_array($vfs_mount, $this->fileSystems)) {
            throw new NotFoundHttpException('FS Not found');
        }

        $mount = $this->mountManager->getFilesystem($vfs_mount);

        $content = $mount->listContents();

        dump($this->getFilteredList($content));die();
    }

    /**
     * @param Request $request
     * @param $vfs_mount
     * @param $path
     *
     * @Route("/{vfs_mount}/{path}", name="vfs_path", requirements={"vfs_mount": "[^\/]+", "path": ".*"})
     */
    public function getVfsPath(Request $request, $vfs_mount, $path)
    {
        $this->init();

        if(!in_array($vfs_mount, $this->fileSystems)) {
            throw new NotFoundHttpException('FS Not found');
        }

        $fs = $this->mountManager->getFilesystem($vfs_mount);

        $handler = $fs->get($path);
        if($handler->isDir()) {
            dump(
                $this->getFilteredList($handler->getFilesystem()->listContents($handler->getPath()))
            );die();
        } elseif($handler->isFile()) {
            dump(
                $fs->getMetadata($handler->getPath()),
                $fs->getMimetype($handler->getPath()),
                $fs->getVisibility($handler->getPath())
            ); die();
        }
    }


    private function getFilteredList(array $content)
    {
        $filterFiles        = $this->container->getParameter('davfs.filter_files');
        $filterExtensions   = $this->container->getParameter('davfs.filtered_extensions');

        $list = [];

        foreach($content as $item) {
            if(
                $filterExtensions
                && (
                    $item['type'] == 'dir'
                    || (
                        $item['type'] == 'file' && in_array($item['extension'], $filterExtensions)
                    )
                )
            ) {
                $list[] = $item;
            }
        }

        return $list;
    }
}
