<?php
// Include database connection
include("db.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $category = $_POST["category"];
    $supplier = $_POST["supplier"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO parts (name, category, supplier, quantity, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssid", $name, $category, $supplier, $quantity, $price);

    // Execute the statement
    if ($stmt->execute()) {
        // Data inserted successfully
        // Close statement and connection
        $stmt->close();
        $conn->close();
        // Show success modal
        header("Location: homePage.php");
    } else {
        // Error occurred
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>parts</title>
</head>
<body>
<div class="modal" tabindex="-1"  id="successModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Data inserted successfully!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (required for modal functionality) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
