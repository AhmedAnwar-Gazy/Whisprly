 <?php  //dd($_SERVER['SCRIPT_URL']);// if ($_SERVER ["SCRIPT_URL"]== "/podcast_index_view" || $_SERVER ["SCRIPT_URL"]== "/podcast_manage_view" || $_SERVER ["SCRIPT_URL"]== "/podcast_list" || $_SERVER ["SCRIPT_URL"]== "/episode_index_view" || $_SERVER ["SCRIPT_URL"]== "/episode_manage_view" || $_SERVER ["SCRIPT_URL"]== "/book_index_view" || $_SERVER ["SCRIPT_URL"]== "/book_manage_view" )  : 
    ?>
 <form class="form-search" method="Get" action="<?= $_SERVER['SCRIPT_URL'] ?>">
     <div class="search-filter-area">
         <div class="search-bar">
             <input type="text" name="search" placeholder="Search podcasts by name, tag, or speaker..." class="search-input">
             <button class="search-button"  name="submit">Search</button>
         </div>
         <div class="filter-options">
             <select class="filter-select" name="category" >
                 <option value="all" <?= ($_GET['filter'] ?? 'all') === 'all' ? 'selected' : '' ?>>All Categories</option>
                 <?php foreach ($allCategories as $category): ?>
                     <option value="<?= htmlspecialchars($category['category_id']) ?>"
                         <?= ($_GET['filter'] ?? '') == $category['category_id'] ? 'selected' : '' ?>>
                         <?= htmlspecialchars($category['name']) ?>
                     </option>
                 <?php endforeach; ?>
             </select>

             <!-- <select class="filter-select">
                 <option value="">Sort By</option>
                 <option value="popularity">Popularity</option>
                 <option value="trending">Trending</option>
                 <option value="newest">Newest</option>
             </select> -->
         </div>
     </div>
 </form>
 <!-- <?php //elseif($_SERVER ["SCRIPT_URL"]== "/user_managment_view") : 
        ?>

                     <div class="search-filter-area">
                    <div class="search-bar">
                        <input type="text" placeholder="Search users..." class="search-input">
                        <button class="search-button"><i class="fas fa-search"></i> Search</button>
                    </div>
                    <div class="filter-sort-options">
                        <select class="filter-select">
                            <option value="">All Roles</option>
                            <option value="listener">Listener</option>
                            <option value="creator">Creator</option>
                            <option value="admin">Admin</option>
                        </select>
                         <select class="filter-select">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="banned">Banned</option>
                        </select>
                         <select class="filter-select">
                            <option value="">Sort By</option>
                            <option value="registration-date">Registration Date</option>
                            <option value="username">Username</option>
                            <option value="email">Email</option>
                        </select>
                    </div>
                </div>

                  <?php //elseif($_SERVER ["SCRIPT_URL"]== "/book_index_view" || $_SERVER ["SCRIPT_URL"]== "/book_manage_view" ) : 
                    ?>
                    <div class="search-filter-area">
                    <div class="search-bar">
                        <input type="text" placeholder="Search books by title, author, or topic..." class="search-input">
                        <button class="search-button">Search</button>
                    </div>
                    <div class="filter-options">
                        <select class="filter-select">
                            <option value="">All Genres</option>
                            <option value="fiction">Fiction</option>
                            <option value="non-fiction">Non-Fiction</option>
                            <option value="mystery">Mystery</option>
                            </select>
                        </div>
                </div>

                    <?php // endif 
                    ?> -->