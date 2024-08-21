<header class="header">
   <section class="flex">
      <a href="home.php" class="logo">candy store 🍬</a>
      <nav class="navbar">
         <a href="/">home</a>
         <a href="#">about</a>
         <a href="/menu">menu</a>
         <a href="/order">orders</a>
         <a href="#">contact</a>
      </nav>
      @php
      $cart = session()->get('cart', []);
      $totalNumber = 0;
      foreach ($cart as $item) {
         $totalNumber += $item['number'];
      }
     @endphp
      <div class="icons">
         <a href="#"><i class="fas fa-search"></i></a>
         <a href="/cart"><i class="fas fa-shopping-cart"></i><span id="cart-number">{{$totalNumber}}</span></a>
         <!-- <div id="user-btn" class="fas fa-user"></div> -->
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <!-- <div class="profile">
         <p class="name">name</p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="logout" class="delete-btn">logout</a>
         </div>
         <p class="account">
            <a href="login.php">login</a> or
            <a href="register.php">register</a>
         </p>

         <p class="name">please login first!</p>
         <a href="login.php" class="btn">login</a>
      </div> -->
   </section>
</header>