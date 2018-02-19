<?php

namespace ApplicationTest\Service;

use Application\Service\EventService;
use Application\Service\FirebaseService;
use Zend\Stdlib\ArrayUtils;
use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

/**
 * Class RegisteredServicesTest
 * @package ApplicationTest\Service
 */
class RegisteredServicesTest extends AbstractControllerTestCase
{
    public function setUp()
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    /**
     * @test
     */
    public function eventService()
    {
        $this->assertInstanceOf(
            EventService::class,
            $this->getApplicationServiceLocator()->get(EventService::class)
        );
    }

    /**
     * @test
     */
    public function firebaseService()
    {
        $this->assertInstanceOf(
            FirebaseService::class,
            $this->getApplicationServiceLocator()->get(FirebaseService::class)
        );
    }
}
