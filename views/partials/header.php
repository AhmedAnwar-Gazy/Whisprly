 <header class="site-header">
     <div class="container">
         <div class="logo">
             <svg class="logo-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
             </svg>
             <a href="/" class="logo-text">
                 Whisprly
             </a>

         </div>

         <nav class="site-nav">
             <ul>
                 <li><a href="/podcast_index">Podcasts</a></li>
                 <li><a href="/book_index">Books</a></li>
                 <li><a href="/podcast_list">Library</a></li>
                 <!-- <li><a href="/creator_manage_my_content">Creator</a></li> -->
                 <li><a href="/dashboard_admin">Admin</a></li>
             </ul>
         </nav>

         <div class="mobile-menu-button">
             <button class="menu-toggle">
                 <svg class="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                 </svg>
             </button>
         </div>
         <?php if ($_SESSION['user'] ?? false) : ?>
             <a class="btn" href="/user_show?user_id=<?= $_SESSION['user']['user_id'] ?>"><img class="profile" src="views/media/images/<?= $_SESSION['user']['photo'] ?? 'user.png' ?>" alt="profil"></a>
             <form action="/logout" class="but_sgin" method="post">
                 <input type="hidden" name="_method" value="DELETE">
                 <button class="btn" type="submit" aria-label="logout">LogOut</button>
             </form>
         <?php else : ?>
             <div class="auth-buttons">
                 <a href="/login" class="btn login-btn">
                     Login
                 </a>
                 <a href="/register" class="btn signup-btn">
                     Signup
                 </a>
             </div>
         <?php endif ?>
     </div>
 </header>