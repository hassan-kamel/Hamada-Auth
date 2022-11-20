<?php
session_start();

include '../core/functions.php';
include '../core/validations.php';


if (checkRequestMethod($_SERVER['REQUEST_METHOD']) && checkPostInput('name')) {
    $errors = [];
    $data = [];
    $image = $_FILES['file'];
    
    foreach ($_POST as $key => $value) {
        $$key = senitizeInput($value);
    };

    // name
    if (requiredInput($name)) $errors['name'] = "Name is required";
    elseif (minInput($name, 3)) $errors['name'] = "Name is must be greater than 3 characters";
    elseif (maxInput($name, 20)) $errors['name'] = "Name is must be smaller than 20 characters";
    else $data['name'] = $name;
    // email 
    if (requiredInput($email)) $errors['email'] = "Email is required";
    elseif (emailValidate($email)) $errors['email'] = "Enter a valid email";
    elseif (emailExistValidate($email)) $errors['email'] = "Email is used before try another one";
    else $data['email'] = $email;
    //password
    if (requiredInput($password)) $errors['password'] = "Password is required";
    elseif (minInput($password, 5)) $errors['password'] = "Password is must be greater than 5 characters";
    else $data['password'] = $password;
    //image 
    if($image['error']){
        $errors['file'] = "Please choose a picture";
    } 
    else{

        
        
        $_SESSION['image'] = $image;

        $f_tmp_name = $image['tmp_name'];
        
	    $ext = pathinfo($image['name']);

		$original_name = $ext['filename'];
		$original_ext = $ext['extension'];

	    $allowed = array("png","jpg","jpeg","gif");
		if(in_array($original_ext, $allowed)){
            $new_name = uniqid('',true).".".$original_ext;
			$destnotion = "../uploads/".$new_name;
			move_uploaded_file($f_tmp_name, $destnotion);
			
            $data['file'] = $new_name;

        }
        else{
            $errors['file'] = "Your File Not Allowed";
        }

        
        

    }


    $_SESSION['data'] = $data;

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect("../register.php");
        // header("location:../register.php");
    }
    else{
        $users = json_decode(file_get_contents('../data/users.json'));
        $new_user = $_SESSION['data'];
        if($users) file_put_contents('../data/users.json',json_encode([...$users,$new_user]));
        else file_put_contents('../data/users.json',json_encode([$new_user]));

        $_SESSION['auth'] =  [$_SESSION['data']['name'],$_SESSION['data']['email'],$_SESSION['data']['file']];
        redirect("../index.php");
    }
} else {
    echo "error";
}