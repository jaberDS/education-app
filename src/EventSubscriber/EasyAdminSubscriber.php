<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Bundle\SecurityBundle\Security; // Updated import
use UserBundle\Entity\User;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $security;

    // Updated type hint for the new Security class
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['preInsert'],
        ];
    }

    public function preInsert(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof User) {
            $entity->setLocale('fr_FR');
        }
        /* 
        // Uncomment this section if you want to handle other entities
        else {
            $user = $this->security->getUser();
            
            if (!$entity->getCreatedAt()) {
                $entity->setCreatedBy($user);
                $entity->setCreatedAt(new \DateTime());
            }
            
            $entity->setEditedBy($user);
            $entity->setEditedAt(new \DateTime());
        }
        */
    }
}