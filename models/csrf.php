<?php

class CSRF
{
  private string $token = "";

  public function __construct()
  {
    $this->token = $this->generateToken();
  }

  public function generateToken(): string
  {
    $this->token = md5(uniqid(rand(), true));

    return $this->token;
  }

  public function getToken()
  {
    return $this->token;
  }

  public function checkToken($token)
  {
    if (strcmp($token, $this->token)) {
      $this->deleteToken();
      return true;
    } else {
      $this->deleteToken();
      return false;
    }
  }

  private function deleteToken(): void
  {
    $this->token = "";
  }
}
