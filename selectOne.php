<?php
require_once "inc/connection.php";
require_once "inc/function.php";
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $query="select * from users where user_id=$id";
        $runQuery=mysqli_query($conn,$query);
        if(mysqli_num_rows($runQuery)==1){
            $user=json_encode(mysqli_fetch_assoc($runQuery));
            print_r($user);
        }
        else{
            response_code(404,'Not found user.');
        }
    }  
    else{
        response_code(404,'Not found id for user.');
    }
}
else{
   response_code(503,'There is an error on request');
}
 ?>