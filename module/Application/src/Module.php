<?php

namespace Application;

use Application\Service\EventService;
use Application\Service\FirebaseService;
use Firebase\FirebaseLib;
use Zend\ServiceManager\ServiceManager;

/**
 * Class Module
 * @package Application
 */
class Module
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                EventService::class => function (ServiceManager $serviceManager) {
                    return new EventService($serviceManager);
                },
                FirebaseService::class => function(ServiceManager $serviceManager) {
                    $firebaseConfig = $serviceManager->get('config')['firebase'];

                    $firebaseLib = new FirebaseLib(
                        $firebaseConfig['default_url'],
                        $firebaseConfig['default_token']
                    );

                    return new FirebaseService($firebaseLib, $firebaseConfig['default_path']);
                }
            ]
        ];
    }
}
