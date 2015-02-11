<?php
/**
 * @author Oscar Batlle <oscarbatlle@gmail.com>
 */
# Output Buffering

ob_start();

# Start Session

session_start();

# Database Credentials

DEFINE('DSN', 'mysql:host=localhost;dbname=Platano');
DEFINE('DBUSER', 'mangu');
DEFINE('DBPASS', 'mangu123');

# Initiate connection

$db = new PDO(DSN, DBUSER, DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

# Set Timezone

date_default_timezone_set('America/New_York');