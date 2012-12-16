<?php
namespace BqUser\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

abstract class Base extends Form
{
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->prepareElements();
        $this->prepareInputFilter();
    }

    protected function prepareElements() {
        $this->add(array(
            'type'     => 'Zend\Form\Element\Email',
            'name'     => 'email',            
            'options'  => array('label' => '电子邮件'),
        ));

        if($this->getOption('enable_username')) {
            $this->add(array(
                'name'       => 'username',
                'attributes' => array('type'  => 'text'),
                'options'    => array('label' => '用户名'),
            ));
        }

        $this->add(array(
            'name'       => 'nickname',
            'attributes' => array('type'  => 'text'),
            'options'    => array('label' => '昵称'),
        ));

        $this->add(array(
            'name'       => 'password',
            'options'    => array('label' => '密码'),
            'attributes' => array('type'  => 'password'),
        ));
    }

    protected function prepareInputFilter() {
        $inputFilters = new InputFilter();
        $inputFilters->add(array(
            'name' => 'nickname',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'string_length',
                    'options' => array('min'=>5, 'max'=>25)
                )
            ),
        ));
        $inputFilters->add(array(
            'name' => 'password',
            'required' => true,
            'filters' => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'=>'string_length', 
                    'options'=>array('min'=>5, 'max'=>25)
                )
            ),
        ));
        if($this->getOption('enable_username')) {
            $inputFilters->add(array(
                'name' => 'username',
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name'=>'string_length', 
                        'options'=>array('min'=>5, 'max'=>25)
                    ),
                    array('name' => 'alnum'))
                )
            ));
        }

        $this->setInputFilter($inputFilters);
    }
}
