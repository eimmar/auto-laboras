<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.3
 * Time: 22.12
 */

namespace Controllers;


use Form\BaseForm;
use Model\Entity;
use Repository\BaseRepository;
use Utils\Message;
use Utils\Paging;
use Utils\Routing;
use Utils\Template;

abstract class BaseController
{
    /**
     * @var string
     */
    private $defaultAction;

    /**
     * @var string
     */
    protected $controllerPrefix;

    /**
     * @var BaseRepository
     */
    protected $repository;

    public function __construct()
    {
        $namespace = explode('\\', get_class($this));
        $this->setControllerPrefix(strtolower(str_replace('Controller', '', end($namespace))))
            ->setDefaultAction('list');

        $repositoryClass = '\Repository\\' . ucfirst($this->getControllerPrefix()) . 'Repository';
        $this->repository = new $repositoryClass();
    }

    /**
     * @param Entity $entity
     * @param bool $isEdit
     * @return BaseForm
     */
    protected function getForm($entity, bool $isEdit = false)
    {
        $form = '\\Form\\' . ucfirst($this->getControllerPrefix()) . 'Form';
        return new $form($entity, $isEdit);
    }

    /**
     * @return string
     */
    public function getDefaultAction(): string
    {
        return $this->defaultAction;
    }

    /**
     * @param string $defaultAction
     * @return BaseController
     */
    public function setDefaultAction(string $defaultAction): BaseController
    {
        $this->defaultAction = $defaultAction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getControllerPrefix()
    {
        return $this->controllerPrefix;
    }

    /**
     * @param mixed $controllerPrefix
     * @return BaseController
     */
    public function setControllerPrefix($controllerPrefix): BaseController
    {
        $this->controllerPrefix = $controllerPrefix;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    public function listAction()
    {
        $elementCount = $this->getRepository()->getListCount();
        $paging = new Paging(NUMBER_OF_ROWS_IN_PAGE);
        $paging->process($elementCount, Routing::getPageId());
        $data = $this->getRepository()->getModels($paging->size, $paging->first);

        $template = Template::getInstance();
        $template->assign('data', $data);
        $template->assign('pagingData', $paging->data);

        if (!empty($_GET['delete_error']))
            $template->assign('delete_error', true);

        if (!empty($_GET['id_error']))
            $template->assign('id_error', true);

        $template->setView('list/' . $this->getControllerPrefix() . '_list');
    }

    public function createAction()
    {
        $entity = $this->getRepository()->createEntity();
        $form = $this->getForm($entity, false)->validate();
        $template = Template::getInstance();

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getRepository()->insertEntity($form->getRawData());
            Routing::redirect(Routing::getModule(), 'list');
        } else {
            $template
                ->assign('form', $form)
                ->setView('form/entity_form');
        }
    }

    public function editAction()
    {
        $entity = $this->getRepository()->getModel(Routing::getId());
        $template = Template::getInstance();

        if ($entity === false) {
            Routing::redirect(Routing::getModule(), 'list', 'id_error=1');
        }

        $form = $this->getForm($entity, true)->validate();
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getRepository()->updateEntity($entity->getId(), $form->getRawData());
            Routing::redirect(Routing::getModule(), 'list');
        } else {
            $template
                ->assign('form', $form)
                ->setView('form/entity_form');
        }
    }

    public function deleteAction()
    {
        $id = Routing::getId();
        $err = ($this->getRepository()->deleteEntity($id)) ? '' : 'delete_error=1';
        Routing::redirect(Routing::getModule(), 'list', $err);
    }
}
