<?php
session_start();
require 'db_connection.php';
if($_SESSION['login']!="Active")
{
    header("location:login_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="WholeSaler/styles.css" type="text/css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <title>Whole Saler Login</title>
</head>
<body>
    <section id="body" class="width">
        <?php require 'sidebar.php' ?>
        <section id="content" class="column-right">
            <article>
                <blockquote><p>Welcome to WholeSaler Admin Panel</p></blockquote>
                <p>&nbsp;</p>
                <fieldset>
                    <div class="row">
                        <div class="column">
                            <h3>Hi</h3>
                        </div>
                        <div class="column">
                            <h3>Hi2</h3>
                        </div>
                    </div>
                </fieldset>
            </article>
        </section>
        <?php require 'footer.html';?>
    </section>
</body>
</html>
