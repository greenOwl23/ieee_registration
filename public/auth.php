<?php
require ('../src/config/db.php');
try{
    $db = new db();
    $db = $db->connect();
}catch(PDOException $e){
    echo '{"error":{"text":'.$e->getMessage().'}}';
}

?>