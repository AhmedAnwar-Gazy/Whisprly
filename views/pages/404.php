<?php http_response_code(404); // مهم لضبط كود الحالة الصحيح ?>
<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="safha_error_container">
    <div class="risala_card">  <?php // تم تغيير اسم الفئة ليعكس المحتوى بشكل أفضل ?>
        <div class="error_code">٤٠٤</div> <?php // فئة خاصة لكود الخطأ ?>
        <h1>عفوًا! الصفحة غير موجودة</h1>
        <p>
            نأسف، الصفحة التي تبحث عنها غير موجودة. ربما تم نقلها أو حذفها.
        </p>
        <a href="/">العودة إلى الرئيسية</a>
    </div>
</main>

<?php require('views/partials/footer.php') ?>