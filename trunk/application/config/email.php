<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
| http://ellislab.com/codeigniter/user-guide/libraries/email.html
|
*/
$config['protocol']='smtp';
$config['smtp_host']='smtp.mailgun.org'; //(SMTP server)
$config['smtp_port']='587'; //(SMTP port)
$config['smtp_timeout']='30';
$config['smtp_user']='postmaster@sandbox488e8c74406541b9910c556c38435a10.mailgun.org';
$config['smtp_pass']='12a37d04f461c65aafeaa74c1421400f';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
// $config['newline'] = "\r\n";


/* End of file email.php */
/* Location: ./application/config/email.php */ 