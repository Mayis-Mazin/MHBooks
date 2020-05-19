<?php require("includes/connection.php");
if (isset($_POST['submit'])) {
   $name    =$_POST['name'];
   $email   =$_POST['email'];
   $password=$_POST['password'];
   $mobile  =$_POST['mobile'];

   $query="INSERT INTO customer(cust_name,cust_email,cust_password,cust_mobile)
             VALUES ('$name','$email','$password','$mobile')";
    mysqli_query($conn,$query);
    header("location:login.php?email=$email&pass=$password");
}

 ?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign up - MH books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="admin/assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin/assets/css/themify-icons.css">
    <link rel="stylesheet" href="admin/assets/css/metisMenu.css">
    <link rel="stylesheet" href="admin/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="admin/assets/css/typography.css">
    <link rel="stylesheet" href="admin/assets/css/default-css.css">
    <link rel="stylesheet" href="admin/assets/css/styles.css">
    <link rel="stylesheet" href="admin/assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="admin/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--70">
                <form action="" method="post">
                    <div class="login-form-head">
                        <h4>Sign up</h4>
                        <p>Hello there, Sign up and Join with Us</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputName1">Full Name</label>
                            <input type="text" autocomplete="0" name="name" required id="name">
                            <i class="ti-user"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" autocomplete="0" name="email"  required id="email">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Mobile</label>
                            <input type="text" autocomplete="0" name="mobile" required id="mobile">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" required name="password" id="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword2">Confirm Password</label>
                            <input type="password" required id="password2" name="password2">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div id="alert" class="alert alert-danger text-center" role="alert">
                            Password must have at least 8 symbols
                        </div>
                        <div id="alert2" class="alert alert-danger text-center" role="alert">
                            Dose not match between Password and confirm password 
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" name="submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="login.php">Sign in</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="admin/assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="admin/assets/js/popper.min.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/owl.carousel.min.js"></script>
    <script src="admin/assets/js/metisMenu.min.js"></script>
    <script src="admin/assets/js/jquery.slimscroll.min.js"></script>
    <script src="admin/assets/js/jquery.slicknav.min.js"></script>

    <!-- others plugins -->
    <script src="admin/assets/js/plugins.js"></script>
    <script src="admin/assets/js/scripts.js"></script>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function(){
        $('#alert').hide(); 
        $('#alert2').hide(); 
        $('#password').focus(function(event){
            $('#alert').hide();
        });
        $('#password').blur(function(event){
            if($('#password').val().length <8 )
            {
                $('#alert').show();
                $('#password').css('border-color','#dc3545');

            } 
            else {
                $('#alert').hide();
            }
        });
        $('#password2').focus(function(event){
            $('#alert2').hide();
        });
        $('#password2').blur(function(event){
            if ($('#password').val()!=$('#password2').val()) {
                $('#alert2').show();
            } else {
                $('#alert2').hide();
            }
        }) 

    });
</script>