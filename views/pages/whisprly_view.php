<?php  require('views/partials/head.php') ?>
<?php  //require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>
<style></style>
<main>
<h1>hello ,<?= $_SESSION['user']['email'] ?? 'no' ?> welcome home</h1>
  <h1>whisprly_home</h1>
  <section>




  </section>
</main>
<main class="main-content-wrapper">
        <section class="container">
            

            <?php for($i=0 ; $i<4 ; $i++){ require('views/partials/side_card.php'); }?> 
      
    </section>
  </main>
<?php require('views/partials/footer.php') ?>