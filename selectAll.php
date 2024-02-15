<?php
require_once "inc/connection.php";
require_once "inc/function.php";

if($_SERVER['REQUEST_METHOD']=='GET'){
    $query="select * from users";
    $runQuery=mysqli_query($conn,$query);
    if(mysqli_num_rows($runQuery)>0){
        $users=json_encode(mysqli_fetch_all($runQuery,MYSQLI_ASSOC));
        print_r($users);
    
    }
    else{
        response_code(404,'Not found user.');
    }
}
else{
   response_code(503,'There is an error on request');
}
 ?>