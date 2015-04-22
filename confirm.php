<?php

    include("database.php");
    $RegCode = filter_input(INPUT_GET, 'RegCode');
    $setRegCode = $connection->prepare("UPDATE user SET reg_code=NULL WHERE reg_code=:reg_code");
    $setRegCode->bindParam(':reg_code', $RegCode);
    $execute = $setRegCode->execute();
    if($execute){
        echo "Your account is now active!";
    }   else{
        echo "Some error occured";
    }

?>