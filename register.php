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

$first_name_error = "";
$last_name_error = "";
$email_error = "";
$phone_error = "";
$address_error = "";
$password_error = "";
$confirm_password_error = "";

$error = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if (empty($first_name)) {
        $first_name_error = "First name is required";
        $error = true;
    }

    if (empty($last_name)) {
        $last_name_error = "Last name is required";
        $error = true;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Email format is not valid";
        $error = true;
    }

    include("database.php");
    $dbconnection = getDatabaseConnection();


    $statement = $dbconnection->prepare("SELECT id FROM users WHERE email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();

    $statement->store_result();
    if ($statement->num_rows > 0) {
        $email_error = "Email already exists";
        $error = true;
    }

    $statement->close();

    if (!preg_match("/^(\+|00\d{1,3})?[-]?\d{7,10}$/", $phone)) {
        $phone_error = "Phone number is not valid";
        $error = true;
    }

    if (strlen($password) < 6) {
        $password_error = "Password must be at least 6 characters long";
        $error = true;
    }

    if ($confirm_password != $password) {
        $confirm_password_error = "Passwords do not match";
        $error = true;
    }

    if (!$error) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $statement = $dbconnection->prepare(
            "INSERT INTO users (first_name,last_name,email,phone,address,password,created_at)" . " VALUES (?,?,?,?,?,?,?)"
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
    <link rel="stylesheet" href="./css/register.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Document</title>

</head>

<body>
    <div class="container">
        <form id="form" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <h1>Sign Up</h1>
            <div class="input-control">
                <label for="first_name">First Name</label>
                <input id="first_na me" name="first_name" type="text" value="<?= $first_name ?>">
                <div class="error"><?= $first_name_error ?></div>
            </div>
            <div class="input-control">
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" type="text" value="<?= $last_name ?>">
                <div class="error"><?= $last_name_error ?></div>
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="<?= $email ?>">
                <div class="error"><?= $email_error ?></div>
            </div>
            <div class="input-control">
                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="tel" value="<?= $phone ?>">
                <div class="error"><?= $phone_error ?></div>
            </div>
            <div class="input-control">
                <label for="address">Address</label>
                <input id="address" name="address" value="<?= $address ?>">
                <div class="error"><?= $address_error ?></div>
            </div>
            <div class="input-control">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" value="">
                <div class="error"><?= $password_error ?></div>
            </div>
            <div class="input-control">
                <label for="confirm_password">Confirm Password</label>
                <input id="confirm_password" name="confirm_password" type="password" value="">
                <div class="error"><?= $confirm_password_error ?></div>
            </div>
            <button type="submit" name="sign">Sign Up</button>
            <p class="already-registered">Already registered? <a href="../bookSell/login.php">Log in here</a></p>
        </form>
    </div>
    <script src="./js/register.js"></script>
</body>

</html>