<?php
return array(
    'service_manager' => array(
        'aliases' => array(
            'BqUser\Db\Adapter' => 'Zend\Db\Adapter\Adapter',
        ),
        'factories' => array(
            'BqUser\User'         => 'User\Service\User',
            'BqUser\User\Auth'    => 'User\Service\Auth',
            'BqUser\User\Account' => 'User\Service\Account'
        ),
    ),

    'entities' => array(
        'bquser\user' => array(
            'service' => 'BqUser\User'
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'BqUser\Controller\Index' => 'BqUser\Controller\IndexController'
        ),
    ),

    'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'BqUser\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'register' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/register.html',
                            'defaults' => array(
                                'action' => 'register'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'BqUser' => __DIR__ . '/../view',
        ),
    ),

);
