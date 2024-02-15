<?php
require_once "inc/connection.php";
require_once "inc/function.php";
//check on method (GET)
if($_SERVER['REQUEST_METHOD']=="GET"){
    ///check if send id on url
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        //search user is found or not
        $query="select * from users where user_id=$id";
        $runQuery=mysqli_query($conn,$query);
        if(mysqli_num_rows($runQuery)==1){
            //make delete
            $query="delete from users where user_id=$id";
            $runQuary=mysqli_query($conn,$query);
            if($runQuary){
                response_code(200,'User deleted successfully.');
            }
            else{
                response_code(404,'There is an error.');
            }
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