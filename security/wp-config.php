//Turn on HTTPS
   $_SERVER["HTTPS"] = "on";
//End Turn on HTTPS

//Disable script file concatenation
define('CONCATENATE_SCRIPTS', false);

define('WP_ADMIN_DIR', 'secret-folder');
define( 'ADMIN_COOKIE_PATH', SITECOOKIEPATH . WP_ADMIN_DIR);
