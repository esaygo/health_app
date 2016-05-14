<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Health App - Admin</title>


  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/materialize.min.css" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
   <div class="nav-wrapper-container">
     <a href="#" class="brand-logo">Health App</a>
     <ul id="nav-mobile" class="right hide-on-med-and-down">
       <?php
        if(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null){
          echo "<li class='user_name'>Welcome ".$this->session->userdata['login_info']['first_name']."!</li>";
          echo "<li><a href='/'>Home</a></li>";
          echo "<li><a href='/display_show_products'>Products</a></li>";
          echo "<li><a href='logout'>Log out</a></li>";
        }
        else{
          echo "<li><a href="/">Home</a></li>";
          echo "<li><a href='/signin'>Sign In</a></li>";
        }
       ?>
    </ul>
   </div>
 </nav>

<div class="container" style="max-width: 640px;">

      <div class="card">
      <div class="card-image waves-effect waves-block waves-light">
        <img height="550px" width="300px" class="activator" src="../../assets/img/checkout.jpg">
      </div>
      <div class="card-content">
        <span class="card-title activator grey-text text-darken-4">checkout<i class="material-icons right">more_vert</i></span>
        <p><a href="#">See your order</a></p>
      </div>
      <div class="card-reveal">
        <span class="card-title grey-text text-darken-4">Your order:<i class="material-icons right">close</i></span>

        <table>
          <thead>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
          </thead>
          <tbody>
        <?php foreach ($cart as $value) { ?>
        <tr>
          <td><?= $value['item']; ?></td>
          <td><?= $value['qty']; ?></td>
          <td><?= $value['price']; ?></td>
        </tr>
        <?php } ?>
        <tr>
          <td  colspan='2'>Total: </td>
          <td>$ <?php
            if(isset($cart[0])) {
              $total_cart = 0;
              $cart[0]['grand_total'];
              for($i=0; $i<count($cart); $i++ ) {
                $total_cart += $cart[$i]['grand_total'];
              }
                echo $total_cart;
              }
            ?></td>
        </tr>
      </tbody>
    </table>

      </div>
    </div>
</div> <!-- end of container-->
<footer class="page-footer orange">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize feat Team - 2016 -</a>
      </div>
    </div><!-- end of main wrapper for login, reg and checkboxes -->
  </footer>


<script type="text/javascript" src='http://code.jquery.com/jquery-2.2.2.js'></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>


  </body>
</html>
