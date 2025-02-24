<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping List</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
        }
        input[type=submit] {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    
    if (!isset($_SESSION['list'])) {
        $_SESSION['list'] = [];
    }
    
    $name = $quantity = $price = $index = "";
    $error = $message = "";
    $totalValue = 0;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['add']) && !empty($_POST['name']) && !empty($_POST['quantity']) && !empty($_POST['price'])) {
            $_SESSION['list'][] = [
                'name' => $_POST['name'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price']
            ];
            $message = "Item added successfully!";
        } elseif (isset($_POST['edit'])) {
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $index = $_POST['index'];
        } elseif (isset($_POST['update']) && $_POST['index'] !== "") {
            $_SESSION['list'][$_POST['index']] = [
                'name' => $_POST['name'],
                'quantity' => $_POST['quantity'],
                'price' => $_POST['price']
            ];
            $message = "Item updated successfully!";
        } elseif (isset($_POST['delete']) && $_POST['index'] !== "") {
            unset($_SESSION['list'][$_POST['index']]);
            $_SESSION['list'] = array_values($_SESSION['list']);
            $message = "Item deleted successfully!";
        } elseif (isset($_POST['reset'])) {
            $_SESSION['list'] = [];
            $message = "List reset successfully!";
        } elseif (isset($_POST['total'])) {
            foreach ($_SESSION['list'] as $item) {
                $totalValue += $item['quantity'] * $item['price'];
            }
        } else {
            $error = "Please fill in all fields!";
        }
    }
    ?>
    
    <h1>Shopping List</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?php echo htmlspecialchars($quantity); ?>">
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($price); ?>">
        <br>
        <input type="hidden" name="index" value="<?php echo htmlspecialchars($index); ?>">
        <input type="submit" name="add" value="Add">
        <input type="submit" name="update" value="Update">
        <input type="submit" name="reset" value="Reset">
    </form>
    <p style="color:red;"><?php echo $error; ?></p>
    <p style="color:green;"><?php echo $message; ?></p>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['list'] as $index => $item) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($item['price']); ?></td>
                    <td><?php echo $item['quantity'] * $item['price']; ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="name" value="<?php echo htmlspecialchars($item['name']); ?>">
                            <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                            <input type="hidden" name="price" value="<?php echo htmlspecialchars($item['price']); ?>">
                            <input type="hidden" name="index" value="<?php echo $index; ?>">
                            <input type="submit" name="edit" value="Edit">
                            <input type="submit" name="delete" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td><?php echo $totalValue; ?></td>
                <td>
                    <form method="post">
                        <input type="submit" name="total" value="Calculate Total">
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
