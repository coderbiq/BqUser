<?php
namespace BqUser\Service;

use BqCore\Service\AbstractTableService;
use BqUser\Entity\User as UserEntity;

class User extends AbstractTableService
{
    public function createEntity() {
        $user = new UserEntity('id', $this->getTable(), 
            $this->getAdapter());
        $user = $this->prepareEntity($user);
        return $userEntity;
    }

    public function getEntityName() { return 'bquser\user'; }
    public static function getTableName() { return 'bquser_user'; }
    public static function getAdapterServiceName() { return 'User\Db\Adapter'; }
}
