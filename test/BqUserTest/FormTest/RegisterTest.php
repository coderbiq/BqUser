<?php
namespace BqUseTest\FormTest;

use PHPUnit_Framework_TestCase;
use Zend\Mvc\Application;
use BqUser\Form\Register as RegisterForm;

class RegisterTest extends PHPUnit_Framework_TestCase
{
    public function testInput() {    
        $registerForm = new RegisterForm();
        $registerForm->setData(array(
            'nickname' => 'test1',
            'email'    => 'test@test.com',
            'password' => '123qwe'
            ));
            
        $this->assertTrue($registerForm->isValid());
    }
    
    /**
     * @dataProvider inputErrorData
     **/
    public function testInputError($data) {
        $registerForm = new RegisterForm();
        $registerForm->setData($data);
        $this->assertFalse($registerForm->isValid());
    }
    
    public function inputErrorData() {
        $trueData = array(
            'nickname' => 'test1', 
            'email'=>'test@test.com', 
            'password'=>'123qew');
        $errorDatas = array();

        $errorData = $trueData;
        unset($errorData['nickname']);
        $errorDatas[] = array($errorData);

        $errorData = $trueData;
        $errorData['nickname'] = 'abc';
        $errorDatas[] = array($errorData);

        $errorData = $trueData;
        for($loop=0; $loop<=30; $loop++)
            $errorData['nickname'] .= 'a';
        $errorDatas[] = array($errorData);

        $errorData = $trueData;
        unset($errorData['email']);
        $errorDatas[] = array($errorData);

        $errorData = $trueData;
        $errorData['email'] = 'abc';
        $errorDatas[] = array($errorData);

        $errorData = $trueData;
        unset($errorData['password']);
        $errorDatas[] = array($errorData);

        $errorData = $trueData;
        $errorData['password'] = 'a';
        $errorDatas[] = array($errorData);

        return $errorDatas;
    }
    
    protected function getServiceLocator() {
        $serviceManager = $this->app->getServiceManager();
        $serviceManager->setAllowOverride(true);
        return $serviceManager;
    }

    protected function setUp() {
        $this->app = Application::init(include 'config/application.config.php');
    }
}
