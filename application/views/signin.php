<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <title>Health App - Signin</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/materialize.min.css" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <style>
  body {
    background: url("assets/img/signin_background3.jpg");
    background-size: cover;
  }
  .input-field label{
    color:rgba(64, 55, 54,0.8);
  }
  </style>
  <script type="text/javascript" src='http://code.jquery.com/jquery-2.2.2.js'></script>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
   <div class="nav-wrapper-container">
     <a href="#" class="brand-logo">Health App</a>
     <ul id="nav-mobile" class="right hide-on-med-and-down">
       <li><a href="/">Home</a></li>
       <li><a href="/display_show_products">Browse Products</a></li>
     </ul>
   </div>
 </nav>
 <div class="row">
 <?php echo validation_errors(); ?>
 <?php if ($this->session->flashdata('login_error')) {
   echo $this->session->flashdata('login_error');
 }?>
 </div>
 <!-- <div class="container"> -->
 <div class="row"> <!-- wrapper for reg -->

<!-- registration form -->

   <form class="col s12" action="process_register" method="post">
     <div class="row">

       <!--left side of reg form-->
       <div class="col s6 overlay" style="background: rgba(108, 119, 111, 0.3);
       background-size: cover; border-radius:10px; width:40%; margin-right:10%; ">
           <div class="input-field col s8">
             <input id="email" type="email" name="email" class="validate" required>
             <label for="email">Email</label>
           </div>

            <div class="input-field col s8">
              <input id="first_name" name="first_name" type="text" class="validate" required>
              <label for="first_name">First Name</label>
            </div>


            <div class="input-field col s8">
              <input id="last_name" type="text" name="last_name" class="validate" required>
              <label for="last_name">Last Name</label>
            </div>


            <div class="input-field col s8">
              <input id="password" type="password" name="password" class="validate" required>
              <label for="password">Password</label>
            </div>

            <div class="input-field col s8">
              <input id="password" type="password" name="confirm_password" class="validate">
              <label for="password">Password Confirmation</label>
            </div>

            <div class="row">
             <div class="col s6">
              <button class="btn waves-effect waves-light" type="submit">Register
                <i class="material-icons right">send</i>
              </button>
           </div>
           </div>


        </div> <!--end of left side of reg form-->


<!-- moved to right side-->

    <div class="col s6 overlay" style="background: rgba(108, 119, 111, 0.3);
    background-size: cover; border-radius:10px; width:40%; ">
        <div class="input-field col s9">
          <p>Please pick at least one category (max three)</p>
        </div>

          <div class="row">
              <div class="input-field col s12">
                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="blood-pressure" value='1' name="interest[]"/>
                       <label for="blood-pressure">Blood pressure</label>
                  </div>

                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="diabetes" value='2' name="interest[]"/>
                       <label for="diabetes">Diabetes</label>
                  </div>

                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in"  id="weight-management" value='3' name="interest[]"/>
                       <label for="weight-management">Weight Management</label>
                  </div>
              </div>
          </div>

            <div class="row">
              <div class="input-field col s12">
                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="cold-flu" value='4' name="interest[]"/>
                       <label for="cold-flu">Cold/ Flu/ Influenza</label>
                  </div>

                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="back-pain" value='5' name="interest[]"/>
                       <label for="back-pain">Back pain</label>
                  </div>

                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="muscle-gain" value='6' name="interest[]"/>
                       <label for="muscle-gain">Muscle gain</label>
                  </div>
              </div>
          </div>


              <div class="input-field col s12">
                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="heart-disease" value='7' name="interest[]"/>
                       <label for="heart-disease">Heart disease</label>
                  </div>

                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="depression" value='8' name="interest[]"/>
                       <label for="depression">Depression</label>
                  </div>

                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="allergies" value='9' name="interest[]"/>
                       <label for="allergies">Seasonal allergies</label>
                  </div>
              </div>
          <!-- </div> -->

          <div class="row">
              <div class="input-field col s12">
                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="female-fertility" value='10' name="interest[]"/>
                       <label for="female-fertility">Female fertility</label>
                  </div>

                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="male-fertility" value='11' name="interest[]"/>
                       <label for="male-fertility">Male Fertility</label>
                  </div>

                  <div class="input-field col s3">
                      <input type="checkbox" class="filled-in" id="eye-disease" value='12' name="interest[]"/>
                       <label for="eye-disease">Eye disease</label>
                  </div>
              </div>
          </div>

       </form>
     </div>
   </div>

</div> <!--end of row reg form -->
<!-- end of registration -->



<!-- sign in form  -->
   <form class="col s6" action="process_signin" method="post">
     <div class="row">
       <div class="input-field col s3">
         <input id="email" type="email" name="email" class="validate">
         <label for="email">Email</label>
       </div>
     </div>
     <div class="row">
       <div class="input-field col s3">
         <input id="password" type="password" name="password" class="validate">
         <label for="password">Password</label>
       </div>
     </div>
     <button class="btn waves-effect waves-light" type="submit">Sign In
    <i class="material-icons right">send</i>
    </button>
   </form>

<!-- </div> <!-- end of main container -->
  <footer class="page-footer orange">
    <!-- <a href="process_admin">Admin_page</a>
    <a href="show_products">show_products </a> -->
    <div class="footer-copyright">
      <div class="container">
      Powered by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize feat Team - 2016 -</a>
      </div>
    </div><!-- end of main wrapper for login, reg and checkboxes -->
  </footer>

  <!--  Scripts-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  <script src="assets/js/init.js"></script>

  </body>
</html>
