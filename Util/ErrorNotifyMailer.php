<?php

namespace RoxWay\Bundle\ErrorNotifyBundle\Util;

/**
 * Error notification mailer
 *
 * @author Szymon Szewczyk <s.szewczyk@roxway.pl>
 */
class ErrorNotifyMailer {

    /**
     * SwiftMailer
     * 
     * @var Object
     */
    protected $SwiftMailer;
    /**
     * ServiceContainer
     * 
     * @var Object
     */
    protected $Container;

    public function setSwiftMailer(\Swift_Mailer $SwiftMailer) {
        $this->SwiftMailer = $SwiftMailer;
    }

    public function getSwiftMailer() {
        return $this->SwiftMailer;
    }

    public function setContainer($Container) {
        $this->Container = $Container;
    }

    public function getContainer() {
        return $this->Container;
    }

    /**
     * Send error notify mail
     *
     * @param \Exception $Exception
     * @param Request $Request
     * @return void
     */
    public function sendException(\Exception $Exception) {
        if ($this->_isEnable()) {
            $Request = $this->_getRequest();
            $Message = \Swift_Message::newInstance()
                    ->setSubject('Error message from ' . $Request->getHost() . ' - ' . $Exception->getMessage())
                    ->setFrom($this->_getFromMail())
                    ->setTo($this->_getToMail())
                    ->setContentType('text/html')
                    ->setBody(
                            $this->_getTemplating()->render(
                                    $this->_getMailTemplate(), array(
                                        'request' => $Request,
                                        'exception' => $Exception,
                                        'exception_class' => \get_class($Exception),
                                        'request_headers' => $Request->server->getHeaders(),
                                        'request_attributes' => $Request->attributes->all(),
                                        'server_params' => $Request->server->all()
                                    )
                            )
                    );

            try {
                $this->getSwiftMailer()->send($Message);
            } catch (Exception $e) {
                $this->getContainer()->get('logger')->err('Sending mail error - ' . $e->getMessage());
            }
        }
    }
    
    protected function _getRequest() {
        return $this->getContainer()->get('request');
    }
    
    protected function _getTemplating() {
        return $this->getContainer()->get('templating');
    }
    
    protected function _isEnable() {
        return $this->getContainer()->getParameter('roxway.error_notify.is_enable');
    }
    
    protected function _getFromMail() {
        return $this->getContainer()->getParameter('roxway.error_notify.from_mail');
    }
    
    protected function _getToMail() {
        return $this->getContainer()->getParameter('roxway.error_notify.to_mail');
    }
    
    protected function _getMailTemplate() {
        return $this->getContainer()->getParameter('roxway.error_notify.mail.template');
    }

}