<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Imagen;
use AppBundle\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class ImagenUploadListener {

    private $uploader;

    public function __construct(FileUploader $uploader) {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof Imagen) :
            $this->uploadFile($entity);
        endif;
    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof Imagen) :
            $this->uploadFile($entity);
        endif;
    }

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof Imagen) :
            $fileName = $entity->getNombre();            
            $entity->setNombre(new File($fileName, false));
        endif;
    }

    private function uploadFile($entity) {
        // upload only works for User entities
        if (!$entity instanceof Imagen) {
            return;
        }

        $file = $entity->getNombre();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        
        $entity->setNombre(new File($fileName, false));
    }

}
