<?php
namespace BqUser\Db\Table;

use BqCore\Db\Table\AbstractTable

class User extends AbstractTable
{
    public static function getTableName() { return 'bquser_user'; }
}
