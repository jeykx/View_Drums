<?php

namespace App\Listener;

use App\Entity\Property;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;


class ImageCacheSubscriber implements EventSubscriber {
    
    /**
     * @var CacheManager
     */
    private $cacheManager;
    
    /**
     * @var UploaderHelper
     */
    private $uploaderHelper;
    
    public function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper) 
    
    {
        
        $this->cacheManager = $cacheManager;
        $this->UploaderHelper = $uploaderHelper;
    }
    
    /**
     * @return string[]
     */
    public function getSubscribedEvents() {
        return [
            'preRemove',
            'preUpdate'
        ];
    }

    public function preRemove(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        if(!$entity instanceof Drum) {
            return;
        }

        $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));

    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();
        if(!$entity instanceof Drum) {
            return;
        }

        if ($entity->getImageFile() instanceof UploadedFile) {
            $this->cacheManager->remove($this->uploaderHelper->asset($entity, 'imageFile'));
        }

    }

}