<?php 

session_start();
require_once'config.php';
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
    <title>Packages | Hotels</title>
</head>
<body>
<?php require_once 'headermain.php'; ?> 
    <div id = "contactus" class="col s12 m5 card-panel z-depth-2" style="width:100%">
        <p class="flow-text">
            <h1 class="center" style="color:#ee6e73;">Hotel Booking<h1>
        </p>
    </div>

    <div class="hotels">
    <table class="highlighted centered">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Hotel Name</th>
                <th>offer</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
        <?php
            $sql = 'select id, name, offer from hotels';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
        ?> 
            <table class="highlight centered">
                <?php
                    echo "<tr>";
                    echo " <td> <input type='text' name='id' value='$row[0]' readonly='readonly'> </td>";
                    echo "<td> <input type='text' name='name' value='$row[1]' readonly='readonly'> </td>";
                    echo "<td> <input type='text' name='offer' value='$row[2]' readonly='readonly'> </td>";
                    ?>
                    <td><a href="cart.php"><button class="btn waves-effect waves-light" type="submit" name="book">book hotel
                        <i class="material-icons right">send</i>
                    </button></a></td>
                    </tr>
                    <?php
                    ?>
            </table>
        <?php
            }
            $rowcount = mysqli_num_rows($result);
        ?>

    </div>

    <div id = "contactus" class="col s12 m5 card-panel z-depth-2" style="width:100%">
        <p class="flow-text">
            <h1 class="center" style="color:#ee6e73;">Holiday Packages<h1>
        </p>
    </div>

    <div class="packages">
    <table class="highlighted centered">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Package Name</th>
                <th>offer</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
        <?php
            $sql = 'select id, name, offer from packages';
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
        ?> 
            <table class="highlight centered">
                <?php
                    echo "<tr>";
                    echo " <td> <input type='text' name='id' value='$row[0]' readonly='readonly'> </td>";
                    echo "<td> <input type='text' name='name' value='$row[1]' readonly='readonly'> </td>";
                    echo "<td> <input type='text' name='offer' value='$row[2]' readonly='readonly'> </td>";
                    ?>
                    <td><a href="cart.php"><button class="btn waves-effect waves-light" type="submit" name="book">buy package
                        <i class="material-icons right">send</i>
                    </button></a></td>
                    </tr>
                    <?php
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