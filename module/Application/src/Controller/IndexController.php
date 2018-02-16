<?php

namespace Application\Controller;

use Application\Entity\Event;
use Doctrine\ORM\EntityManager;
use Zend\View\Model\ViewModel;

class IndexController extends BaseController
{
    /**
     * @return array|ViewModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function indexAction()
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getServiceManager()->get(EntityManager::class);

        $data = $entityManager->getRepository(Event::class)->findBy(
            ['active' => true],
            ['showDate' => 'ASC']
        );

        return new ViewModel([
            'data' => $data
        ]);
    }
}
