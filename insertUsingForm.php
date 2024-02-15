<?php
require_once "inc/connection.php";
require_once "inc/function.php";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $email=$_POST['email'];
    //validation
    $nameValidation=validateString($name);
    $emailValidation=validateEmail($email);
    $errors=[];
    $errorNotFound=1;
    if(is_array($nameValidation)){//return message if name is not valid
        $errors=array_merge($errors,$nameValidation);
        $errorNotFound=0;
    }
    if(is_array($emailValidation)){//return message if name is not valid
        $errors=array_merge($errors, $emailValidation);
        $errorNotFound=0;
    }
    if( $errorNotFound==1){//then there is not error found
        //insert
        $query="insert into users (`user_name`,`user_email`) values('$nameValidation','$emailValidation')";
        $runQuery=mysqli_query($conn,$query);
        if($runQuery){
            response_code(200,'insert successfully');
        }
        else{
            response_code(404,'There is an error on insert');
        }
    }
    else{
        response_code(404,$errors);
    }
}
else{
    response_code(503,'There is an error on request');
}