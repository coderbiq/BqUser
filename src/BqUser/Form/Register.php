<?php
namespace BqUser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class Register extends Form
{
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->initElements();
    }

    protected function initElements() {
        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options'=> array(
                'label' => '电子邮件'
            )));

        $this->add(array(
            'name' => 'id',
            'attributes'=> array(
                'type' => 'hidden',
                'value' => '2'
            )));

        $this->add(array(
            'name' => 'password',
            'options' => array(
                'label' => '密码',
            ),
            'attributes' => array(
                'type' => 'password'
            )));

        $this->add(array(
            'name' => 'register',
            'attributes' => array(
                'type' => 'submit',
                'class' => 'btn btn-primary'
            ),
            'options' => array(
                'label' => '注册'
            )));
    }
}
