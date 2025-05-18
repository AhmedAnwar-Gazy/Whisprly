<?php http_response_code(403); // مهم لضبط كود الحالة الصحيح ?>
<?php  require('views/partials/head.php') ?>
<?php  require('views/partials/nav.php') ?>
<?php require('views/partials/header.php') ?>

<main class="safha_error_container">
    <div class="risala_card">
        <div class="error_code">٤٠٣</div>
        <h1>ممنوع الوصول</h1>
        <p>
            عفوًا، ليس لديك الإذن اللازم للوصول إلى هذه الصفحة أو المصدر.
        </p>
        <a href="/">العودة إلى الرئيسية</a>
    </div>
</main>

<?php require('views/partials/footer.php') ?>