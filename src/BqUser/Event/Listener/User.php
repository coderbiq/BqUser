<?php
namespace BqUser\Event\Listener;

use Zend\EventManager\EventManagerInterface;
use BqCore\Event\Listener\AbstractListener;
use BqCore\Event\EntityEvent;
use BqUsre\Entity\UserInterface;
use BqUser\Entity\AccountInterface;

class User extends AbstractListener
{
    protected $bindTableName;

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
            $this->bindAccount($target, $relyonEntity);
        }
    }

    public function getBindTableName() { return $this->bindTableName; }
    public function setBindTableName($tableName) {
        $this->bindTableName = $tableName;
        return $this;
    }

    protected function bindAccount(UserInterface $user, 
        AccountInterface $account) {
        $row = new RowGateway('id', $this->getBindTable()->getTable(), 
            $this->getBindTable()->getAdapter());
        $row->userId = $user->getId();
        $row->accountId = $account->getId();
        $row->accountEntityName = $account->getEntityName();
        $row->created = time();
        $row->save();
    }

    protected function getBindTable() {
        return new TableGateway($this->getBindTableName(), 
            $this->getServiceLocator()->get('BqUser\Db\Adapter'));
    }
}
