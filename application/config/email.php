<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'prgdwes@gmail.com';
$config['smtp_pass'] = 'proofness88';
$config['smtp_timeout'] = '7';
$config['charset']    = 'utf-8';
$config['newline']    = "\r\n";
$config['mailtype'] = 'text'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not

/*$config=array(
    'protocol'=> 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port'=> 587,
    'smtp_user' => 'prgdwes@gmail.com',
    'smtp_pass' => 'proofness88',
    'smtp_timeout' => 5,
    'vaidation' => TRUE
);*/