
<?php
/*
* defined function responsible for loading class,
* replacing the old __ autoload.
* ROOT is constant of the path root of the system
*/
spl_autoload_extensions('.php');
spl_autoload_register('loadClasses');

function loadClasses($className)
{
   
    if ( file_exists(APP_PATH.DS.'app/controllers/'.$className.'.php' ) )
    {
        set_include_path(APP_PATH.DS.'controllers'.DS);
        spl_autoload($className);
    }
    elseif ( file_exists(APP_PATH.DS.'app/models/'.$className.'.php' ) )
    {
        set_include_path(APP_PATH.DS.'models'.DS);
        spl_autoload($className);
    }
    elseif ( file_exists(APP_PATH.DS.'app/views/'.$className.'.php' ) )
    {
        set_include_path(APP_PATH.DS.'views'.DS);
        spl_autoload($className);
    }
    else
    {
        set_include_path(APP_PATH.DS.'lib'.DS);
        spl_autoload($className);
    }
}
?>
