<?php 
session_start();
require 'connect/database.php';
require 'classes/general.php';
require 'classes/bcrypt.php';
require 'classes/users.php';
require 'classes/payment.php';
require 'classes/society.php';
require 'classes/member.php';
require 'classes/package.php';
require 'classes/invoices.php';
require 'classes/expenses.php';
// error_reporting(0);

$users 		= new Users($db);
$payment 	= new Payment($db);
$society 	= new Society($db);
$member		= new Member($db);
$package	= new Package($db);
$invoices	= new Invoices($db);
$expenses	= new Expenses($db);
$general 	= new General();
$bcrypt 	= new Bcrypt(12);

$errors = array();

if ($general->logged_in() === true)  {
	$user_id 	= $_SESSION['id'];
	$user 		= $users->userdata($user_id);
}

ob_start(); // Added to avoid a common error of 'header already sent'