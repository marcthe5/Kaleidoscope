<?php
require_once 'components/connector.php'; // Include database connection

session_start();

// Check if the form was submitted successfully in a previous request
if (isset($_SESSION['form_submitted']) && $_SESSION['form_submitted'] === true) {
    // Clear the indicator to avoid re-submitting on page reload
    unset($_SESSION['form_submitted']);
    echo "Form submitted successfully!";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the values exist in the $_POST array
    if (isset($_POST['firstname'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['age'])) {
        // Sanitize the input values
        $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $age = filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);

        if ($age < 21) {
            echo "You must be 21 years old or older to sign up.";
        } else {
            $insert_user = $db->prepare("INSERT INTO `user` (firstname, email, username, password, age) VALUES (?, ?, ?, ?, ?)");
            $insert_user->execute([$firstname, $email, $username, $password, $age]);

            // Set the form submitted indicator in the session
            $_SESSION['form_submitted'] = true;

            // Redirect to the same page to avoid form re-submission on page reload
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    } else {
        echo "Missing required form data.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" href="NEWLOGO.png" type="image/png">
    <title>Kaleidoscope | Signup</title>
</head>
<body style="background-color: #212529;" id="content-body">
<div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
            <div class="card text-black" style="border-radius: 25px;">
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                            <p class="text-center h1 fw-bold mb-3 mx-1 mx-md-4 mt-5">Sign up</p>
                            <form action="" method="post" class="mx-1 mx-md-4 mt-5" id="signup-form">
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" name="firstname" id="firstname" required placeholder="First Name" class="form-control" maxlength="50">
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="email" name="email" id="email" required placeholder="Email Address" class="form-control" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="text" name="username" id="username" required placeholder="Username" class="form-control" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="password" name="password" id="password" required placeholder="Password" onkeyup="passValidity()" class="form-control" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="password" name="confirmpassword" id="confirmpassword" required placeholder="Confirm your Password" onkeyup="passValidity()" class="form-control" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
                                        <span id="pass-msg" style="font-size: 15px;"></span>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-calendar fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <input type="number" name="age" id="age" required placeholder="Age" class="form-control" min="0" max="150">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <p>Have an account? Go to <a href="login.php">Login Center</a></p>
                                </div>
                                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                    <button type="button" class="btn btn-primary btn-lg" id="signup-button" onclick="validateForm()">Signup</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                            <img src="NEWLOGO.png" class="img-fluid" alt="Sample image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="ageValidation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Age Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="modalClose();"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <center>
                        <label for="" class="form-label text-center lead">Are you 21 years old or older?</label>
                        <br>
                        <input type="button" class="btn btn-danger mx-2" id="noButton" onclick="modalClose();" value="NO">
                        <input type="submit" class="btn btn-success mx-2" id="yesButton" value="YES">
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalSignupSuccess" class="modal text-center" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-content text-center" style="width: 25%; height: 20%;">
        <div class="modal-body text-dark text-center">
            <h3 style="color: #212529;">SIGNUP SUCCESS!
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
            </h3>
        </div>
    </div>
</div>

<script type="text/javascript">
function validateForm() {
    var age = document.getElementById("age").value;
    if (age < 21) {
        alert("You must be 21 years old or older to sign up.");
        return false;
    }
    document.getElementById("signup-form").submit();
    modalOpen();
}

document.getElementById("yesButton").addEventListener("click", function () {
    document.getElementById("signup-form").submit();
});

function passValidity() {
    if (document.getElementById("confirmpassword").value === document.getElementById("password").value && document.getElementById("password").value.length != 0 && document.getElementById("confirmpassword").value.length != 0) {
        document.getElementById('pass-msg').innerHTML = "matching";
        document.getElementById('pass-msg').style.color = 'green';
        document.getElementById("signup-button").disabled = false;
        return true;
    } else {
        document.getElementById('pass-msg').innerHTML = 'not matching';
        document.getElementById('pass-msg').style.color = 'red';
        document.getElementById("signup-button").disabled = true;
        return false;
    }
}

function modalClose2() {
    var modal = document.getElementById("ageValidation");
    modal.style.display = "none";
}
function modalOpen() {
    var modal = document.getElementById("modalSignupSuccess");
    modal.style.display = "block";
}
function hideModal() {
    let modal = document.getElementById("modalSignupSuccess");
    modal.style.display = "none";

  }
  setInterval(hideModal, 2000);

</script>
</body>
</html>
