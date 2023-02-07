//Turn on HTTPS
   $_SERVER["HTTPS"] = "on";
define('FORCE_SSL_ADMIN', true);
//End Turn on HTTPS

//Disable script file concatenation
define('CONCATENATE_SCRIPTS', false);

// Disable File edit from wordpress dashboard
define('DISALLOW_FILE_EDIT', true);
