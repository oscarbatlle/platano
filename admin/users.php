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
if (isset($_GET['deluser']))
{

    # if user id is 1 ignore
    if ($_GET['deluser'] != '1')
    {

        $stmt = $db->prepare('DELETE FROM blog_members WHERE memberID = :memberID');
        $stmt->execute(array(':memberID' => $_GET['deluser']));

        header('Location: users.php?action=deleted');
        exit;

    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin - Users</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script language="JavaScript" type="text/javascript">
        function deluser(id, title) {
            if (confirm("Are you sure you want to delete '" + title + "'")) {
                window.location.href = 'users.php?deluser=' + id;
            }
        }
    </script>
</head>
<body>

<div class="container">

    <?php include('menu.php'); ?>

    <?php
    # Show message from add / edit page
    if (isset($_GET['action']))
    {
        echo '<h3>User ' . $_GET['action'] . '.</h3>';
    }
    ?>

    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
        try
        {

            $stmt = $db->query('SELECT memberID, username, email FROM blog_members ORDER BY username');
            while ($row = $stmt->fetch())
            {

                echo '<tr>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                ?>

                <td>
                    <a href="edituser.php?id=<?php echo $row['memberID'];?>">Edit</a>
                    <?php if ($row['memberID'] != 1)
                    { ?>
                        | <a
                        href="javascript:deluser('<?php echo $row['memberID']; ?>','<?php echo $row['username']; ?>')">Delete</a>
                    <?php } ?>
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

    <p><a href='adduser.php'>Add User</a></p>

</div>

</body>
</html>