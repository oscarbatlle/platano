<?php
/**
 * @author Oscar Batlle <oscarbatlle@gmail.com>
 */
require('includes/config.php');

$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

# If post does not exists redirect user

if ($row['postID'] == '')
{
    header('Location: ./');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $row['postTitle']; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <header class="banner">
        <div class="inner-banner">
            <h1>Pl&aacute;tano</h1>

            <h2>The Super-lightweight blog engine</h2>
        </div>
    </header>
    <div class="wrapper">

        <p><a href="./">&#8592; Home</a></p>

        <?php
        echo '<article>';
        echo '<header>';
        echo '<h2>' . $row['postTitle'] . '</h2>';
        echo '<p class="blog-date">' . date('jS F Y', strtotime($row['postDate'])) . '</p>';
        echo '</header>';
        echo '<p>' . $row['postCont'] . '</p>';
        echo '</article>';
        ?>

    </div>
</div>
</body>
</html>