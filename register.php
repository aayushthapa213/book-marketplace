<?php

include("components/header.php");

if (isset($_SESSION['email'])) {
    header("location: /index.php");
    exit;
}

$first_name = "";
$last_name = "";
$email = "";
$phone = "";
$address = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    include("database.php");
    $dbconnection = getDatabaseConnection();

    $password = password_hash($password, PASSWORD_DEFAULT);
    $created_at = date('Y-m-d H:i:s');

    $statement = $dbconnection->prepare(
        "INSERT INTO users (first_name, last_name, email, phone, address, password, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $statement->bind_param('sssssss', $first_name, $last_name, $email, $phone, $address, $password, $created_at);

    $statement->execute();

    $insert_id = $statement->insert_id;
    $statement->close();

    $_SESSION["id"] = $insert_id;
    $_SESSION["first_name"] = $first_name;
    $_SESSION["last_name"] = $last_name;
    $_SESSION["email"] = $email;
    $_SESSION["phone"] = $phone;
    $_SESSION["address"] = $address;
    $_SESSION["created_at"] = $created_at;

    header("location: /booksell/index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9c08634970.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/head.css">
    <title>Document</title>

</head>

<body>
    <div class="container">
        <form id="form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <h1>Sign Up</h1>
            <div class="input-control">
                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" type="text" value="<?= $first_name ?>" onkeyup="validFirstName()">
                <div id="first_error" class="error"></div>
            </div>
            <div class="input-control">
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" type="text" value="<?= $last_name ?>" onkeyup="validLastName()">
                <div id="last_error" class="error"></div>
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?= $email ?>" onkeyup="validemail()">
                <div id="email_error" class="error"></div>
            </div>
            <div class="input-control">
                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="tel" value="<?= $phone ?>" onkeyup="validPhone()">
                <div id="phone_error" class="error"></div>
            </div>
            <div class="input-control">
                <label for="address">Address</label>
                <input id="address" name="address" value="<?= $address ?>">
                <div id="address_error" class="error"></div>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" value="" onkeyup="validPassword()">
                <div id="pass_error" class="error"></div>
            </div>
            <div class="input-control">
                <label for="confirm_password">Confirm Password</label>
                <input id="confirm_password" name="confirm_password" type="password" value="" onkeyup="validConfirmPassword()">
                <div id="conpass_error" class="error"></div>
            </div>
            <button type="submit" name="sign" onclick="return validateForm()">Sign Up</button>
            <p class="already-registered">Already registered? <a href="../bookSell/login.php">Log in here</a></p>
        </form>
    </div>
    <script src="./js/register.js"></script>
</body>

</html>