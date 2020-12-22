<link rel="stylesheet" href="{{asset('css/customstyle.css')}}">
  <div class="row">

    <!--  main nave bar vertical starts     -->

    <div style="background-color:#343a40;height: 850px;" class="col-sm-2">

    <div class="nav flex-column nav-pills"  style="width:100%;" id="tab-pills" role="tablist" aria-orientaion="vertical">
      <!--  vertical navbar contects starts    -->

      <a href="#dashboard" onclick="setDashboard()" class="nav-link active" style="color:white;"  role="pill" data-toggle="tab"><i class="fa fa-tachometer"></i> Dashboard</a>

      <a href="#inventory"  onclick="setInventory()" style="color:white;" class="nav-link " role="pill" data-toggle="tab"><i class="fa fa-bank"></i> Inventory</a>

      <a href="#sale"   onclick="setSale()" style="color:white;"  class="nav-link "  role="pill" data-toggle="tab"><i class="fa fa-print"></i> Sale</a>

      <a href="#order"  onclick="setOrder()" style="color:white;"  class="nav-link "  role="pill" data-toggle="tab"><i class="fa fa-cart-plus"></i> Order Placement</a>

      <a href="#reports"  onclick="setReports()" style="color:white;"  class="nav-link " role="pill" data-toggle="tab"><i class="fa fa-edit"></i> Reports</a>

      <a href="#transactions"   onclick="setTransactions()" style="color:white;" class="nav-link " role="pill" data-toggle="tab"><i class="fa fa-money"></i> Transactions</a>

      <a href="login.html" style="color:white;"  class="nav-link " ><i class="fa fa-sign-out"></i> Sign Out</a>
<!--  vertical navbar contects closed    -->

    </div>
    </div>

    <!--  main nave bar vertical closed    -->


    <div class="col-sm-9">

<!-- tabs body starts   -->

      <div class="tab-content">

        <!-- tabs content starts   -->

      <div role="tabpanel" class="tab-pane fade show active" id="dashboard">NOTTING TO SHOW IN DASHBOARD</div>
      <div role="tabpanel" class="tab-pane" id="inventory">NOTTING TO SHOW IN INVENTORY</div>
      <div role="tabpanel" class="tab-pane" id="sale">NOTTING TO SHOW IN SALE</div>
      <div role="tabpanel" class="tab-pane" id="order">

	    <!-- order tab starts   -->

<div class="container-fluid">

<!-- order placment fluid container starts   -->

<br><br>

<div class="row">

    <!-- search region name and cart icon starts   -->

<div class="col-sm-1"></div>


<div class="col-sm-4">

  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search..">
    <button class="btn btn-info" type="submit"> <i class="fa fa-search" aria-hidden="true"></i></button>
  </form>





</div>



<div class="col-sm-3 text-center">
  <label>Region</label>

</div>

<div class="col-sm-1"></div>

<div class="col-sm-3">

  <a href="#" class="btn btn-info btn-lg">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>

        </a>

</div>
</div>

<!-- search region name and cart icon   -->

<br>


  <div class="row">

<!-- e-commerence grid "1" starts   -->


    <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/panadol.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h6 class="card-title">Pandol</h6>
      <p class="card-text">PKR: 10</p>
    <button type="button" class="btn btn-primary">Details</button>

    </div>
  </div></div>
    <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/brufin.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h6 class="card-title">Brufen</h6>
      <p class="card-text">PKR: 50</p>
     <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Details</button>

    </div>
  </div></div>
    <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/panadolex.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h6 class="card-title">Panadol Extra</h6>
      <p class="card-text">PKR: 10</p>
   <button type="button" class="btn btn-primary">Details</button>

    </div>
  </div></div>
  <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/Augmentin.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h6 class="card-title">Augmentin</h6>
      <p class="card-text">PKR: 100</p>
   <button type="button" class="btn btn-primary">Details</button>

    </div>
  </div></div>
  </div>

<!-- e-commerence grid "1" closed   -->
<br>
<div class="row">

<!-- e-commerence grid "2" starts   -->


    <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/Proviron.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h6 class="card-title">Proviron</h6>
      <p class="card-text">PKR: 450</p>
    <button type="button" class="btn btn-primary">Details</button>

    </div>
  </div></div>
    <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/flagyl.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h6 class="card-title">Flagyl</h6>
      <p class="card-text">PKR: 45</p>
     <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Details</button>

    </div>
  </div></div>
    <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/ampiclox.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h6 class="card-title">Ampiclox</h6>
      <p class="card-text">PKR: 200</p>
   <button type="button" class="btn btn-primary">Details</button>

    </div>
  </div></div>
  <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/ampicillin.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h6 class="card-title">Ampicillin</h6>
      <p class="card-text">PKR: 300</p>
   <button type="button" class="btn btn-primary">Details</button>

    </div>
  </div></div>
  </div>

