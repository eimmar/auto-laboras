<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.2.24
 * Time: 00.04
 */

namespace Controllers;


use Utils\Routing;
use Utils\Template;

class TrackController extends BaseController
{
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
}
