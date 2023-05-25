<?php
/**
 * Mail configuration file
 */

$cfg['supportEmail'] = 'support@planetspin.casino';
$cfg['smtpMailName'] = 'no-reply@planetspin.casino';

// SMTP config
//$cfg['smtpMailName'] = 'no-reply@project.com';
//$cfg['smtpMailPort'] = '587';
//$cfg['smtpMailHost'] = 'smtp.gmail.com';
//$cfg['smtpMailPass'] = 'project-account-password';
//$cfg['smtpMailFrom'] = 'project';
//$cfg['smtpSecurity'] = 'tls';


// Simple config
$cfg['smtpMailHost'] = 'localhost';
$cfg['smtpMailPort'] = '25';
$cfg['smtpMailPass'] = 'NO_PASSWORD_REQUIRED';
unset($cfg['smtpSecurity']);
