<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    $email = trim($_POST["email"]);
    //$address = trim($_POST["address"]);
    $password = trim($_POST["password"]);
    $cpassword = trim($_POST["cpassword"]);

    if ($password == $cpassword) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    } else {
        echo "<script>alert('Passwords do not match.');
        window.history.back();
            </script>";
        exit();
    }

    //validate and sanitize user details
    



    //check if a user with the email already exists in the database
    $statement = $conn->prepare("SELECT * FROM customers WHERE email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('email already exists. Provide another email!');window.history.back();</script>";
    } else {
        $statement = $conn->prepare("INSERT INTO customers (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $statement->bind_param("ssss", $firstname,$lastname, $email, $hashed_password);
        if ($statement->execute() === TRUE) {
            echo "<script>
                    alert('Registration successful! Redirecting to login page.');
                    window.location.href = 'login.php';
                </script>";
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
$conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestige Electronics</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <section>
        <div class="container">
            <div class="box">
                <div class="box-content">
                    <h1 class="title">Prestige Electronics</h1>
                    <form class="form-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?> ">
                        <div>
                            <label for="firstname" class="form-label">firstname</label>
                            <div class="field">
                                <input type="text" name="firstname" id="firstname" class="form-input" placeholder="Enter your firstname"
                                autocomplete="off" >
                                <div class="error-txt">First name cannot be empty</div>
                            </div>
                        </div>
                        <div>
                            <label for="lastname" class="form-label">lastname</label>
                            <div class="field">
                            <input type="text" name="lastname" id="lastname" class="form-input" placeholder="Enter your lastname"
                            autocomplete="off" >
                            <div class="error-txt">Lastname cannot be empty</div>
                            </div>
                        </div>
                        <div>
                            <label for="email" class="form-label">email</label>
                            <div class="field">
                                <input type="email" name="email" id="email" class="form-input" placeholder="Enter your email"
                                autocomplete="off" >
                                <div class="error-txt emailError">Email cannot be empty</div>
                            </div>
                        </div>
                        <div>
                            <label for="password" class="form-label">Password</label>
                            <div class="field">
                                <input type="password" name="password" id="password" class="form-input" placeholder="Enter password"
                                autocomplete="off" >
                                <div class="error-txt">Password cannot be empty</div>
                            </div>
                        </div>
                        <div>
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <div class="field">
                                <input type="password" name="cpassword" id="cpassword" class="form-input" placeholder="Re-enter password"
                                autocomplete="off" >
                                <div class="error-txt">Please re enter password</div>
                            </div>
                        </div>
                        <button type="submit" id="button" class="form-button">Create Account</button>
                        <div class="form-footer">
                            <p class="footer-text">
                                Already have an account? <a href="./login.php" class="footer-link" rel="noopener noreferrer">Log in</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="js/formValidation.js"></script>
</body>
</html>
