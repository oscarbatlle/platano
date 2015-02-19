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
    <link rel="stylesheet" href="css/pagination.css">
</head>
<body>

<div id="header">
    <div id="header-title">
        <h1>Pl&aacute;tano</h1>

        <h2>The Super-lightweight blog engine</h2>
    </div>
</div>

<div id="wrapper">

    <div id="content-wrapper">
        <div id="main">
            <?php

            # Create new object pass in number of pages and identifier
            $pages = new Paginator('3', 'p');

            # Get number of total records
            $rows = $db->query('SELECT postID FROM blog_posts');
            $total = $rows->rowCount();

            # Assign total number of records
            $pages->set_total($total);

            try
            {

                $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC ' . $pages->get_limit());
                while ($row = $stmt->fetch())
                {

                    echo '<div class="post">';
                    echo '<div class="post-title"><h2><a href="viewpost.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h2></div>';
                    echo '<p class="blog-date">' . date('jS F Y', strtotime($row['postDate'])) . '</p>';
                    echo '<p>' . $row['postDesc'] . '</p>';
                    echo '<p><a href="viewpost.php?id=' . $row['postID'] . '">Read More...</a></p>';
                    echo '</div>';

                }

            } catch (PDOException $e)
            {
                echo $e->getMessage();
            }

            # Output Pagination
            echo $pages->page_links();

            ?>
        </div>

        <div id="sidebar">
            <div id="sidebar-header">Sidebar Header</div>
            <div id="sidebard-content">

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>

        </div>

    </div>
</div>

<div class="etc"></div>

<div id="footer">
    <div id="footer-content">Pl&aacute;tano - The Super-lightweight blog engine</div>
</div>


</body>
</html>