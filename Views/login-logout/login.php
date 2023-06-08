
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="public/css/style.css">
    <title>Levents - Popular Stresswear brand</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <!-- <script src="public/js/scrollToTop.js"></script> -->
    <!-- <script src="public/js/cart.js"></script> -->
    <!-- <script src="public/js/header.js"></script> -->
    <!-- <script src="public/js/quantity.js"></script> -->
    <link rel="icon" href="public/images/cropped-douopleeblue-270x270.png">
</head>
<body>
<div class="container-fluid" style="padding: 0;">
<div class="topbar">
            <div id="logo">
                <nav class="navbar navbar-expand-lg bg-body-tertiary" style="border-bottom:1px solid rgb(159, 159, 159) ;">
                    <div class="col-lg-4"></div>
                    <div class=" col-lg-4 text-center" style="padding:10px">
                        <a class="" href="index.php ">
                            <img width="98 " height="30 " src="https://levents.asia/wp-content/uploads/2021/10/logo.png " class="custom-logo " alt="Levents ">
                        </a>
                    </div>

                    <div class="col-lg-4 "></div>
                </nav>
            </div>
</div>
</div>

      <div class="body " style="margin-top:180px">
        <div class="row">
        <div class="col col-lg-4"></div>
        <div class="col col-lg-4">
            <h4 class="text-center text-muted">Login</h4>
            <div class="contact_form mt-5">
            <form role = "form" method ="post" action="index.php?controller=login&action=checkLogin">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"  name='username' style=" border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" placeholder="Username">
                            </div>
                            <div class="input-group mb-3">
                                        <input type="password" class="form-control " name='password' style="width:345px; border: none; border-radius:0; border-bottom: 1px solid rgb(159, 159, 159);" placeholder="Password">
                            </div>
                           
                            <div class="regis">You don't have acount?
                                <a class="text-danger text-decoration-none" href="?controller=login&action=register">Register</a>
                            </div>
                            <button type="submit" name="btn" class="btn btn-secondary mt-3" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.3); border-radius: 0%; width: 200px;">
                                    Login
                                </button>
            </form>
                        </div>
        </div>
        <div class="col col-lg-4"></div>
        </div>
          
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js "></script>
</body>
</html>
      