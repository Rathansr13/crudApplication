
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<?php
include('db.php');

// Initialize variables
 $name = $category = $supplier = $quantity = $price = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['updateId'])) {
    $id = $_GET['updateId'];
    $sql = "SELECT * FROM parts WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $category = $row['category'];
        $supplier = $row['supplier'];
        $quantity = $row['Quantity'];
        $price = $row['price'];
    } else {
        // Redirect if no record found with the given id
        header('Location: homePage.php');
        exit;
    }
}
 elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Ensure that all form fields are properly filled
    if (isset($_POST['id'], $_POST['name'], $_POST['category'], $_POST['supplier'], $_POST['quantity'], $_POST['price'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $category = $_POST['category'];
        $supplier = $_POST['supplier'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        // Update query
        $sql = "UPDATE parts SET name='$name', category='$category', supplier='$supplier', Quantity=$quantity, price=$price WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            // Redirect after successful update
            header('Location: homePage.php');
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "All form fields are required.";
    }
}

mysqli_close($conn);
?>


<body>
    <div class="container mt-5">
        <h2 class="mb-4">Update Record</h2>
        <form  method="POST" action='update_process.php'>
            <input type="hidden" name="id" value="<?php echo $id ?>"> 
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value='<?php echo $name ?>'>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" class="form-control" id="category" name="category" value='<?php echo $category ?>'>
            </div>
            <div class="form-group">
                <label for="supplier">Supplier:</label>
                <input type="text" class="form-control" id="supplier" name="supplier" value='<?php echo $supplier?>'>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value='<?php echo $quantity ?>'>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value='<?php echo $price ?>'>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, if you need to use Bootstrap JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
