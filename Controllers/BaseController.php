<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.3
 * Time: 22.12
 */

namespace Controllers;


use Repository\BaseRepository;
use Utils\Paging;
use Utils\Routing;
use Utils\Template;
use Utils\Validator;

abstract class BaseController
{
    /**
     * @var string
     */
    private $defaultAction;

    /**
     * @var array
     */
    protected $required;

    /**
     * @var array
     */
    protected $maxLengths;

    /**
     * @var array
     */
    protected $validations;

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
     * @return array
     */
    public function getRequired(): array
    {
        return $this->required;
    }

    /**
     * @param array $required
     * @return BaseController
     */
    public function setRequired(array $required): BaseController
    {
        $this->required = $required;
        return $this;
    }

    /**
     * @return array
     */
    public function getMaxLengths(): array
    {
        return $this->maxLengths;
    }

    /**
     * @param array $maxLengths
     * @return BaseController
     */
    public function setMaxLengths(array $maxLengths): BaseController
    {
        $this->maxLengths = $maxLengths;
        return $this;
    }

    /**
     * @return array
     */
    public function getValidations(): array
    {
        return $this->validations;
    }

    /**
     * @param array $validations
     */
    public function setValidations(array $validations): void
    {
        $this->validations = $validations;
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

        $template->setView($this->getControllerPrefix() . '_list');
    }

    public function createAction()
    {
        $data = $this->validateInput();

        if ($data) {
            $latestId = $this->getRepository()->getMaxId();
            $data['id'] = $latestId + 1;

            $this->getRepository()->insertEntity($data);
            Routing::redirect(Routing::getModule(), 'list');
        } else {
            $this->showForm();
        }
    }

    public function editAction()
    {
        $id = Routing::getId();
        $entity = $this->getRepository()->getModel($id);

        if ($entity == false) {
            Routing::redirect(Routing::getModule(), 'list', 'id_error=1');
            return;
        }

        $template = Template::getInstance();
        $template->assign('fields', $entity);

        $data = $this->validateInput();

        if ($data) {
            $data['id'] = $id;
            $this->getRepository()->updateEntity($data);
            Routing::redirect(Routing::getModule(), 'list');
        } else {
            $this->showForm();
        }
    }

    protected function showForm()
    {
        $template = Template::getInstance();
        $template->assign('required', $this->required);
        $template->assign('maxLengths', $this->maxLengths);

        $form = '\\Form\\' . ucfirst($this->getControllerPrefix()) . 'Form';
        $model = '\\Model\\' . ucfirst($this->getControllerPrefix());
        $template->assign('form', new $form(new $model()));
        $template->setView($this->getControllerPrefix() . '_form');
    }

    protected function validateInput()
    {
        if (empty($_POST['submit'])) {
            return false;
        }

        $validator = new Validator($this->validations, $this->required, $this->maxLengths);

        if (!$validator->validate($_POST)) {
            $template = Template::getInstance();

            $template->assign('fields', $_POST);
            $formErrors = $validator->getErrorHTML();
            $template->assign('formErrors', $formErrors);

            return false;
        }

        $data = $validator->preparePostFieldsForSQL();
        return $data;
    }

    public function deleteAction()
    {
        $id = Routing::getId();
        $err = ($this->getRepository()->deleteEntity($id)) ? '' : 'delete_error=1';
        Routing::redirect(Routing::getModule(), 'list', $err);
    }
}