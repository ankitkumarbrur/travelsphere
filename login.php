<?php

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: index.php');
    exit;
}
require_once 'config.php';
$username = $password = '';
$username_err = $password_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty(trim($_POST['username']))) {
        $username_err = 'Please enter username';
    } else {
        $username = trim($_POST['username']);
    }

    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter password';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {

        $sql = "select id, username, password , privileges from users where username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {

                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $privileg);

                    if (mysqli_stmt_fetch($stmt)) {

                        if (password_verify($password, $hashed_password)) {

                            session_start();

                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;
                            $_SESSION['privileges'] = $privileg;

                            header('location: index.php');
                        } else {
                            $password_err = 'The password you entered was not valid';
                        }
                    }
                } else {
                    $username_err = 'No account found with that username';
                }
            } else {
                echo "oops ! Something went wrong . Please try again later";
            }
        }

        mysqli_stmt_close($stmt);
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
        <h2 class="col s12" style="color:#ee6e73;">Login</h2>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="username" id="username" class="validate">
                    <label class="active" for="username">User Name</label>
                    <span class="helper-text"> <?php echo $username_err; ?> </span>
                </div>
                
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="password" name="password" id="password" class="validate">
                    <label class="active" for="password">Passsword</label>
                    <span class="helper-text"> <?php echo $password_err; ?> </span>
                </div>
                
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Login
                        <i class="material-icons right">send</i>
                    </button>
                </div>
                <p>Don't have an account? <a href="register.php">Sign up now</a></p>
            </div>
        </form>
    </div>
</div>
    
<?php require_once 'footermain.php'; ?>
</body>
</html>