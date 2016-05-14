<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Health App</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/materialize.min.css" media="screen,projection">
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
  <link href="assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <style>
  /* Outer */
  .popup, .popup2 {
      width:100%;
      height:100%;
      display:none;
      position:fixed;
      top:0px;
      left:0px;
      background:rgba(0,0,0,0.75);
  }

  /* Inner */
  .popup-inner, .popup-inner2 {
      max-width:700px;
      width:90%;
      padding:40px;
      position:absolute;
      top:50%;
      left:50%;
      -webkit-transform:translate(-50%, -50%);
      transform:translate(-50%, -50%);
      box-shadow:0px 2px 6px rgba(0,0,0,1);
      border-radius:3px;
      background:#fff;
  }

  /* Close Button */
  .popup-close, .popup-close2 {
      width:30px;
      height:30px;
      padding-top:4px;
      display:inline-block;
      position:absolute;
      top:0px;
      right:0px;
      transition:ease 0.25s all;
      -webkit-transform:translate(50%, -50%);
      transform:translate(50%, -50%);
      border-radius:1000px;
      background:rgba(0,0,0,0.8);
      font-family:Arial, Sans-Serif;
      font-size:20px;
      text-align:center;
      line-height:100%;
      color:#fff;
  }

  .popup-close:hover, .popup-close:hover2 {
      -webkit-transform:translate(50%, -50%) rotate(180deg);
      transform:translate(50%, -50%) rotate(180deg);
      background:rgba(0,0,0,1);
      text-decoration:none;
  }
</style>
</head>
<body>
  <nav class="welcome_nav" class=" brown lighten-2" role="navigation">
   <div class="nav-wrapper-container">
     <a href="#" class="brand-logo"></a>
     <!-- <ul id="nav-mobile" class="right hide-on-med-and-down">
       <li><a href="signin">Sign in</a><a href="#"> Visitor</a></li>
     </ul> -->
   </div>
 </nav>
  <div class="section no-pad-bot theme" id="index-banner">

          <div class="container">
            <br><br>
            <h1 class="header center light-blue-text">Welcome to the health store</h1>
            <div class="row center">

            </div>
            <div class="row center">
              <a href="/signin" id="download-button" class="btn-large waves-effect waves-light orange">Sign in</a>
            </div>
            <br><br>
          </div>

        <div class="container">

          <div class="section">

            <!--   Icon Section   -->
            <div class="row">
              <div class="col s12 m4">
                <div class="icon-block"><a class="center welcome-categ" data-popup-open="popup-1" href="#">
                  <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
                  <h5 class="center welcome-categ">About</h5>

                  <p class="center welcome-categ">Meet our team</p>
                </div></a>
              </div>

              <div class="col s12 m4">
                <div class="icon-block"><a href='/display_show_products'>
                  <h2 class="center light-blue-text"><i class="material-icons">search</i></h2>
                  <h5 class="center welcome-categ">Browse products</h5>

                  <p class="center welcome-categ">Browse our online store for the best natural supplements. You can benefit from a custom list of products by registering with our site.</p>
                </div></a>
              </div>

              <div class="col s12 m4">
                <div class="icon-block"><a class="center welcome-categ" data-popup-open="popup-2" href="#">
                  <h2 class="center light-blue-text"><i class="material-icons">contact_phone</i></h2>
                  <h5 class="center welcome-categ">Contact</h5>

                  <p class="center welcome-categ">Please contact us for questions and suggestions.</p>
                </div>
              </div></a>
            </div>

          </div>
          <br><br>

          <div class="section">
            <!-- pop up about us -->
            <div class="popup" data-popup="popup-1">
              <div class="popup-inner">
                <table style="margin-top: 180px;">
                  <thead>
                    <th><img src="/assets/img/kb.jpg" width="150px" height="150px"></th>
                    <th><img src="/assets/img/profile.jpg" width="200px" height="200px"></th>
                    <th><img src="/assets/img/edgar.jpg" width="150px" height="150px" style="border-radius: 50%;"></th>
                  </thead>
                   <tbody>
                     <td style="padding-left: 40px;">KB</td>
                     <td style="padding-left: 60px;">Elena</td>
                     <td style="padding-left: 40px;">Edgar</td>
                   </tbody>
                 </table>
                <p><a data-popup-close="popup-1" href="#">Close</a></p>
                <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
              </div>
           </div>
          </div>
          <!-- pop up contact us -->
           <div class="section">
             <!-- pop up about us -->
             <div class="popup2" data-popup="popup-2">
               <div class="popup-inner2">
                 <table style="margin-top: 180px;">
                   <thead>
                     <th><img src="/assets/img/dojocat.jpg" width="150px" height="150px"></th>
                     <th><img src="/assets/img/dojocat.jpg" width="150px" height="150px"></th>
                     <th><img src="/assets/img/dojocat.jpg" width="150px" height="150px" style="border-radius:50%"></th>
                   </thead>
                   <tbody>
                   <tr>
                     <td style="padding-left: 60px;"><a href="https://github.com/kyungbaekim">KB's github</a></td>
                     <td style="padding-left: 40px;"><a href="https://github.com/esaygo">Elena's github</a></td>
                     <td style="padding-left: 40px;"><a href="https://github.com/egrepo7">edgar's github</a></td>
                   </tr>
                 </tbody>
                 </table>
                 <p><a data-popup-close="popup-2" href="#">Close</a></p>
                 <a class="popup-close2" data-popup-close="popup-2" href="#">x</a>
               </div>
            </div>
           </div>
        </div>
      <footer class="page-footer orange" style="margin: 0; padding: 0">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">



      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-4" href="http://materializecss.com">Materialize feat Team - 2016 -</a>
      </div>
    </div>
  </footer>

  <!--  Scripts-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  <script src="assets/js/init.js"></script>

   <!-- about us pop up -->
  <script>
    $(function() {
   //----- OPEN
   $('[data-popup-open]').on('click', function(e)  {
       var targeted_popup_class = jQuery(this).attr('data-popup-open');
       $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

       e.preventDefault();
   });

   //----- CLOSE
   $('[data-popup-close]').on('click', function(e)  {
       var targeted_popup_class = jQuery(this).attr('data-popup-close');
       $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

       e.preventDefault();
   });
});
  </script>

  </body>
</html>
