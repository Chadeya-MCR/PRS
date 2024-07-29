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
<script>
const form = document.querySelector('form');
const password = document.getElementById("password");
function checkInputs(){
    const userInputs = document.querySelectorAll(".form-input")
        for(const input of userInputs){
            if(input.value === ""){
                input.classList.add("error");
                input.parentElement.classList.add("error");
            }
            if(userInputs [0].value !=""){checkEmailFormat();}
            userInputs[0].addEventListener("keyup", () => checkEmailFormat())

            input.addEventListener("keyup", () => {
                if(input.value !==""){
                    input.classList.remove("error");
                    input.parentElement.classList.remove("error");
                    input.classList.add("correct")
                    input.parentElement.classList.add("correct")
                }
                else{
                    input.classList.add("error");
                    input.parentElement.classList.add("error");
                    

                }
            });
        }
}
const  checkEmailFormat =()=>{
    const emailRegex = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
    const emailErrTxt = document.querySelector(".emailError");
    if(!email.value.match(emailRegex)){
        email.classList.add("error")
        email.parentElement.classList.add("error");
            if(email.value !=""){
                emailErrTxt.innerText = "Looks like something is bad"
            }else{
                emailErrTxt.innerText = "Email address can't be blank!"
            }
    }else{
        email.classList.remove("error")
        email.parentElement.classList.remove("error");
    }
}
form.addEventListener("submit", (e)=>{
    e.preventDefault();
    checkInputs()
})
</script>
</body>
</html>
