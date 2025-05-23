<?php require('views/partials/head.php') ?>
  <?php require('views/partials/nav.php') ?>


  <main>

<?php
$messages = [
    'error' => $erorrs ?? ["البريد الالكتروني أو كلمة المرور غير صحيحة"],
    'success' => $success ?? ["تم التسجيل بنجاح. يمكنك الان تسجيل الدخول"], 
    'warning' => $warning ?? ["كلمة المرور وتأكيد كلمة المرور غير متطابقين يرجى التحقق"], 
    'info' => $info ?? ["يرجى قبول الشروط والاحكام قبل التسجيل"],    
];

$icons = [
    'error' => '❌',
    'success' => '✅',
    'warning' => '⚠️',
    'info' => 'ℹ️',
];

$colors = [
    'error' => '#d8000c',
    'success' => '#4BB543',
    'warning' => '#ff9b00',
    'info' => '#00529B',
];

  foreach ($messages as $type => $msgs):
    if (!empty($msgs)):
  ?>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img class="mx-auto h-10 w-auto" src="" alt="Your Company">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Log In</h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-4" action="/login" method="POST">
          <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address :</label>
            <div class="mt-2">
              <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            </div>
          </div>
          <div class="flex items-center justify-between text-red-500 text-sm/6">
            <?= $erorrs["email"] ?? " " ?>
          </div>

          <div>
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password :</label>
            <div class="mt-2">
              <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
            </div>
          </div>

          <div class="flex items-center justify-between text-red-500 text-sm/6">
            <?= $erorrs["password"] ?? " " ?>
          </div>

          <div class="mt-6">
            <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">register</button>
          </div>
        </form>

      </div>
    </div>



    <div class="overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 999;"></div>

    <div class="popup" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px 30px; border-radius: 12px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); z-index: 1000; max-width: 600px; animation: fadeIn 0.4s ease; text-align: right; direction: rtl;">
        <button onclick="closePopup()" class="close-btn">&times;</button>

        <h2 style="color: <?= $colors[$type] ?>; font-size: 24px; margin-bottom: 10px;">
            <span style="margin-left: 8px;"></span>
        </h2>

        <ul style="color: #333; font-size: 16px; padding-left: 0; list-style: none;">
            <?php foreach ($msgs as $msg): ?>
                <li style="margin-bottom: 10px;">
                    <span style="color: <?= $colors[$type] ?>; font-weight: bold; margin-left: 8px;"><?= $icons[$type] ?></span>
                    <?= htmlspecialchars($msg) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -60%); }
            to   { opacity: 1; transform: translate(-50%, -50%); }
        }

        .close-btn {
            position: absolute;
            top: 10px;
            left: 10px; 
            background-color: #333;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
            z-index: 1001;
            transition: background-color 0.3s;
        }

        .close-btn:hover {
            background-color: #555;
        }
    </style>

    <script>
        function closePopup() {
            document.querySelector('.popup').style.display = 'none';
            document.querySelector('.overlay').style.display = 'none';
        }
    </script>
<?php
    break;
    endif;
endforeach;
?>

<!-- مربع التحقق 
<div class="otp-box" style="background-color: #fff; padding: 25px 30px; border-radius: 12px; box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2); max-width: 400px; text-align: center; margin-top: 30px;">
    <div style="font-size: 22px; font-weight: bold; margin-bottom: 10px;">تسجيل الدخول</div>
    <p style="font-size: 14px; color: #555;">تم إرسال رمز التحقق لإكمال العملية. لقد تم إرسال رمز التحقق في رسالة لكم</p>

    <form action="/verify" method="POST" style="margin-top: 20px;">
        <div style="display: flex; justify-content: center; gap: 8px; margin-bottom: 15px;">
            <?php for ($i = 0; $i < 6; $i++): ?>
                <input type="text" name="otp[]" maxlength="1" required
                       style="width: 40px; height: 45px; text-align: center; font-size: 18px; border: 1px solid #ccc; border-radius: 6px;" 
                       oninput="moveToNext(this, <?= $i ?>)">


<?php endfor; ?>
        </div>
        <button type="submit" style="background-color: #00cfe8; color: white; padding: 10px 20px; border: none; border-radius: 8px; font-size: 16px;">تحقق</button>
        <div style="margin-top: 10px; font-size: 13px; color: #999;">يمكنك إعادة الإرسال بعد <span id="resend-timer">00:30</span></div>
    </form>
</div>
*/ 
-->
<!--
<script>
    function moveToNext(elem, index) {
        const inputs = document.querySelectorAll("input[name='otp[]']");
        if (elem.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    }

    // Timer countdown
    let seconds = 30;
    const timerEl = document.getElementById("resend-timer");
    const timerInterval = setInterval(() => {
        if (seconds <= 0) {
            clearInterval(timerInterval);
            timerEl.textContent = "يمكنك الآن إعادة الإرسال";
        } else {
            const s = seconds < 10 ? 0${seconds} : seconds;
            timerEl.textContent = 00:${s};
            seconds--;
        }
    }, 1000);
</script>
-->


  </main>


  <?php require('views/partials/footer.php') ?>