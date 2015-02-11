<?php
/**
 * @author Oscar Batlle <oscarbatlle@gmail.com>
 */

require_once('../includes/config.php');

# log user out
$user->logout();
header('Location: index.php'); 