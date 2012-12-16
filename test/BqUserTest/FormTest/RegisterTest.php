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
            'nickname' => 'test',
            'email'    => 'test@test.com',
            'password' => '123qwe'
            ));
            
        $this->assertTrue($registerForm->isValid());
    }
    
    /**
     * @dataProvider inputNicknameErrorData
     **/
    public function testInputNicknameError($nickname, $email, $password) {
        $registerForm = new RegisterForm();
        $registerForm->setData(array(
            'nickname' => $nickname,
            'email'    => $email,
            'password' => $password
            ));
        $this->assertFalse($registerForm->isValid());
    }
    
    public function inputNicknameErrorData() {
        return array(
            array(null, 'test@test.com', '123qew')
            );
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