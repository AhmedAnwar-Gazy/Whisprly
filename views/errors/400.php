<?php http_response_code(400); // مهم لضبط كود الحالة الصحيح ?>
<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="safha_error_container">
    <div class="risala_card">
        <div class="error_code">٤٠٠</div>
        <h1>طلب سيء</h1>
        <p>
            عفوًا، لم يتمكن الخادم من فهم طلبك بسبب صياغة غير صحيحة أو بيانات غير صالحة.
        </p>
        <a href="/">العودة إلى الرئيسية</a>
    </div>
</main>

<?php require('views/partials/footer.php') ?>