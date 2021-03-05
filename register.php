<?php

require_once ('config.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: index.php');
    exit;
}

$name = $email = $username = $password = '';
$name_err = $email_err = $username_err = $password_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty(trim($_POST['name'])) || !(preg_match("/^([a-zA-Z' ]+)$/",trim($_POST['name'])))) {
        $name_err = 'Please enter a valid name';
    }
    else {
        $name = trim($_POST['name']);
    }
    if (empty(trim($_POST['email'])) || !(preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/",trim($_POST['email'])))) {
        $email_err = 'Please enter a valid email';
    }
    else {
        $sql = "select id from users where email = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = trim($_POST['email']);

            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = 'This email is already used';
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo 'Something went wrong. PLease try again later';
            }
        }

        mysqli_stmt_close($stmt);
    }
    
    if (empty(trim($_POST['username'])) ||  !(preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', trim($_POST['username'])))) {
        $username_err = 'Please enter a valid username';
    }
    else {
        $sql = "select id from users where username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = trim($_POST['username']);

            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = 'This username is already taken';
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo 'Something went wrong. PLease try again later';
            }
        }
        mysqli_stmt_close($stmt);
    }
    if (empty(trim($_POST['password']))) {
        $password_err = 'Please enter a password';
    } else if (strlen(trim($_POST['password'])) < 7 ){
        $password_err = 'password must have at least 7 characters.';
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($name_err) && empty($email_err) && empty($username_err) && empty($password_err)) {
        
        $sql = "insert into users (name, email, username, password) values (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_username, $param_password);

            $param_name = $name;
            $param_email = $email;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                $sql = "update users set privileges = 1 where id = 1";
                mysqli_query($conn, $sql);

                $sql = "select id, username, privileges from users where username = '$username'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $row[0];
                $_SESSION['username'] = $row[1];
                $_SESSION['privileges'] = $row[2];
                
                header("location: index.php");
            } else {
                echo "Something went wrong. Please try again later.";
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
    <title>Register</title>
</head>
<body>
    <?php require_once 'headermain.php'; ?>
    <div class="container">
        <div class="row">
            <h2 class="col s12" style="color:#ee6e73;">Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <input class="validate" type="text" name="name" id="name"  value=<?php echo $name ?>>    
                    <label for="name" class="active">Name</label>
                    <span class="helper-text"> <?php echo $name_err; ?> </span>
                </div>
                
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input class="validate" type="email" name="email" id="email"  value=<?php echo $email ?>>
                    <label for="email" class="active">Email</label>
                    <span class="helper-text"> <?php echo $email_err; ?> </span>
                </div>
                
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <input class="validate" type="text" name="username" id="username"  value=<?php echo $username ?>>
                    <label for="username" class="active">User Name</label>
                    <span class="helper-text"> <?php echo $username_err; ?> </span>
                </div>
                
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <input class="validate" type="password" name="password" id="password" >
                    <label for="password" class="active">Password</label>
                    <span class="helper-text"> <?php echo $password_err; ?> </span>
                </div>
                
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <button class="btn waves-effect waves-light" type="submit" name="submit">Register
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
            <p>Already have an account ? <a href="login.php">Login here</a></p>
        </form>
        </div>
        
        
    </div>
    <?php require_once 'footermain.php'; ?>
</body>
</html>