<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ //if user already logged in 
        header("location: users.php");
    }
?>
<?php 
  include_once "header.php";
?>
  <body>
    <div class="wrapper">
        <section class="form login">
            <header>LogIn</header>
            <form action="#">
                <div class="error-txt"></div>
                
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye"></i>
                </div>
               
                <div class="field button">
                    <input type="submit" value="Continue to chat">
                </div>
            </form>
            <div class="link">Not yet signed Up? <a href="index.php">Signup Now</a></div>    
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>

  </body>
</html>
