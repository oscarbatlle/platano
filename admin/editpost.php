<?php
/**
 * @author Oscar Batlle <oscarbatlle@gmail.com>
 */

require_once('../includes/config.php');

# if not logged in redirect to login page
if (!$user->is_logged_in())
{
    header('Location: login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Edit Post</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../ckeditor/ckeditor.js"></script>

</head>
<body>

<div class="container">

    <header class="banner group">
        <h1>Pl&aacute;tano</h1>

        <h2>The Super-lightweight blog engine</h2>

        <?php include('menu.php'); ?>
    </header>

    <p><a href="./">Blog Admin Index</a></p>

    <h2>Edit Post</h2>

    <?php

    # if form has been submitted process it
    if (isset($_POST['submit']))
    {

        $_POST = array_map('stripslashes', $_POST);

        # Collect form data
        extract($_POST);

        # Basic validation
        if ($postID == '')
        {
            $error[] = 'This post is missing a valid id!.';
        }

        if ($postTitle == '')
        {
            $error[] = 'Please enter the title.';
        }

        if ($postDesc == '')
        {
            $error[] = 'Please enter the description.';
        }

        if ($postCont == '')
        {
            $error[] = 'Please enter the content.';
        }

        if (!isset($error))
        {

            try
            {

                # Insert into database
                $stmt = $db->prepare('UPDATE blog_posts SET postTitle = :postTitle, postDesc = :postDesc, postCont = :postCont WHERE postID = :postID');
                $stmt->execute(array(
                    ':postTitle' => $postTitle,
                    ':postDesc'  => $postDesc,
                    ':postCont'  => $postCont,
                    ':postID'    => $postID
                ));

                # Redirect to index page
                header('Location: index.php?action=updated');
                exit;

            } catch (PDOException $e)
            {
                echo $e->getMessage();
            }

        }

    }

    ?>


    <?php
    # Check for any errors

    if (isset($error))
    {
        foreach ($error as $error)
        {
            echo $error . '<br />';
        }
    }

    try
    {
        $stmt = $db->prepare('SELECT postID, postTitle, postDesc, postCont FROM blog_posts WHERE postID = :postID');
        $stmt->execute(array(':postID' => $_GET['id']));
        $row = $stmt->fetch();

    } catch (PDOException $e)
    {
        echo $e->getMessage();
    }
    ?>

    <form action='' method='post'>
        <input type='hidden' name='postID' value='<?php echo $row['postID']; ?>'>

        <p><label>Title</label><br/>
            <input type='text' name='postTitle' value='<?php echo $row['postTitle']; ?>'></p>

        <p><label>Description</label><br/>
            <textarea name='postDesc' cols='60' rows='10'><?php echo $row['postDesc']; ?></textarea></p>
        <script>
            CKEDITOR.replace('postDesc');
        </script>

        <p><label>Content</label><br/>
            <textarea name='postCont' cols='60' rows='10'><?php echo $row['postCont']; ?></textarea></p>
        <script>
            CKEDITOR.replace('postCont');
        </script>
        <p><input type='submit' name='submit' value='Update'></p>

    </form>

</div>

</body>
</html>