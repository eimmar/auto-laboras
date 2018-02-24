<?php
namespace Utils;

/**
 * Puslapio šablono panaudojimo klasė
 *
 * @author V.Sutkus, <v.sutkus@ktu.edu>, IF-4/2
 */

class Template
{

    private static $instance = null;

    private $enabled = true;
    private $data = array();
    private $view;

    public static function getInstance()
    {
        if (self::$instance === null)
            self::$instance = new Template();

        return self::$instance;
    }

    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    public function render()
    {
        if (!$this->enabled || empty($this->view))
            return;

        extract($this->data);

        require('view/' . $this->view . '.php');
    }

    public function assign($name, $variable)
    {
        $this->data[$name] = $variable;
        return $this;
    }

    public function disableRendering()
    {
        $this->enabled = false;
        return $this;
    }
};
