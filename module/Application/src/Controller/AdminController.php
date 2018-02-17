<?php

namespace Application\Controller;

use Application\Entity\Event;
use Application\Form\EventForm;
use Application\Service\EventService;
use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class AdminController
 * @package Application\Controller
 */
class AdminController extends AbstractActionController
{
    use ControllerTrait;

    /**
     * @param bool $active
     * @return \Zend\View\Model\ViewModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function indexAction($active = true)
    {
        $this->layout('layout/admin');

        /** @var EntityManager $entityManager */
        $entityManager = $this->getServiceManager()->get(EntityManager::class);
        $collection = $entityManager->getRepository(Event::class)->findBy(
            ['active' => $active],
            ['showDate' => 'ASC']
        );

        return new ViewModel([
            'collection' => $collection
        ]);
    }

    /**
     * @return \Zend\View\Model\ViewModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function viewAction()
    {
        $this->layout('layout/admin');

        $id = (int)$this->params()->fromRoute('id', 0);
        $entityManager = $this->getServiceManager()->get(EntityManager::class);
        $data = $entityManager->find(Event::class, $id);

        return new ViewModel([
            'data' => $data
        ]);
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function addAction()
    {
        $errorMessages = [];
        /** @var Request $request */
        $request = $this->getRequest();
        $form = new EventForm();

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $this->bindDataToService($form->getData());
                return $this->performSave($data, 'Evento Adicionado.');
            } else {
                $errorMessages = $form->getMessages();
            }
        }

        return new ViewModel([
            'form' => $form,
            'errorMessages' => $errorMessages
        ]);
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     * @throws Exception
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function editAction()
    {
        $errorMessages = [];
        /** @var Request $request */
        $request = $this->getRequest();
        $form = new EventForm();
        $id = (int)$this->params()->fromRoute('id', 0);

        if ($id === 0) {
            throw new Exception('Invalid Register');
        }

        $entityManager = $this->getServiceManager()->get(EntityManager::class);
        /** @var Event $event */
        $event = $entityManager->find(Event::class, $id);

        $formData = $event->toArray();
        $formData['active'] = 1;

        if (!$event->isActive()) {
            $formData['active'] = 0;
        }

        $form->setData($this->bindDataToForm($formData));

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $data['id'] = $id;
            $form->setData($data);

            if ($form->isValid()) {
                $data = $this->bindDataToService($form->getData());
                return $this->performSave($data, 'Evento Editado.');
            } else {
                $errorMessages = $form->getMessages();
            }
        }

        return new ViewModel([
            'form' => $form,
            'errorMessages' => $errorMessages,
            'data' => $event
        ]);
    }

    /**
     * @return \Zend\Http\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function deleteAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost() || $request->isDelete()) {
            $id = (int)$this->params()->fromRoute('id', 0);

            /** @var EventService $eventService */
            $eventService = $this->getServiceManager()->get(EventService::class);

            if ($eventService->delete($id)) {
                $this->flashMessenger()->setNamespace('success')
                    ->addMessage('Evento Removido');
            }
        }

        return $this->redirect()->toRoute('admin-event');
    }

    /**
     * @param $data
     * @return mixed
     */
    private function bindDataToForm($data)
    {
        $data['showDate'] = $data['showDate']->format('d/m/Y H:i');
        $data['ticketAmount'] = 'R$ ' . number_format($data['ticketAmount'], 2, ',', '.');

        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function bindDataToService($data)
    {
        if (isset($data['id']) && $data['id'] == 0) {
            unset($data['id']);
        }

        $data['ticketAmount'] = (float)str_replace(['R$ ', '.', ','], ['', '', '.'], $data['ticketAmount']);
        $data['showDate'] = new DateTime(str_replace('/', '-', $data['showDate']));

        return $data;
    }

    /**
     * @param $data
     * @param $flashMessage
     * @return bool|\Zend\Http\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function performSave($data, $flashMessage)
    {
        /** @var EventService $eventService */
        $eventService = $this->getServiceManager()->get(EventService::class);

        if ($result = $eventService->save($data)) {
            $this->flashMessenger()->setNamespace('success')
                ->addMessage($flashMessage);

            return $this->redirect()->toRoute('admin-event');
        }

        return false;
    }
}
