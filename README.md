README
======

Provides e-mail error notification for your Symfony2 Project (only exceptions right now)


Requirements
============

- Twig
- Swift Mailer

Installation
============

Add RoxWayErrorNotifyBundle to your vendor/bundles/ dir
------------------------------------------

::

    $ git submodule add git://github.com/szymek/RoxWayErrorNotifyBundle.git vendor/bundles/RoxWay/Bundle/ErrorNotifyBundle

Add the RoxWay namespace to your autoloader
----------------------------------------

::

    // app/autoload.php
    $loader->registerNamespaces(array(
        'RoxWay' => __DIR__.'/../vendor/bundles',
        // your other namespaces
    );

Add RoxWayErrorNotifyBundle to your application kernel
-----------------------------------------

::

    // app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new RoxWay\Bundle\ErrorNotifyBundle\RoxWayErrorNotifyBundle(),
            // ...
        );
    }



Configure your project
----------------------

::

	rox_way_error_notify:
	  is_enable: true
	  to_mail: error_notify_to_mail@example.com
	  from_mail: error_notify_from_mail@example.com