add this codes to cpanel cron:
*/5 * * * * wget -q -O - http://127.0.0.1/wp-cron.php?doing_wp_cron > /dev/null 2>&1
