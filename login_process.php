<?php
// Process login
include("db.php"); // Include database connection
include("sessions.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username and password are provided
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Prepare statement to retrieve user data based on username
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // User found, verify password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                session_start();
                
// Set session timeout to 10 seconds
               $session_timeout = 10; // in seconds
               ini_set('session.gc_maxlifetime', $session_timeout);
               ini_set('session.cookie_lifetime', $session_timeout);

                $_SESSION["email"] = $email; // Assuming $username is the logged-in user's username
                header("Location: homePage.php");
                exit(); // Ensure that script execution stops after redirection
            } else {
                // Incorrect password
                echo "<p style='color: red; text-align: center;'>Invalid password!</p>";
            }
        } else {
            // User not found
            echo "<p style='color: red; text-align: center;'>User not found!</p>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>
