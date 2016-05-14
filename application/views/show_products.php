<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
  <title>Health App - Admin</title>

  <!-- CSS  -->
  <script type="text/javascript" src='http://code.jquery.com/jquery-2.2.2.js'></script>
  <script>

  var base = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/';
  var interests = [];
  var count;
  var db = 'pubmed';
  $(document).ready(function() {
    $('#ncbi-news').html('');
    $('#quantity').val('');
    var logged_in = <?php echo json_encode(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null); ?>;
    if(logged_in){
      // console.log("You're logged in");
      $.ajax({
        url: '/script',
        dataType: 'json',
        cache: false,
        success: function(data){
          interests = data;
          count = interests.length;
          get_interests(count, interests);
        }, type: 'GET'
      });
      $.get('/display_cart', function(val) {
        $('.cart').html('');
        var final = 0;
        for(var i=0; i<val.length; i++){
          $('.cart').append('<tr>');
          $('.cart').append('<td>'+ val[i].item +'</td>');
          $('.cart').append('<td>'+ val[i].qty +'</td>');
          $('.cart').append('<td>'+ val[i].price +'</td>');
          $('.cart').append("</tr>");
          final += parseFloat(val[i].grand_total);
        }
        $('.cart').append("<tr><td colspan='3'>Total: $ "+ final.toFixed(2) +"</td></tr>");
      }, 'json');
    }
    else{
      interests = ['Blood Pressure', 'Diabetes', 'Depression', 'Seasonal Allergies', 'Eye disease', 'Heart Disease'];
      count = interests.length;
      get_interests(count, interests);
    }
    $('form').submit(function(e){
      $.post('/add_to_cart_process', $(this).serialize(), function(res){
        var quantity = res.stock;
        // console.log(res);
        $(e.target).children('.stock').html("<p class='quantity'>Item left: "+quantity+"</p>");
        $.get('/display_cart', function(val) {
          $('.cart').html('');
          var final = 0;
          for(var i=0; i<val.length; i++){
            $('.cart').append('<tr>');
            $('.cart').append('<td>'+ val[i].item +'</td>');
            $('.cart').append('<td>'+ val[i].qty +'</td>');
            $('.cart').append('<td>'+ val[i].price +'</td>');
            $('.cart').append("</tr>");
            final += parseFloat(val[i].grand_total);
          }
          $('.cart').append("<tr><td colspan='3'>Total: $ "+ final.toFixed(2) +"</td></tr>");
        }, 'json');
      }, 'json');
      $(e.target).children('#quantity').val('');
      return false;
    });
  });

  function get_interests(count, interests){
    for(var i=0; i<count; i++){
      var interest = interests[i];
      var query = interest.replace(/[^a-z0-9]+/gi, '+');
      var retmax = 6 / count;
      var url = base + 'esearch.fcgi?db='+db+'&retmode=json&term='+query+'&field=title&retmax='+retmax;
      $.get(url, function(res) {
        display(res.esearchresult.idlist);
      }, 'json');
    }
  }
  function display(idlist){
    var base2 = 'http://eutils.ncbi.nlm.nih.gov/entrez/eutils/efetch.fcgi';
    for(var i=0; i<idlist.length; i++){
      var url2 = base2 + '?db='+db+'&retmode=xml&id='+idlist[i];
      $.get(url2, function(xml) {
        var json = (xmlToJson(xml));
        var title = json.PubmedArticleSet[1].PubmedArticle.MedlineCitation.Article.ArticleTitle["#text"];
        var pmid = json.PubmedArticleSet[1].PubmedArticle.MedlineCitation.PMID["#text"];
        $('#ncbi-news').append("<p><a href='http://www.ncbi.nlm.nih.gov/pubmed/" + pmid + "' target='_blank'>" + title + "</a></p>");
      }, 'xml');
    }
  }
  function xmlToJson(xml) {
    var obj = {};
    if (xml.nodeType == 1) { // element
      // do attributes
      if (xml.attributes.length > 0) {
      obj["@attributes"] = {};
        for (var j = 0; j < xml.attributes.length; j++) {
          var attribute = xml.attributes.item(j);
          obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
        }
      }
    } else if (xml.nodeType == 3) {
      obj = xml.nodeValue;
    }
    // do children
    if (xml.hasChildNodes()) {
      for(var i = 0; i < xml.childNodes.length; i++) {
        var item = xml.childNodes.item(i);
        var nodeName = item.nodeName;
        if (typeof(obj[nodeName]) == "undefined") {
          obj[nodeName] = xmlToJson(item);
        } else {
          if (typeof(obj[nodeName].push) == "undefined") {
            var old = obj[nodeName];
            obj[nodeName] = [];
            obj[nodeName].push(old);
          }
          obj[nodeName].push(xmlToJson(item));
        }
      }
    }
    return obj;
  };
  </script>
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
          echo "<li><a href='/logout'>Log out</a></li>";
        }
        else{
          echo "<li class='user_name'>Welcome visitor!</li>";
          echo "<li><a href='/'>Home</a></li>";
          echo "<li><a href='/signin'>Sign In</a></li>";
        }
       ?>
    </ul>
   </div>
 </nav>


 <!-- <div class="container"> -->
   <!-- Page Layout here -->
        <div class="row" id="prod_container">

          <!-- <div class="container"> -->
            <div class="col s7">

              <!-- page content  -->
              <?php echo validation_errors(); ?>

              <?php
              if($this->session->flashdata('order_error')) {
                echo $this->session->flashdata('order_error');
              } ?>

              <div class="row" id="products">
                <?php
                $counter = 0;
                foreach ($user_products as $product) { ?>
                  <?php if($counter == 4) {  $counter = 0; ?>
                    <div style="border-bottom: 1px solid lightgrey; margin-bottom: 30px;" class="row" ></div>
                  <?php } ?>
                  <div class="col s3">
                    <form style="height: 400px;" class="col s12" action="add_to_cart_process" method="post">
                       <legend id="prod_name" sytel="font-size; 1.2em; padding-bottom: 10px;"><strong><?= $product['item']; ?></strong></legend>
                       <?php
                        if(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null){
                          echo "<input type='hidden' name='product_id' value='".$product['prod_id']."'>";
                          echo "<input type='hidden' name='user_id' value='". $product['user_id']."'>";
                        }
                        else {
                          echo "<input type='hidden' name='product_id' value='".$product['id']."'>";
                        }
                        ?>
                       <img src="<?= $product['picture']; ?>">
                       <div style="height: 100px;">
                         <p><?= $product['description']; ?></p>
                       </div>
                       <p>Price: $<?= $product['price']; ?></p>

                       <input type='hidden' id='stock' name='stock' value='<?= $product['stock'] ?>'>
                       <!-- <label>Qty: </label> -->
                       <?php
                        if(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null){
                          if($product['stock'] > 0){
                            echo "<p class='stock'>Item left: ".$product['stock']."</p>";
                            echo "<input class='col s8' id='quantity' type='number' name='quantity'>";
                            echo "<button type='submit' class='send'>Add to cart</button>";
                          }
                          else{
                            echo "<p>Out of Stock</p>";
                          }
                        }
                        ?>
                     </form>
                  </div>
              <?php $counter++;}?>

              </div>
            </div>
          <!-- </div> products container-->


          <?php
              if(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null){
                echo "<div class='col s3' id='ncbi_title'>";
                echo "<h6><b>Most recent NCBI articles</b></h6>";
                echo "</div>";
              }
              else{
                echo "<div class='col s3' id='ncbi_title'>";
                echo "<h6><b>Most recent NCBI articles you might be interested in.</b></h6>";
                echo "</div>";
              }
             ?>
            <div class="col s3" id="ncbi-news">

              <!-- side ncbi feed panel -->

            </div>

              <div class="col s2" id="cart">
                <div class="card blue-grey darken-1">
                      <div class="card-content white-text">
                        <span class="card-title">Cart</span>
                        <span style="padding-left: 30px"><img src="assets/img/cart.png" width="40px" height="40px"></span>
                        <table>
                          <thead>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                          </thead>
                          <tbody class='cart' style="font-size: 0.6em;"></tbody>
                        </table>
                        </div>
                        <div class="card-action">
                          <?php
                          if(isset($this->session->userdata['login_info']['id']) && $this->session->userdata['login_info']['id'] != null){
                          echo "<a href='/checkout/". $user_products[0]['user_id']. "'>Checkout</a>";
                          echo "<a style='font-size: 0.7em; color:yellow' href='/empty_cart/" . $user_products[0]['user_id']. "'>Empty cart</a>";
                        } ?>
                        </div>
                      </div>
              </div>
       </div>
<!-- </div> -->


<footer class="page-footer orange">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize feat Team - 2016 -</a>
      </div>
    </div><!-- end of main wrapper for login, reg and checkboxes -->
  </footer>



  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
  <script src="assets/js/init.js"></script>
  <!--  Scripts-->
  <script>
    $(document).ready(function() {
    $('select').material_select();
  });
</script>
  </body>
</html>
