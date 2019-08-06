<?php

require_once('vendor/autoload.php');
require_once('MySoapServer.php');
use Zend\Soap\AutoDiscover;
use Zend\Soap\Server;


/**
 *
 */
class MySoapService
{
  private $soapServer;

  function __construct()
  {
    $this->soapServer = new MySoapServer();
  }

  public function getWsdl()
  {
    $autodiscover = new AutoDiscover();
    $autodiscover->setOperationBodyStyle(array(
      'use' => 'literal',
      'namespace' => 'http://schemas.xmlsoap.org/soap/encoding/'
    ));
    $autodiscover->setClass('MySoapServer');
    $autodiscover->setUri('http://localhost/mglsi-blog/Api/Soap/MySoapServer.php');
    header('Content-Type: application/xml');
    echo $autodiscover->toXml();
  }
}
