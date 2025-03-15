<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
session_start();
include("connect.php");
include("db_function.php");
include("../function/function_custom.php");
include("classHelper.php");
date_default_timezone_set("Asia/Bangkok");

