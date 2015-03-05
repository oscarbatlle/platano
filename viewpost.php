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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['postTitle']; ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
    <header class="banner">
        <h1>Pl&aacute;tano</h1>

        <h2>The Super-lightweight blog engine</h2>
    </header>

    <div class="content">
        <p><a href="./">&#8592; Home</a></p>

        <?php
        echo '<article class="single-post">';
        echo '<header>';
        echo '<h2>' . $row['postTitle'] . '</h2>';
        echo '<p class="blog-date">' . date('jS F Y', strtotime($row['postDate'])) . '</p>';
        echo '</header>';
        echo '<p>' . $row['postCont'] . '</p>';
        echo '</article>';
        ?>

    </div>
    <footer>
        <div class="inner-footer">
            <p>Pl&aacute;tano - The Super-lightweight blog engine by <a href="https://github.com/oscarbatlle/platano">Oscar
                    Batlle</a></p>
        </div>
    </footer>
</div>
</body>
</html>