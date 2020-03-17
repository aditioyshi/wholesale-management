<?php
session_start();
require 'db_connection.php';
if ($_SESSION['login'] != "Active") {
    header("location:login_page.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="WholeSaler/styles.css" type="text/css" />
    <title>Whole Saler Login</title>
</head>

<body>
    <section id="body" class="width">
        <?php require 'sidebar.php' ?>
        <section id="content" class="column-right">
            <article>
                <fieldset>
                    <legend>
                        <strong>
                            <h3>New Catagory</h3>
                        </strong>
                    </legend>
                    <form action="add_category.php" method="POST">
                        <p><label for="CategoryID"><strong>CategoryID:</strong></label>
                            <input type="integer" name="CategoryID" id="CategoryID" placeholder="CategoryID"
                                required /><b /></p>
                        <p><label for="CategoryName">CategoryName:</label>
                            <input type="text" name="CategoryName" id="CategoryName" placeholder="CategoryName"
                                required /><br />
                        </p>

                        <p><input type="submit" name="AddC" class="formbutton" value="Add Category" /></p>
                    </form>
                    <?php
                    if(isset($_POST['AddC'])) {
                        $CategoryID    = $_POST['CategoryID'];
                        $CategoryName = $_POST['CategoryName'];

                        $sql  = "INSERT INTO category VALUES ('$CategoryID','$CategoryName')";


                            $result = mysqli_query($db_conn,$sql);

                    }?>
                </fieldset>

                <fieldset>
                    <legend>
                        <h3>Categories of products</h3>
                    </legend>
                    <table>
                        <tr>
                            <th>CategoryID</th>
                            <th>CategoryName</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($db_conn,$sql);
                        $row = mysqli_fetch_assoc($result);
                        do { ?>
                            <tr>
                                <td><?php echo $row['CategoryID']; ?></td>
                                <td><?php echo $row['CategoryName']; ?></td>
                            </tr>
                        <?php } while($row = mysqli_fetch_assoc($result)) ?>
                        <tr>
                    </table>
                </fieldset>

                <br><br><br><br><br><br><br><br><br>
            </article>
            <?php require 'footer.html'; ?>
        </section>

        <div class="clear"></div>
    </section>
</body>

</html>