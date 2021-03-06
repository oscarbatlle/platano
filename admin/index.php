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

# Show message from add / edit page

if (isset($_GET['delpost']))
{

    $stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID');
    $stmt->execute(array(':postID' => $_GET['delpost']));

    header('Location: index.php?action=deleted');
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin area</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script language="JavaScript" type="text/javascript">
        function delpost(id, title) {
            if (confirm("Are you sure you want to delete '" + title + "'")) {
                window.location.href = 'index.php?delpost=' + id;
            }
        }
    </script>
</head>
<body>

<div class="container">

    <header class="banner group">
        <h1>Pl&aacute;tano</h1>

        <h2>The Super-lightweight blog engine</h2>

        <?php include('menu.php'); ?>
    </header>

    <?php
    //show message from add / edit page
    if (isset($_GET['action']))
    {
        echo '<h3>Post ' . $_GET['action'] . '.</h3>';
    }
    ?>
    <section class="admin">
        <table>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php
            try
            {

                $stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
                while ($row = $stmt->fetch())
                {

                    echo '<tr>';
                    echo '<td>' . $row['postTitle'] . '</td>';
                    echo '<td>' . date('jS M Y', strtotime($row['postDate'])) . '</td>';
                    ?>

                    <td>
                        <a href="editpost.php?id=<?php echo $row['postID'];?>">Edit</a> |
                        <a href="javascript:delpost('<?php echo $row['postID'];?>','<?php echo $row['postTitle'];?>')">Delete</a>
                    </td>

                    <?php
                    echo '</tr>';

                }

            } catch (PDOException $e)
            {
                echo $e->getMessage();
            }
            ?>
        </table>
    </section>

    <p><a href='addpost.php'>Add Post</a></p>

</div>

</body>
</html>