<?php
//display startup errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    
    
        $statement = $conn->prepare("SELECT * FROM customers WHERE email = ?");
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $row['email'];
            header("Location: welcome.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password.');window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found, Create account');
        window.location.href = 'signup.php';</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestige Electronics shops</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <section>
        <div class="container">
            <div class="box">
                <div class="box-content">
                <h1 class="title">Prestige Electronics</h1>
                    <form class="form-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?> ">
                    <div class="field">
                            <label for="email" class="form-label">email</label>
                            <input type="email" name="email" id="email" class="form-input" placeholder="Enter your email"
                            autocomplete="off" >
                            <div class="error-txt">Email cannot be empty</div>
                        </div>
                        <div class="field">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-input" placeholder="Enter password"
                            autocomplete="off" >
                            <div class="error-txt">Password cannot be empty</div>
                        </div>
                        <button type="submit" class="form-button">LOG IN</button>
                        <div class="form-footer">
                            <p class="footer-text">
                                Don't have an account? <a href="./signup.php" class="footer-link" rel="noopener noreferrer">Register now</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
