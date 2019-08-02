<?php

/**
 *
 * @author alioune
 * @since 02/08/19
 */
class GenerateToken
{
  private $tokens;

  public function __construct()
  {
    $tokens = new TokenManager()->getAll();
  }

  private function generateAleatorString()
  {
    $aleatorString = [];
    $str = str_split('0123456789abcddefghijklmnopqrstuvwxyz@_-ABCCDEFGHIJKLMNOPQRSTUVWXYZ');
    $length = rand(10,65);
    for($i=0;$i<$length;$i++){
        $aleatorString[] = $str[rand(0,64)];
    }
    return implode('',$aleatorString);
  }

  private function exists($token)
  {
    foreach($this->tokens as $t)
    {
      if($t->getToken() !== $token)
      {
        return true;
      }
    }

    return false;
  }

  public function getToken()
  {
    $token = '';
    do
    {
      $token = $this->generateAleatorString();
    } while (exists($token));

    return $token;
  }

}
