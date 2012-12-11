<?php
namespace BqUser\Service;

use BqCore\Service\AbstractTableService;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Db\RowGateway\RowGateway;

class Account extends AbstractTableService implements AdapterInterface
{
    protected $authAccount;

    public function validateEmailAndPassword($email, $password) {
        $account = $this->select(array('email'=>$email))->current();
        if(!empty($account)) {
            if($account->password == md5($password))
                $this->authAccount = $account;
        }

        return $this;
    }

    public function authenticate() {
        if(empty($this->authAccount))
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND);

        return new Result(Result::SUCCESS, $this->authAccount->userId);
    }

    public function createEntity() {
        return new RowGateway('id', $this->getTable(), $this->getAdapter());
    }

    public static function getTableName() { return 'bquser_account'; }
    public static function getAdapterServiceName() { return 'User\Db\Adapter'; }
}
