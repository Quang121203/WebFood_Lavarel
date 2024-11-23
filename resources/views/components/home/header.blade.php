<header class="header">
   <section class="flex">
      <a href="/" class="logo">napoleQuang store 🍬</a>
      <nav class="navbar">
         <a href="/">home</a>
         <a href="/about">about</a>
         <a href="/menu">menu</a>
         <a href="/order">orders</a>
      </nav>

      <div class="icons" style="display:flex; justufy-content:center">
         <a href="/cart"><i class="fas fa-shopping-cart"></i><span id="cart-number">0</span></a>
         @if(!Auth::check() || !Auth::user()->img)
          <div id="user-btn" class="fas fa-user"></div>
       @else
       <img id="user-btn" src="{{asset('storage/users/' . Auth::user()->img)}}"
         style="width:3rem; height:3rem;border-radius: 50% ;"></img>
    @endif
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile" style="width:auto">
         @if(Auth::check())
          <p class="name">{{ Auth::user()->name}}</p>
          <div class="flex">
            <a href="/profile" class="btn">profile</a>
            <button href="logout" class="delete-btn" onclick="logout()">logout</button>
          </div>
       @else
       <p class="name">please login first!</p>
       <a href="/login" class="btn">login</a>
    @endif
      </div>
   </section>
</header>