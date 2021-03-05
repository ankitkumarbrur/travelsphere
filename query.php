<?php

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['privileges'] == 1) {
    header('location: index.php');
    exit;
}
require_once 'config.php';
$name = $email = $message = '';
$name_err = $email_err = $message_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['name']))) {
        $name_err = 'Please enter name';
    } else {
        $name = trim($_POST['name']);
    }

    if (empty(trim($_POST['email']))) {
        $email_err = 'Please enter email';
    } else {
        $email = trim($_POST['email']);
    }

    if (empty(trim($_POST['message']))) {
        $message_err = 'Please enter a message';
    } else {
        $message = trim($_POST['message']);
    }

    if (empty($name_err) && empty($email_err) && empty($message_err)) {        
        $sql = "insert into queries (name, email, message) values ('$name', '$email', '$message')";
        mysqli_query($conn, $sql);
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once 'headermain2.php'; ?>
    <link rel="icon" href="img/logo.png">
    <title>Login</title>
</head>
<body>
    <?php require_once 'headermain.php'; ?>
<div class="container">
    <div class="row">
    <div id = "contactus" class="col s12 m5 card-panel z-depth-2" style="width:100%"><p class="flow-text"><h1 class="center" style="color:#ee6e73;">Contact Us</h1></p></div>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="col s12">

        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="name" id="name" class="validate">
                <label class="active" for="name">Name</label>
                <span class="helper-text"> <?php echo $name_err; ?> </span>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="email" id="email" class="validate">
                <label class="active" for="email">email</label>
                <span class="helper-text"> <?php echo $email_err; ?> </span>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input type="text" name="message" id="message" class="validate">
                <label class="active" for="message">message</label>
                <span class="helper-text"> <?php echo $message_err; ?> </span>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action">Send Message
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
        </form>
    </div>
</div>
    
<?php require_once 'footermain.php'; ?>
</body>
</html>