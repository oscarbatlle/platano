<?php
/**
 * @author Oscar Batlle <oscarbatlle@gmail.com>
 */

require_once('../includes/config.php');

# Check if already logged in
if ($user->is_logged_in())
{
    header('Location: index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div id="login">

    <?php

    # Process login form if submitted

    if (isset($_POST['submit']))
    {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if ($user->login($username, $password))
        {

            # Logged in return to index page
            header('Location: index.php');
            exit;

        } else
        {
            $message = '<p class="error">Wrong username or password</p>';
        }

    } // end if submit

    if (isset($message))
    {
        echo $message;
    }
    ?>

    <form action="" method="post">
        <p><label>Username</label><input type="text" name="username" value=""/></p>

        <p><label>Password</label><input type="password" name="password" value=""/></p>

        <p><label></label><input type="submit" name="submit" value="Login"/></p>
    </form>

</div>
</body>
</html>