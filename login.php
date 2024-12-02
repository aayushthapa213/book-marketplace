<?php
include('components/header.php');

if (isset($_SESSION['email'])) {
    header("location: /booksell/index.php");
    exit;
}

$email =  "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    include("database.php");
    $dbconnection = getDatabaseConnection();

    $statement  = $dbconnection->prepare(
        "SELECT id, first_name, last_name, phone, password,address, created_at FROM users WHERE email = ?"
    );

    $statement->bind_param('s', $email);
    $statement->execute();
    $statement->bind_result($id, $first_name, $last_name, $phone, $stored_password, $address, $created_at);

    if ($statement->fetch()) {
        if (password_verify($password, $stored_password)) {
            $_SESSION["id"] = $id;
            $_SESSION["first_name"] = $first_name;
            $_SESSION["last_name"] = $last_name;
            $_SESSION["email"] = $email;
            $_SESSION["phone"] = $phone;
            $_SESSION["address"] = $address;
            $_SESSION["created_at"] = $created_at;

            header("location: /booksell/index.php");
            exit;
        }
    }
    $statement->close();
    $error = "Email or Password Invalid!";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/head.css">
</head>

<body>
    <?php if (!empty($error)): ?>
        <div class="error_message">
            <div class="error"><?= $error ?></div>
            <i id="cross" class="fa-solid fa-x"></i>
        </div>
    <?php endif; ?>
    <div class="container">
        <form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Login</h1>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?= $email ?>" onkeyup="emailValidate()">
                <div id="emailError" class="error"></div>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" onkeyup="passValidate()">
                <div id="passError" class="error"></div>
            </div>
            <button onclick="return validateForm()" type="submit">Log In</button>
            <p class="not-registered">Not registered yet? <a href="../bookSell/register.php">Create an account</a></p>
        </form>
    </div>

    <script src="./js/login.js"></script>
</body>

</html>