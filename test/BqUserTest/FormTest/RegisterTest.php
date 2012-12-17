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

    /**
     * @dataProvider usernameData
     */
    public function testUsernameInput($username, $isValid) {
        $data = array(
            'nickname' => 'test1', 
            'email'=>'test@test.com', 
            'password'=>'123qew');

        $registerForm = new RegisterForm('register', 
            array('enable_username'=>true));
        $registerForm->setData($data);
        $this->assertFalse($registerForm->isValid());

        $data['username'] = $username;
        $registerForm->setData($data);
        $this->assertEquals($isValid, $registerForm->isValid());
    }

    public function usernameData() {
        $longName = '';
        for($loop=0; $loop<30; $loop++)
            $longName .= 'a';

        return array(
            array('test1'   , true),
            array('test-1'  , true),
            array('1-test'  , false),
            array('test 1'  , false),
            array('t'       , false),
            array($longName , false),
        );
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
