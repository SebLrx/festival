<?php

class CSRF {
  private $token = null;

  public function __construct() {
    $this->token = $this->generateToken();
  }

  public function generateToken() {
    return md5(uniqid(rand(), TRUE));
  }

  public function getToken() {
    return $this->token;
  }

  public function checkToken($token) {
    if ($token == $this->token) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteToken() {
    $this->token = null;
  }
}
