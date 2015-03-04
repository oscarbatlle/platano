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
<div class="container">
    <header class="banner">
        <h1>Pl&aacute;tano</h1>

        <h2>The Super-lightweight blog engine</h2>
    </header>

    <div class="content group">
        <main>
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

                    echo '<article>';
                    echo '<header>';
                    echo '<h2><a href="viewpost.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h2>';
                    echo '<p class="blog-date">' . date('jS F Y', strtotime($row['postDate'])) . '</p>';
                    echo '</header>';
                    echo '<p>' . $row['postDesc'] . '</p>';
                    echo '<p><a href="viewpost.php?id=' . $row['postID'] . '">Read More...</a></p>';
                    echo '</article>';

                }

            } catch (PDOException $e)
            {
                echo $e->getMessage();
            }

            # Output Pagination
            echo $pages->page_links();

            ?>
        </main>

        <aside class="sidebar">
            <h2>WHO AM I ?</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </aside>

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