<?php
namespace BqUser\Event\Listener;

use Zend\EventManager\EventManagerInterface;
use BqCore\Event\Listener\AbstractListener;
use BqCore\Event\EntityEvent;

class User extends AbstractListener
{
    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->attach(
            EntityEvent::EVENT_ADD_RELYON_ENTITY,
            array($this, 'onAddRelyonEntity')
        );
    }

    public function onAddRelyonEntity($event) {
        $target = $event->getTarget();
        $relyonEntity = $event->getRelyonEntity();
        if($target instanceof UserInterface 
            && $relyonEntity instanceof AccountInterface) {

            $config = $this->getServiceLocator()->get('BqUser\Config')
                ->get('account_manager');
            $adapterName = $config->get('adapter');
            $option = $config->get('options');

            $accountManager = new $adapterName($options);
            $accountManager->setUser($target)
                ->setServiceLocator($this->getServiceLocator())
                ->bindAccount($relyonEntity);
        }
    }
}
