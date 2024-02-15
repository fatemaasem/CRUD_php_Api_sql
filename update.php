<?php
require_once "inc/connection.php";
require_once "inc/function.php";
//check on method (GET)
if($_SERVER['REQUEST_METHOD']=="POST"){
    ///check if send id on url
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        //search user is found or not
        $query="select * from users where user_id=$id";
        $runQuery=mysqli_query($conn,$query);
        if(mysqli_num_rows($runQuery)==1){
            //catch data
            $name=$_POST['name'];
            $email=$_POST['email'];
            //validation
            $nameValidation=validateString($name);
            $emailValidation=validateEmail($email);
            $errors=[];
            if(is_array($nameValidation)){//return message if name is not valid
                $errors=array_merge($errors,$nameValidation);
            }
            if(is_array($emailValidation)){//return message if name is not valid
                $errors=array_merge($errors, $emailValidation);
            }
            if(empty($errors)){
                $query="delete from users where user_id=$id";
                $runQuary=mysqli_query($conn,$query);
                if($runQuary){
                    response_code(200,'User deleted successfully.');
                }
                else{
                    $errors=array_merge($errors,['There is an error.']);
                }
            }
            if(!empty($errors)){
                response_code(404,$errors);
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