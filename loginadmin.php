<?php
   include("components/connector.php");

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform login validation
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT adminID,name FROM admin WHERE username = '$username' AND password = '$password'";  
    $result = mysqli_query($db, $query);

    if (empty($username) || empty($password)) {
      // Handle case where either username or password is empty
      echo "Both username and password are required.";
      exit();
  }
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            // Store user information in the 
            $_SESSION['adminID'] = $row['adminID'];
            $_SESSION['name'] = $row['name'];

            echo "<script> window.onload = function() {
              ifSuccess(); }; 
              </script>";
              
        } 
        else {
         echo "<script> window.onload = function() {
           ifFailed();
        }; </script>";
        }
    } else {
        // Handle query execution error
        echo "Error: " . mysqli_error($db);
    }
}

?>



<!DOCTYPE html>
<html>
<head>
 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" href="NEWLOGO.png" type="image/png">

	<title>Kaleidoscope | Login</title>







</head>

<body style="background-color: #212529; overflow: visible; " id="content-body">

<aside>
    <div class="container-fluid" style=" filter: drop-shadow(1px 2px 4px black); ">

    <div class="row" >
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <div class="card mt-3 mb-3" style="border: none; ">
        <center>  <img class="card-img-bottom" src="NEWLOGO.png" alt="aos" style="border: none; width: 60%;"> </center>
          <div class="card-header">
           <center> <h4 style="font-family: sans-serif ; font-size: 2vw;"> LOG-IN </h4> </center>
            
          </div>
          <div class="card-body">
            <form class="needs-validated" action = "" method = "post">
              <div class="mb-2 mt-2">
                <div class="form-floating mt-2">
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username"  />

                  <label for="username" class="form-label">Username</label>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
              </div>
              <div class="mb-1">
                <div class="form-floating input-group">
                  <input type="password" class="form-control" id="password" placeholder="Password" name="password"  />
                  <!--- TOGGLE PASSWORD --->
  <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="togglePassword()">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
  <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
  <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
  <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
</svg>
  </button>

                  <label for="password" class="form-label">Password</label>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <p class="mt-3"><a href="login.php" >Login as user</a></p>


                
              
            </div> 
            <input type="submit" class="btn btn-primary " id="login" name="login" style="width: 100%;" value="LOGIN"> </button>

</form>

<!-- Trigger/Open The Modal -->

</div></div></div></div></div>

 <!-- THE MODAL (SUCCESS) -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 25%;">
     <div class="modal-header text-center" >
        <h3 class="modal-title text-center" id="exampleModalLongTitle">LOGGING IN...</h3>
      </div>
      <div class="modal-body text-success text-center">
        <h4>SUCCESS<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 18">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg></h4>
      </div>
      
  </div>

</div>



 <!-- THE MODAL (FAILED) -->
<div id="myModal2" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="width: 25%;">
     <div class="modal-header text-center" >
        <h3 class="modal-title text-center" id="exampleModalLongTitle">LOGGING IN...</h3>
      </div>
      <div class="modal-body text-danger text-center">
        <h4>INVALID<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 18">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></h4>
      </div>
      
  </div>

</div>






   











</aside>




















<!-- THE MODAL (SignUp - Warning) -->
<div id="modalSignupWarning" class="modal text-center "  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >

  <!-- Modal content -->
  <div class="modal-content text-center" style="width: 40%; height: 45%;">
      <div class="modal-body text-dark text-center">
                <img src="logo2.png" style="width:65%;">
        <hr>
        <h3 class="text-danger">PLEASE DO NOT LEAVE BLANK INFO</h3>
      </div>    
      
  </div>

</div>



<!-- THE MODAL (SignUp - Registered) -->
<div id="modalSignupSuccess" class="modal text-center "  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >

  <!-- Modal content -->
  <div class="modal-content text-center" style="width: 40%; height: 45%;">
      <div class="modal-body text-dark text-center">
                <img src="logo2.png" style="width:65%;">
        <hr>
        <h3 class="text-success">SUCCESSFULLY REGISTERED!</h3>
      </div>    
      
  </div>

</div>


<!-- THE MODAL (SIGNUP - VALID - SELECT PROFILE IMAGE) -->
<div id="modalSelectProfile" class="modal text-center " >

  <!-- Modal content -->
  <div class="modal-content text-center">
     <div class="modal-header text-center">
        <h3 class="modal-title text-center" id="exampleModalLongTitle">KALEIDOSCOPE</h3>
      </div>
      <div class="modal-body text-dark text-center">
        <h4><label class="form-label needs-validated" for="customFile">UPLOAD PROFILE PICTURE</label>
