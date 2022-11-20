<?php
session_start();

include '../core/functions.php';
include '../core/validations.php';


if (checkRequestMethod($_SERVER['REQUEST_METHOD'])) {
    $errors = [];
    $data = [];
    
    foreach ($_POST as $key => $value) {
        $$key = senitizeInput($value);
    };


    // email 
    if (requiredInput($email)) $errors['email'] = "Email is required";
    elseif (emailValidate($email)) $errors['email'] = "Enter a valid email";
    elseif (!emailExistValidate($email)) $errors['email'] = "Invalid Email";
    else $data['email'] = $email;
    //password
    if (requiredInput($password)) $errors['password'] = "Password is required";
    elseif (minInput($password, 5)) $errors['password'] = "Password is must be greater than 5 characters";
    else $data['password'] = $password;


    $_SESSION['loginData'] = $data;

    if (!empty($errors)) {
        $_SESSION['loginErrors'] = $errors;
        redirect("../login.php");
    }
    else{
        $users = json_decode(file_get_contents('../data/users.json'));
        $my_user = $_SESSION['loginData'];
        foreach($users as $user){
            if($my_user['email'] == $user->email){
                if($my_user['password']==$user->password) {
                    $_SESSION['auth'] =  [$user->name , $user->email , $user->file];
                    redirect("../index.php");
                }
                else{
                    $errors['password'] = "Password Incorrect";
                    $_SESSION['loginErrors'] = $errors;
                    redirect("../login.php");
                }
            }
        }

        
    }

}else {
    echo "error";
}