<!-- e-commerence grid "2"closed   -->



</div>

<!-- order placment fluid container ends   -->


	  </div>
<!--order placment completed-->

<div role="tabpanel" class="tab-pane" id="reports">NOTTING TO SHOW IN reports</div>
<div role="tabpanel" class="tab-pane" id="transactions">NOTTING TO SHOW IN transactions</div>
<div role="tabpanel" class="tab-pane" id="logout">this will logout our page</div>

    </div>

  <!-- tabs content ends   -->

    </div>

    <!-- tabs body ends   -->



  </div>

<!--  body closed     -->


 <!-- The brufen Modal starts-->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">

 <!-- search region name and cart-->


          <div class="row">



<div class="col-sm-3">


</div>



<div class="col-sm-3 text-center">
  <label>Region</label>

</div>



<div class="col-sm-3">



</div>
</div>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>


        <!-- Modal heading closed -->

        <!-- Modal body -->
        <div class="modal-body">


<div class="row">
  <div class="col-sm-1"></div>
    <div class="col-sm-3"> <div class="card" style="width:200px">
    <img class="card-img-top" src="img/brufin.jpg" alt="Card image" style="width:100%">

  </div>


</div>
    <div class="col-sm-3"> <div style="width:200px">
     <h6>Brufen</h6>
     <h6>20 ml</h6>
     <h6>mag data 12/1/2020</h6>
     <h6>exp date 12/1/2021</h6>


    </div>

    </div>
  <div class="col-sm-3">
   <!-- Nav for cart starts -->
<nav class="navbar navbar-inverse bg-inverse fixed-top bg-faded">
    <div class="row">
        <div class="col">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cart">cart(<span class="total-count"></span>)</button></div>
    </div>
</nav>
<!-- Nav for cart ends -->

<!-- Main -->
<div class="container">
    <div class="row">
      <div class="col">
        <div style="width: 20rem;">

  <div>
    <h4>Brufen</h4>
    <h2>PKR: 50</h2>
    <a href="#" data-name="Brufen" data-price="50" class="add-to-cart btn btn-primary">Add to cart</a>
    <button class="clear-cart btn btn-danger">Clear Cart</button>
  </div>
</div>
      </div>

</div>


 <!-- Modal for add to cart starts-->

<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <!--model in model plus minus and cross-->

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="show-cart table">

        </table>
        <div>Total price PKR: <span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a type="button" href="checkout.html" target="_blank" class="btn btn-primary">Order now</a>
      </div>
    </div>
  </div>
    <!--model in model plus minus and cross-->
</div>

 <!-- Modal for add to cart ends-->

  </div>
  <div class="col-sm-1"></div>
  </div>

<br>
<div class="container">


  <div class="row">
    <div class="col-sm-1"></div>

    <div class="col-sm-9">
      <br><br>
  <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Description</button>
  <div id="demo" class="collapse"><br>
    Brufen is indicated for its analgesic and anti-inflammatory effects in the treatment of rheumatoid arthritis (including juvenile rheumatoid arthritis or Still's disease), ankylosing spondylitis, osteoarthritis and other non-rheumatoid (seronegative) arthropathies.

In the treatment of non-articular rheumatic conditions, Brufen is indicated in periarticular conditions such as frozen shoulder (capsulitis), bursitis, tendonitis, tenosynovitis and low back pain; Brufen can also be used in soft tissue injuries such as sprains and strains.

Brufen is also indicated for its analgesic effect in the relief of mild to moderate pain such as dysmenorrhoea, dental and post-operative pain and for symptomatic relief of headache, including migraine headache.
  </div>
  </div>

    <div class="col-sm-2"></div>
</div>
  </div>
        </div>



      </div>
    </div>
  </div>



<!-- The brufen Modal ends-->





</body>
</html>

<!--script for plus minus or checkout starts-->
<script>


// shopping cart


var shoppingCart = (function() {

  // private methods and propeties

  cart = [];

  // constructor
  function Item(name, price, count) {
    this.name = name;
    this.price = price;
    this.count = count;
  }

  // lave cart
  function saveCart() {
    sessionStorage.setItem('shoppingCart', JSON.stringify(cart));
  }

    // load cart
  function loadCart() {
    cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
  }
  if (sessionStorage.getItem("shoppingCart") != null) {
    loadCart();
  }



  // public methods and propeties

  var obj = {};

  // add to cart
  obj.addItemToCart = function(name, price, count) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart[item].count ++;
        saveCart();
        return;
      }
    }
    var item = new Item(name, price, count);
    cart.push(item);
    saveCart();
  }
  // set count from item
  obj.setCountForItem = function(name, count) {
    for(var i in cart) {
      if (cart[i].name === name) {
        cart[i].count = count;
        break;
      }
    }
  };
  // remove item from cart
  obj.removeItemFromCart = function(name) {
      for(var item in cart) {
        if(cart[item].name === name) {
          cart[item].count --;
          if(cart[item].count === 0) {
            cart.splice(item, 1);
          }
          break;
        }
    }
    saveCart();
  }

  // remove all items from cart
  obj.removeItemFromCartAll = function(name) {
    for(var item in cart) {
      if(cart[item].name === name) {
        cart.splice(item, 1);
        break;
      }
    }
    saveCart();
  }

  // clear cart
  obj.clearCart = function() {
    cart = [];
    saveCart();
  }

  // count cart
  obj.totalCount = function() {
    var totalCount = 0;
    for(var item in cart) {
      totalCount += cart[item].count;
    }
    return totalCount;
  }

  // total cart
  obj.totalCart = function() {
    var totalCart = 0;
    for(var item in cart) {
      totalCart += cart[item].price * cart[item].count;
    }
    return Number(totalCart.toFixed(2));
  }

  // list cart
  obj.listCart = function() {
    var cartCopy = [];
    for(i in cart) {
      item = cart[i];
      itemCopy = {};
      for(p in item) {
        itemCopy[p] = item[p];

      }
      itemCopy.total = Number(item.price * item.count).toFixed(2);
      cartCopy.push(itemCopy)
    }
    return cartCopy;
  }

  // cart : Array
  // Item : Object/Class
  // addItemToCart : Function
  // removeItemFromCart : Function
  // removeItemFromCartAll : Function
  // clearCart : Function
  // countCart : Function
  // totalCart : Function
  // listCart : Function
  // saveCart : Function
  // loadCart : Function
  // all functions which are elisted above............
  return obj;
})();



