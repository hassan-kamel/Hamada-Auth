<?php 

include './core/functions.php';

session_start();

session_destroy();

redirect('index.php');