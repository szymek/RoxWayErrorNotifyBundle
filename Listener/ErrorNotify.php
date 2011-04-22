<?php

namespace RoxWay\Bundle\ErrorNotifyBundle\Listener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use RoxWay\Bundle\ErrorNotifyBundle\Util\ErrorNotifyMailer;

/**
 * Error notification listener
 *
 * @author Szymon Szewczyk <s.szewczyk@roxway.pl>
 */
class ErrorNotify {

    /**
     * ErrorNotify mailer
     *
     * @var Object
     */
    protected $Mailer;

    /**
     * Exception error handler
     *
     * @param GetResponseForExceptionEvent $Event
     * @return void
     */
    public function onCoreException(GetResponseForExceptionEvent $Event) {
        $this->getErrorNotifyMailer()->sendException($Event->getException());
    }
    
    public function setErrorNotifyMailer(ErrorNotifyMailer $Mailer) {
        $this->Mailer = $Mailer;
    }
    
    public function getErrorNotifyMailer() {
        return $this->Mailer;
    }

}