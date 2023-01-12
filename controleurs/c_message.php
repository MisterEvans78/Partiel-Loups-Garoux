<?php

$data=$_POST;
$data1=$_POST['param'];

switch ($data1) {
    case 'uploadMessage':{
        $idJoueur=$_POST['param3'];
        $idRoom=$_POST['param2'];
        $date= new DateTime();
        $message=$_POST['param1'];
        uploadMsg($message,$idJoueur,$idRoom,$date);
        break;
    }
    
    case "dlMessage":{
        $idRoom=$_POST['param1'];
        $msg=dlMsg($idRoom);
        $countM=count($msg);
        for ($i=0; $i <$countM ; $i++) { 
            echo "<p> ".$msg[$i]['pseudo'] .":". $msg[$i]['CharText'] ." </p>\n";
        }
        break;
    }

       
    
}


