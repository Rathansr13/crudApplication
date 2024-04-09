
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
$name='';
$category=' ';
$supplier=' ';
$quantity=' ';
$price=' ';

if($_SERVER['REQUEST_METHOD']=='GET')
{
    if(!isset($_GET['id']))
    {
     header('Location: homePage.php');
     exit;
    }

    $id=$_GET['id'];
    $sql="select * from parts where id=$id";
    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    if(!$row)
    {
        header('Location: homePage.php');
        exit;
    }
        $name = $row["name"];
        $supplier = $row["supplier"];
        $price = $row["price"];
        $quantity = $row["Quantity"];
        $category=$row['category'];

}

else{

    $id = $_GET['id'];

    $sql = "UPDATE parts SET name='$name', category='$category', price=$price, Quantity=$quantity, supplier='$supplier' WHERE id=$id";
    $result =mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
        echo 'invalid query';
    }
    else{
        header(('Location: homePage.php'));
    }

}


?>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Update Record</h2>
        <form  method="POST" action="update.php">
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
