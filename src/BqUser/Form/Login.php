<?php
namespace BqUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Login extends Form
{
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->add(array(
            'name'       => 'login',
            'attributes' => array(
                'type'   => 'submit',
                'class'  => 'btn btn-primary'
            ),
            'options' => array('label' => '登录')
        ));
    }
}
