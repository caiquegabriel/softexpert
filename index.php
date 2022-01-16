<?php  
     
    require_once('autoload.php');
    require_once('conf.php');
    require_once('helpers.php');
    require_once('core/db.php'); 

    if( isset($_GET['teste']) )
        require_once('teste.php'); 
    else
        require_once('controller.php'); 

?>