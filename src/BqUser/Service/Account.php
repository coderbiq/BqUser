<?php
namespace BqUser\Service;

use BqCore\Service\AbstractTableService;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Db\RowGateway\RowGateway;
use BqUser\Entity\Account as AccountEntity;

class Account extends AbstractTableService implements AdapterInterface
{
    protected $authAccount;

    public function validateEmailAndPassword($email, $password) {
        $account = $this->select(array('email'=>$email))->current();
        if(!empty($account)) {
            if($account->getPassword() == md5($password))
                $this->authAccount = $account;
        }

        return $this;
    }

    public function authenticate() {
        if(empty($this->authAccount))
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND);

        return new Result(Result::SUCCESS, 
            $this->authAccount->getUser()->getId());
    }

    public function createEntity() {
        $account = new AccountEntity('id', $this->getTable(), 
            $this->getAdapter());
        $account->setUserEntityName($this->getServiceLocator()
            ->get('BqUser\User')->getEntityName());
        $account = $this->parseEntity($account);
        return $account;
    }

    public function getEntityName() { return 'bquser\account'; }
    public static function getTableName() { return 'bquser_account'; }
    public static function getAdapterServiceName() { return 'User\Db\Adapter'; }
}
