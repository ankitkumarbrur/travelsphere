<?php 

session_start();
require_once'config.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}
if ($_SESSION['privileges'] == 0) {
    header('location:index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="message.css">
    <?php require_once 'headermain2.php' ?>
    <link rel="icon" href="img/logo.png">
    <title>Messages</title>
</head>
<body>
<?php require_once 'headermain.php'; ?>
    <div class="users">
    <table class="centered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Messages</th>
            </tr>
        </thead>
    </table>
        <?php
            $sql = 'select name, email, message from queries';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
        ?> 
            <table>
                <?php
                    echo "<tr>";
                    echo " <td> '$row[0]'</td>";
                    echo " <td> '$row[1]'</td>";
                    echo " <td> '$row[2]'</td>";
                    echo "</tr>"
                ?>
            </table>
        <?php
            }
            $rowcount = mysqli_num_rows($result);
        ?>
        <div id = "contactus" class="col s12 m5 card-panel z-depth-2" style="width:100%"><p class="flow-text"><h1 class="center" style="color:#ee6e73;">Total messages are <?php echo $rowcount ?><h1></p></div>

    </div>
    <?php require_once 'footermain.php'; ?>
</body>
</html>