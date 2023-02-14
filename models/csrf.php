<?php

class CSRF {
  private $token = null;

  public function __construct() {
    $this->token = $this->generateToken();
  }

  public function generateToken() {
    $this->token = md5(uniqid(rand(), true));
    return $this->token;
  }

  public function getToken() {
    return $this->token;
  }

  public function checkToken($token) {
    if (strcmp($token, $this->token)) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteToken() {
    $this->token = null;
  }
}
