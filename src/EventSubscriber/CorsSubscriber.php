<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CorsSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event)
    {
        $event->getResponse()->headers->add([
            "Access-Control-Allow-Origin"=>"*",
            "Access-Control-Allow-Headers"=>"Content-Type",
            "Access-Control-Allow-Methods"=>"GET, POST, OPTIONS, DELETE"
        ]);
        // ...
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.response' => 'onKernelResponse',
        ];
    }
}
