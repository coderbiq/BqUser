<?php
namespace BqUser\Service;

use BqCore\Service\AbstractTableService;
use BqUser\Entity\User as UserEntity;

class User extends AbstractTableService
{
    public function createEntity() {
        $userEntity = new UserEntity('id', $this->getTable(), 
            $this->getAdapter());
        return $userEntity;
    }

    public static function getTableName() { return 'bquser_user'; }
    public static function getAdapterServiceName() { return 'User\Db\Adapter'; }
}
