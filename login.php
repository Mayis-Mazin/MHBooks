<?php
    require("includes/connection.php");
    session_start();
    if (isset($_POST['submit'])) {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $query="SELECT * FROM customer WHERE cust_email='$email' and
        cust_password='$password'";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        if(isset($row['cust_id'])){

            $_SESSION['user_id'] = $row['cust_id'];
            if (!isset($_SESSION['cart'])) {
            header('location:index.php');       
           }else
           {
            header('location:cart.php');       

           }  
        }else
        {
            $massage= "USER NOT FOUND";
        }
    }
    if (isset($_GET['email'])) {
        $email=$_GET['email'];
        $password=$_GET['pass'];
        $query="SELECT * FROM customer WHERE cust_email='$email'
        and cust_password='$password'";
         $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_assoc($result);
        if(isset($row['cust_id'])){
           $_SESSION['user_id'] = $row['cust_id'];
           if (!isset($_SESSION['cart'])) {
            header('location:index.php');       
           }else
           {
            header('location:cart.php');       

           }
        }
    }
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - MH Books</title>
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
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <!-- <div id="preloader">
        <div class="loader"></div>
    </div> -->
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-s2">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="" method="post">
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and be one of family <span style=" color:#ffa45c;">MH Books</span></p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" required id="email">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" required id="password" name="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" name="submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                         <?php if (isset($massage)) { ?>
                                    <div class="alert alert-danger text-center" id="alert" role="alert">
                                       <?php echo $massage ?>
                                   </div>
                               <?php }?>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="register.php">Sign up</a></p>
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
        // $('#alert').hide(); 
        $('#email').focus(function(event){
            $('#alert').hide();
        });
         $('#password').focus(function(event){
            $('#alert').hide();
        });

    });
</script>