<?php
namespace BqUser\Entity;

use BqCore\Entity\AbstractEntity;

class User extends AbstractEntity implements UserInterface
{
    public function getNickname() { return $this->nickname; }
    public function setNickname($nickname) {
        $this->nickname;
        return $this;
    }

    public function getEmail() { return $this->email; }
    public function setEmail($email) {
        $this->email;
        return $this;
    }

    public function getProfileImage($size) {
    }
}