//  events

// add item
$('.add-to-cart').click(function(event) {
  event.preventDefault();
  var name = $(this).data('name');
  var price = Number($(this).data('price'));
  shoppingCart.addItemToCart(name, price, 1);
  displayCart();
});

// clear items
$('.clear-cart').click(function() {
  shoppingCart.clearCart();
  displayCart();
});


function displayCart() {
  var cartArray = shoppingCart.listCart();
  var output = "";
  for(var i in cartArray) {
    output += "<tr>"
      + "<td>" + cartArray[i].name + "</td>"
      + "<td>(" + cartArray[i].price + ")</td>"
      + "<td><div class='input-group'><button class='minus-item input-group-addon btn btn-primary' data-name=" + cartArray[i].name + ">-</button>"
      + "<input type='number' class='item-count form-control' data-name='" + cartArray[i].name + "' value='" + cartArray[i].count + "'>"
      + "<button class='plus-item btn btn-primary input-group-addon' data-name=" + cartArray[i].name + ">+</button></div></td>"
      + "<td><button class='delete-item btn btn-danger' data-name=" + cartArray[i].name + ">X</button></td>"
      + " = "
      + "<td>" + cartArray[i].total + "</td>"
      +  "</tr>";
  }
  $('.show-cart').html(output);
  $('.total-cart').html(shoppingCart.totalCart());
  $('.total-count').html(shoppingCart.totalCount());
}

// delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
  var name = $(this).data('name')
  shoppingCart.removeItemFromCartAll(name);
  displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
  var name = $(this).data('name')
  shoppingCart.removeItemFromCart(name);
  displayCart();
})
// +1
$('.show-cart').on("click", ".plus-item", function(event) {
  var name = $(this).data('name')
  shoppingCart.addItemToCart(name);
  displayCart();
})

// item count input
$('.show-cart').on("change", ".item-count", function(event) {
   var name = $(this).data('name');
   var count = Number($(this).val());
  shoppingCart.setCountForItem(name, count);
  displayCart();
});

displayCart();

//<!--script for plus minus or checkout starts-->

//<!--script changing dashbord names starts-->
function setDashboard() {
  document.getElementById("setTitle").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Dashboard</b>";
  document.getElementById("titles").innerHTML ="Retailer | Dashboard";
}
function setInventory() {
  document.getElementById("setTitle").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Inventory</b>";
  document.getElementById("titles").innerHTML ="Retailer | Inventory";
}
function setSale() {
  document.getElementById("setTitle").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Sale</b>";
  document.getElementById("titles").innerHTML ="Retailer | Sale";
}
function setOrder() {
  document.getElementById("setTitle").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Order Placement</b>";
  document.getElementById("titles").innerHTML ="Retailer | Order Placement";
}
function setReports() {
  document.getElementById("setTitle").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Reports</b>";
  document.getElementById("titles").innerHTML ="Retailer | Reports";
}
function setTransactions() {
  document.getElementById("setTitle").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Transactions</b>";
  document.getElementById("titles").innerHTML ="Retailer | Transactions";
}
//<!--script changing dashbord names starts-->
</script>
//<!--for refresh active tab starts -->
<script type="text/javascript">

  $(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#tab-pills a[href="' + activeTab + '"]').tab('show');
    }
});
  //<!--for refresh active tab ends-->

</script>
