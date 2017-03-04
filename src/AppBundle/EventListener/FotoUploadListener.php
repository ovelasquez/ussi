<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AppBundle\Entity\Persona;
use AppBundle\FileUploader;
use Symfony\Component\HttpFoundation\File\File;

class FotoUploadListener {

    private $uploader;

    public function __construct(FileUploader $uploader) {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof Persona) :
            $this->uploadFile($entity);
        endif;
    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof Persona) :
            $this->uploadFile($entity);
        endif;
    }

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof Persona) :
            $fileName = $entity->getFoto();            
            $entity->setFoto(new File($fileName, false));
        endif;
    }

    private function uploadFile($entity) {
        // upload only works for User entities
        if (!$entity instanceof Persona) {
            return;
        }

        $file = $entity->getFoto();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        
        $entity->setFoto(new File($fileName, false));
    }

}
