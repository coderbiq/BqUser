<?php
namespace BqUser\Entity;

interface UserInterface
{
    public function getNickname();
    public function setNickname($nickname);
    public function getEmail();
    public function setEmail($emial);
    public function getProfileImage($size);
}