<input type="file" class="form-control mt-3" id="customFile" accept=".jpg,.jpeg,.png" style="width: 40%; display: flex; flex-wrap: wrap; margin: 0 auto;" required/></h4>
      </div>
       <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-danger btn-lg" id="btn-proceedRole2" onclick="unproceed()">Cancel</button>
        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal" id="btn-proceedRole1" onclick="proceedRole()">Proceed</button>
      </div>
      
  </div>




<!-- THE MODAL (SIGNUP - VALID) -->
<div id="modalSignup" class="modal text-center " >

  <!-- Modal content -->
  <div class="modal-content text-center">
     <div class="modal-header text-center">
        <h3 class="modal-title text-center" id="exampleModalLongTitle">KALEIDOSCOPE</h3>
      </div>
      <div class="modal-body text-dark text-center">
        <h4>SIGNING UP AS ...</h4>
      </div>
       <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-success btn-lg" data-dismiss="modal" id="btn-customer" onclick="customerRole()">Customer</button>
        <button type="button" class="btn btn-warning btn-lg" id="btn-seller" onclick="sellerRole()">Seller</button>
      </div>
      
  </div>

</div>



</div>



</div>
        </div>
      </div>

    </div>


  </div>

  

</aside>





<script type="text/javascript">
  
/** LOGIN FUNCTIONS **/
  

  function togglePassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}


/**** MODALS ****/


function ifSuccess() {
   // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

  modal.style.display = "block";
  
      let timeout = setTimeout(modal, 1000);
      setTimeout(() => {  location.replace("admin.php"); }, 1500);

  }


function ifFailed() {
   // Get the modal
let modal = document.getElementById("myModal2");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

  modal.style.display = "block";
  
      let timeout = setTimeout(modal, 1000);
      setTimeout(() => {  location.replace("loginadmin.php"); }, 700);


  }

    












/** SIGN-UP FUNCTIONS **/

//global var
let pr = 0;
let modalSP = document.getElementById("modalSelectProfile");
let modalSG = document.getElementById("modalSignup");



function main2(){
 if(passValidity()){
  proceedToValid();
}
else{
  console.log("Try again.");
}
}



 function ifEmpty(){

let modal = document.getElementById("modalSignupWarning");
modal.style.display = "block";

}
function hideModalEmpty(){
let modal = document.getElementById("modalSignupWarning");
modal.style.display = "none";

}
setInterval(hideModalEmpty,1500);



 function passValidity(){
 if(document.getElementById("ConfirmPassword").value === document.getElementById("Password").value && document.getElementById("Password").value.length != 0 
  && document.getElementById("ConfirmPassword").value.length != 0) {
 // if(document.getElementById("ConfirmPassword").value.length != 0 && document.getElementById("ConfirmPassword").value.length != 0) {
        document.getElementById('pass-msg').innerHTML = "matching";
            document.getElementById('pass-msg').style.color = 'lightgreen';
              document.getElementById("signup-button").disabled = false;
       return true;

   //} 
 }
    else {
            document.getElementById('pass-msg').innerHTML = 'not matching';
                document.getElementById('pass-msg').style.color = 'red';
                   document.getElementById("signup-button").disabled = true;

        return false;
    }

}


function proceedToValid(){
  var btn = document.getElementById("signup-button");
  modalSP.style.display = "block";
  let timeout = setTimeout(modalSP, 12000);

}

function proceedRole(){
  ifValid();
  setTimeout(() => {  proceedToValid(); }, 100);
 // setInterval(showModal,1200);

}
/*
function hideModal(){
modalSP.style.display = "none";
}

function showModal(){
  modalSG.style.display = "block";
}
*/
function unproceed(){
  setTimeout(() => {  location.replace("login.html"); }, 500);
}



function ifValid(){     

  var btn = document.getElementById("btn-proceedRole1");
  modalSG.style.display = "block";
  let timeout = setTimeout(modalSG, 12000);
  }

function customerRole(){
      setTimeout(() => {  location.replace("customer.html"); }, 1000);
   }
function sellerRole(){
        setTimeout(() => {  location.replace("seller.html"); }, 1500);
}


  </script>

</body>
</html>