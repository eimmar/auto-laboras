<?php
namespace Controllers;

use Utils\Routing;
use Utils\Template;

class CarController extends BaseController
{
    public function createAction()
    {
        $entity = $this->getRepository()->createEntity();
        $form = $this->getForm($entity, false)->validate($_POST);
        $template = Template::getInstance();

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getRepository()->insertAllRelatedEntities($form);
            Routing::redirect(Routing::getModule(), 'list');
        } else {
            $template
                ->assign('form', $form)
                ->setView('form/entity_form');
        }
    }
}
