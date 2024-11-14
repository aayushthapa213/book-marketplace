<?php
include('dashbase.php');
include('./components/header.php');

$user_id = $_SESSION['id'];

if(isset($_POST['update_update'])){
  $update_value = $_POST['update_quantity'];
  $update_id = $_POST['update_quantity_id'];
  $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE cart_id = '$update_id' AND user_id = '$user_id'");
  if($update_query){
    header('location: cart.php');
  }
}

if(isset($_GET['remove'])){
  $remove_id = $_GET['remove'];
  mysqli_query($conn, "DELETE FROM `cart` WHERE cart_id = $remove_id AND user_id = '$user_id'");
  header('location: cart.php');
}

if(isset($_GET['delete_all'])){
  mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'");
  header('location: cart.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/head.css" />
  <link rel="stylesheet" href="./css/cart.css" />
  <title>Document</title>
</head>

<body>
  <div class="container">
    <section class="shopping_cart">
      <h1>Shopping cart</h1>
      <table>
        <thead>
          <th>image</th>
          <th>name</th>
          <th>price</th>
          <th>quantity</th>
          <th>total price</th>
          <th>action</th>
        </thead>
        <tbody>
          <?php
          $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
          $grand_total = 0;
          if (mysqli_num_rows($select_cart) > 0) {
            while ($row = mysqli_fetch_assoc($select_cart)) {
          ?>
              <tr>
                <td>
                  <img src="images/books/<?= $row['image']; ?>" height="100" alt="">
                </td>
                <td>
                  <?= $row['name']; ?>  
                </td>
                <td>
                  $<?= number_format($row['price']) ?>-/
                </td>
                <td>
                  <form action="" method="post">
                  <input type="hidden" name="update_quantity_id" value="<?= $row['cart_id'] ?>">
                    <input type="number" name="update_quantity" min="1" value="<?= $row['quantity'] ?>">
                    <input type="submit" value="update" name="update_update">
                  </form>
                </td>
                <td>
                  <?= $sub_total = number_format($row['price'] * $row['quantity']) ?>
                </td>
                <td>
                  <a href="cart.php?remove=<?= $row['cart_id']; ?>" onclick="return confirm('remove item from cart?')" class="delete">remove</a>
                </td>
              </tr>

          <?php
          $grand_total += $sub_total;
        };
          };
          ?>
          <tr class="table-bottom">
            <td>
              <a href="shop.php" class="option-btn">Continue Shopping</a>
            </td>
            <td>Grand Total</td>
            <td>$<?= $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?')" class="delete-btn">delete all</a></td>
          </tr>
        </tbody>
      </table>
    </section>
  </div>

</body>

</html>