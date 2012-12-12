<?php
namespace BqUser\Entity;

class Account extends AbstractEntity implements AccountInterface
{
    protected $user;
    protected $userService;

    public function getUser() {
        if($this->user === null) {
            $this->user = $userService->search(array('id'=>$this->user_id))
                ->current();
        }
        return $this->user;
    }

    public function setUser(UserInterface $user) {
        $this->user = $user;
        return $this;
    }

    public function getEmail() { return $this->email; }
    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getPassword() { return $this->password; }
    public function setPassword($password) {
        $this->password = md5($password);
        return $this;
    }
}
