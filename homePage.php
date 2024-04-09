<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-rKd23hykT1An2R5kqvMC2r6FoJbQZcu1+Rlo6NLUKlz3ZxgAKIcS/qnOa7I3IYx07izpHSfj8oDs4n3XHFf0/g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Define the animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Apply the animation to an element */
        .animated {
            animation: fadeIn 1s ease-out;
        }

        /* Additional styles for the content */
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        /* Style for sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 200px;
            height: 100%;
            background-color: #f8f9fa;
            padding: 20px;
        }
        /* Style for profile section */
        .profile {
            margin-bottom: 20px;
        }
    </style>
</head>






<?php
// Include database connection
include("db.php");
include("sessions.php");

// Check if the user is logged in
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}

$email = $_SESSION["email"];
$stmt = $conn->prepare("SELECT name FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $username = $row['name'];
}

$stmt->close();
?>








<!--frontend Code-->
<body>
    <div class="sidebar mx-3">
        <!-- Profile Section -->
        <div class="profile">
            <h4>Profile</h4>
            <p>Welcome,<?php echo $username; ?></p> <!-- Replace "John Doe" with the user's name -->
            <a href="login.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <div class="container mt-0 ml-0 pd-20">
    <!-- Button with primary color -->
    <button type="button" class="btn btn-primary mx-4" style="width: 150px; margin-left: 10px;">
        <a href="parts_form.php" style="color: white; text-decoration: none;">
            Add <i class="fas fa-plus"></i>
        </a>
    </button>
</div>

    <div class="container mx-1.3">
        <table class="table   table-bordered">
            <thead>
                <tr>
                    <th scope="col">Sl No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
            <?php
  $sql="Select * from parts";
   $result = mysqli_query($conn,$sql);
   if($result)
   {
     while( $row = mysqli_fetch_assoc($result))
      {
        $id = $row["id"];
        $name = $row["name"];
        $supplier = $row["supplier"];
        $price = $row["price"];
        $quantity = $row["Quantity"];
        echo '
        <tr>
        <th scope="row">'.$id.'</th>
        <td>'.$name.'</td>
        <td>'.$supplier.'</td>
        <td>'.$price.'</td>
        <td>'.$quantity.'</td>
        <td><button class="btn btn-primary px-4" > <a href="update_process.php? updateId='.$id.'" style="color: white; text-decoration: none;">
         UPDATE</a></button>
        <button class="btn btn-primary px-4" > <a href="delete.php? deleteId='.$id.'"  style="color: white; text-decoration: none;">
        DELETE <?php echo $id; ?><i class="fas fa-plus"></i></a></button></td>
    </tr>';
      }
   }
   ?>
              
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional, if you need to use Bootstrap JavaScript components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
