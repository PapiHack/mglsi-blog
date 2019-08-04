<?php

/**
 *
 * @author P@piHack3R
 * @since 25/06/19
 * @version 1.0.0
 *
 * Je géres l'autoloading des classes ici.
 *
 */

 function loadEntity($entity)
{
    $file = '../Model/Entity/'.$entity.'.class.php';

    if(file_exists($file))
        require_once($file);
}

function loadManager($manager)
{
    $file = '../Model/Manager/'.$manager.'.class.php';

    if(file_exists($file))
        require_once($file);
}

function loadData($dataClass)
{
    $file = '../Model/Data/'.$dataClass.'.class.php';

    if(file_exists($file))
        require_once($file);
}

function loadService($service)
{
    $file = '../Model/Service/'.$service.'.class.php';

    if(file_exists($file))
        require_once($file);
}

function loadController($controller)
{
  $file = '../Controller/'.$controller.'.php';

  if(file_exists($file))
      require_once($file);
}


spl_autoload_register('loadEntity');
spl_autoload_register('loadManager');
spl_autoload_register('loadData');
spl_autoload_register('loadService');
spl_autoload_register('loadController');
