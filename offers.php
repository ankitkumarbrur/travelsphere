<?php 

session_start();
require_once'config.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'headermain2.php' ?>
    <link rel="icon" href="img/logo.png">
    <title>Offers</title>
</head>
<body>
<?php require_once 'headermain.php'; ?>
    <div class="users">
    <table class="centered highlighted">
        <thead>
            <tr>
                <th>id</th>
                <th>Description</th>
                <th>Price</th>
                <th>Expiry Date</th>
            </tr>
        </thead>
    </table>
        <?php
            $sql = 'select id, description, price, expirydate from offers';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
        ?> 
            <table class="centered highlighted">
                <?php
                    echo "<tr>";
                    echo " <td> '$row[0]'</td>";
                    echo " <td> '$row[1]'</td>";
                    echo " <td> '$row[2]'</td>";
                    echo " <td> '$row[3]'</td>";
                    echo "</tr>"
                ?>
            </table>
        <?php
            }
            $rowcount = mysqli_num_rows($result);
        ?>

    </div>
    <?php require_once 'footermain.php'; ?>
</body>
</html>