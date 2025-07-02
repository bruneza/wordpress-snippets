// --- Universal HTTPS & Security Hardening for WordPress ---

// Detect HTTPS even when behind a proxy or Cloudflare
if (
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https'
) {
    $_SERVER['HTTPS'] = 'on';
}

// Force SSL in admin and login pages (always recommended)
define('FORCE_SSL_ADMIN', true);

// Hide PHP errors from visitors (security best practice)
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

// Prevent editing/installing/updating plugins & themes via dashboard
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);

// Deny unfiltered HTML for non-admins (XSS protection)
define('DISALLOW_UNFILTERED_HTML', true);

// Limit post revisions to keep database efficient (optional, adjust as needed)
define('WP_POST_REVISIONS', 5);

// Set secure file permissions for uploads (optional, adjust if needed)
define('FS_CHMOD_FILE', 0644);
define('FS_CHMOD_DIR', 0755);

// Explicitly disable database repair script (best practice)
define('WP_ALLOW_REPAIR', false);

//Disable default WP-Cron
define('DISABLE_WP_CRON', true);

// --- End universal HTTPS & security hardening ---

// Serving Wp-admin from another Domain
if ( isset( $_SERVER['SERVER_NAME'] ) && 'admin.mtn.co.rw' === $_SERVER['SERVER_NAME'] ) {
	define( 'WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] );
	define( 'WP_HOME', 'http://' . $_SERVER['SERVER_NAME'] );
 }
