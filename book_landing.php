<?php
include('./components/header.php');
include('dashbase.php'); // Contains your $conn database connection

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Fetch the book details from the database
    $query = "SELECT * FROM books WHERE book_id = '$book_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $book = mysqli_fetch_assoc($result);
    } else {
        echo "<p>Book details not found.</p>";
        exit();
    }
}

if (isset($_POST['add_to_cart'])) {
    if ($authenticated) {
        $user_id = $_SESSION['id'];
        $book_id = $_POST['product_id'];
        $book_price = $_POST['product_price'];
        $book_name = $_POST['product_name'];
        $book_image = $_POST['product_image'];
        $book_quantity = 1;

        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$book_name' AND user_id = '$user_id'");

        if (mysqli_num_rows($select_cart) > 0) {
            $message[] = "Book Already Exists!";
        } else {
            $insert_book = mysqli_query($conn, "INSERT INTO `cart` (user_id, book_id, name, price, image, quantity) VALUES ('$user_id', '$book_id', '$book_name', '$book_price', '$book_image', '$book_quantity')");
            $message[] = "Book Added Successfully!";
        }
    } else {
        echo "<script>alert('Please log in to access the cart.'); window.location.href = 'login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="./css/book_landing.css">
    <link rel="stylesheet" href="./css/head.css">
</head>

<body>
<div class="book-container">
    <section class="book-details">
        <div class="book-image">
            <img src="images/books/<?= $book['image_path']; ?>" alt="<?= htmlspecialchars($book['book_name']); ?>">
        </div>
        <div class="book-info">
            <h1><?= htmlspecialchars($book['book_name']); ?></h1>
            <h3>Author: <?= htmlspecialchars($book['author_name']); ?></h3>
            <p>Category: <?= htmlspecialchars($book['category']); ?></p>
            <p class="price">Price: $<?= htmlspecialchars($book['price']); ?></p>
            <p class="description"><?= htmlspecialchars($book['description']); ?></p>

            <!-- Add form to handle adding to cart -->
            <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?= $book['book_id']; ?>">
                <input type="hidden" name="product_price" value="<?= $book['price']; ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($book['book_name']); ?>">
                <input type="hidden" name="product_image" value="<?= $book['image_path']; ?>">
                <button type="submit" class="add-to-cart" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
    </section>

    
</div>
</body>

</html>
