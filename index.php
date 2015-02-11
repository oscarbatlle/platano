<?php
/**
 * @author Oscar Batlle <oscarbatlle@gmail.com>
 */
require('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pl&aacute;tano - The Super-lightweight blog engine</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="header">
    <div id="header-title">
    <h1>Pl&aacute;tano - The Super-lightweight blog engine</h1>
    </div>
</div>
<div id="wrapper">

    <?php
    try
    {

        $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
        while ($row = $stmt->fetch())
        {

            echo '<div class="post">';
            echo '<h2><a href="viewpost.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h2>';
            echo '<p class="blog-date">' . date('jS F Y', strtotime($row['postDate'])) . '</p>';
            echo '<p>' . $row['postDesc'] . '</p>';
            echo '<p><a href="viewpost.php?id=' . $row['postID'] . '">Read More...</a></p>';
            echo '</div>';

        }

    } catch (PDOException $e)
    {
        echo $e->getMessage();
    }
    ?>

</div>

</body>
</html>