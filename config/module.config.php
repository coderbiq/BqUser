<?php
return array(
    'service_manager' => array(
        'aliases' => array(
            'BqUser\Db\Adapter' => 'Zend\Db\Adapter\Adapter',
        ),
        'factories' => array(
            'User' => 'User\Service\User',
            'User\Auth' => 'User\Service\Auth',
        ),
    )
);
