<?php

namespace Application\Controller;

use Application\Service\ServiceInterface;
use Doctrine\ORM\EntityManager;
use Exception;
use Zend\Http\Request;
use Zend\View\Model\ViewModel;

/**
 * Class CrudController
 * @package Application\Controller
 */
class CrudController extends BaseController
{
    /**
     * @var ServiceInterface
     */
    protected $service;

    /**
     * @var Form
     */
    protected $form;

    /**
     * @var AbstractApplicationRepository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $redirectMethod = 'toUrl';

    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * @var array
     */
    protected $orderBy = [];

    /**
     * @return ViewModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function addAction()
    {
        $errorMessages = [];
        /** @var Request $request */
        $request = $this->getRequest();

        if (!is_object($this->form)) {
            /** @var Form $form */
            $form = new $this->form();
        } else {
            $form = $this->form;
        }

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $form->setData($data);

            if ($form->isValid()) {
                $data = $form->getData();
                if (method_exists($this, 'bindDataToService')) {
                    $data = $this->bindDataToService($data);
                }

                /** @var ServiceInterface $service */
                $service = $this->getServiceLocator()->get($this->service);

                if ($result = $service->save($data)) {
                    if (method_exists($this, 'sendEmailNotification')) {
                        $this->sendEmailNotification($result, 'add');
                    }

                    $this->flashMessenger()->setNamespace('success')
                        ->addMessage('Registro Adicionado.');

                    return $this->redirect()->{$this->redirectMethod}($this->redirectTo);
                }
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
     * @return ViewModel
     * @throws Exception
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function editAction()
    {
        $errorMessages = [];
        /** @var Request $request */
        $request = $this->getRequest();

        if (!is_object($this->form)) {
            /** @var Form $form */
            $form = new $this->form('edit', true);
        } else {
            $form = $this->form;
        }

        $id = (int)$this->params()->fromRoute('id', 0);
        if ($id === 0) {
            throw new Exception('Invalid Register');
        }

        $entityManager = $this->getServiceLocator()->get(EntityManager::class);
        $data = $entityManager->find($this->repository, $id);

        $formData = $data->toArray();
        $formData['active'] = 1;

        if (!$data->isActive()) {
            $formData['active'] = 0;
        }

        if (method_exists($this, 'bindDataToForm')) {
            $formData = $this->bindDataToForm($formData);
        }

        $form->setData($formData);

        if ($request->isPost()) {
            $data = $request->getPost()->toArray();
            $data['id'] = $id;
            $form->setData($data);

            if ($form->isValid()) {
                /** @var ServiceInterface $service */
                $service = $this->getServiceLocator()->get($this->service);

                $data = $form->getData();
                if (method_exists($this, 'bindDataToService')) {
                    $data = $this->bindDataToService($data);
                }

                if ($result = $service->save($data)) {
                    if (method_exists($this, 'sendEmailNotification')) {
                        $this->sendEmailNotification($result, 'edit');
                    }
                    $this->flashMessenger()->setNamespace('success')
                        ->addMessage('Registro Editado.');

                    return $this->redirect()->{$this->redirectMethod}($this->redirectTo);
                }
            } else {
                $errorMessages = $this->form->getMessages();
            }
        }

        return new ViewModel([
            'form' => $form,
            'errorMessages' => $errorMessages,
            'data' => $data
        ]);
    }

    /**
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function deleteAction()
    {
        /** @var Request $request */
        $request = $this->getRequest();

        if ($request->isPost() || $request->isDelete()) {
            $id = (int)$this->params()->fromRoute('id', 0);
            /** @var ServiceInterface $service */
            $service = $this->getServiceLocator()->get($this->service);

            if ($service->delete($id)) {
                $this->flashMessenger()->setNamespace('success')
                    ->addMessage('Registro Removido');
            }
        }

        return $this->redirect()->{$this->redirectMethod}($this->redirectTo);
    }

    /**
     * @return ViewModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function viewAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        $entityManager = $this->getServiceLocator()->get(EntityManager::class);
        $data = $entityManager->find($this->repository, $id);

        return new ViewModel([
            'data' => $data
        ]);
    }

    /**
     * @param bool $active
     * @return ViewModel
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function indexAction($active = true)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getServiceLocator()->get(EntityManager::class);
        $collection = $entityManager->getRepository($this->repository)->findBy([
            'active' => $active
        ], $this->orderBy);

        return new ViewModel([
            'collection' => $collection
        ]);
    }
}
