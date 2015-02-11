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

<div id="wrapper">

    <h1>Pl&aacute;tano - The Super-lightweight blog engine</h1>
    <hr/>
    <p><a href="./">Blog Index</a></p>


    <?php
    echo '<div>';
    echo '<h1>' . $row['postTitle'] . '</h1>';
    echo '<p>' . date('jS F Y', strtotime($row['postDate'])) . '</p>';
    echo '<p>' . $row['postCont'] . '</p>';
    echo '</div>';
    ?>

</div>

</body>
</html>