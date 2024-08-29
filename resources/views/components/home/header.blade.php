<header class="header">
   <section class="flex">
      <a href="/" class="logo">candy store 🍬</a>
      <nav class="navbar">
         <a href="/">home</a>
         <a href="#">about</a>
         <a href="/menu">menu</a>
         <a href="/order">orders</a>
         <a href="#">contact</a>
      </nav>

      <div class="icons">
         <a href="#"><i class="fas fa-search"></i></a>
         <a href="/cart"><i class="fas fa-shopping-cart"></i><span id="cart-number">0</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile" style="width:auto">
         @if(Auth::check())
          <p class="name">{{ Auth::user()->name}}</p>
          <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            @if(Auth::user()->role_id != 2)
            <a href="/admin" class="btn" style="margin: 1rem 1rem 0rem 1rem">admin</a>
         @endif
            <button href="logout" class="delete-btn" onclick="logout()">logout</button>
          </div>
       @else
       <p class="name">please login first!</p>
       <a href="/login" class="btn">login</a>
    @endif
      </div>
   </section>
</header>