<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesabfa - برنامه حسابداری</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'IranSans', sans-serif;
        }
        /* استایل های منوی کشویی */
        .dropdown {
            position: relative;
            display: block; /* تغییر به block */
        }

        .dropdown-content {
            display: none;
            position: relative; /* تغییر به relative */
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 0; /* حذف padding */
            z-index: 1;
            right: 0;
            list-style: none; /* حذف استایل لیست */
            margin: 0; /* حذف margin */
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown.show .dropdown-content {
            display: block;
        }

        /* استایل منوی فعال */
        .active-menu {
            background-color: #ddd;
            color: black;
        }
    </style>
    <script>
        function toggleDropdown(element) {
            var dropdownContent = element.nextElementSibling;
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                if (dropdowns[i] !== dropdownContent && dropdowns[i].classList.contains('show')) {
                    dropdowns[i].classList.remove('show');
                }
            }
            dropdownContent.classList.toggle("show");
        }
    </script>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- منوی سمت راست -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Hesabfa</h1>
            </div>
            <nav>
                <ul class="p-4">
                    <li class="mb-2"><a href="dashboard/index.php" class="block hover:bg-gray-700 p-2 rounded"><i class="fas fa-tachometer-alt ml-2"></i> داشبورد</a></li>
                    <li class="mb-2 dropdown">
                        <a href="#" class="block hover:bg-gray-700 p-2 rounded" onclick="toggleDropdown(this)"><i class="fas fa-users ml-2"></i> اشخاص</a>
                        <ul class="dropdown-content">
                            <li><a href="ashkhas/shakhs_jadid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-plus ml-2"></i> شخص جدید</a></li>
                            <li><a href="ashkhas/ashkhas.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-list ml-2"></i> اشخاص</a></li>
                            <li><a href="ashkhas/categories.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-list ml-2"></i> دسته بندی ها</a></li>
                        </ul>
                    </li>
                    <li class="mb-2 dropdown">
                        <a href="#" class="block hover:bg-gray-700 p-2 rounded" onclick="toggleDropdown(this)"><i class="fas fa-box-open ml-2"></i> کالاها و خدمات</a>
                        <ul class="dropdown-content">
                            <li><a href="kala_khadamat/mahsul_jadid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-plus ml-2"></i> محصول جدید</a></li>
                            <li><a href="kala_khadamat/fehrest_mahsolat.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-list ml-2"></i> فهرست محصولات</a></li>
                            <li><a href="kala_khadamat/khadamat_jadid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-plus ml-2"></i> خدمات جدید</a></li>
                            <li><a href="kala_khadamat/fehrest_khadamat.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-list ml-2"></i> فهرست خدمات</a></li>
                            <li><a href="kala_khadamat/update_ghimat.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-sync ml-2"></i> به‌روزرسانی لیست قیمت محصولات</a></li>
                            <li><a href="kala_khadamat/update_ghimat.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-sync ml-2"></i> به‌روزرسانی لیست قیمت خدمات</a></li>
                            <li><a href="#" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-barcode ml-2"></i> چاپ بارکد</a></li>
                        </ul>
                    </li>
                    <li class="mb-2 dropdown">
                        <a href="#" class="block hover:bg-gray-700 p-2 rounded" onclick="toggleDropdown(this)"><i class="fas fa-money-bill ml-2"></i> فروش و درآمد</a>
                        <ul class="dropdown-content">
                            <li><a href="forosh_daramad/forosh_jadid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-plus ml-2"></i> فروش جدید</a></li>
                            <li><a href="forosh_daramad/factore_sريع.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-bolt ml-2"></i> فاکتور سریع</a></li>
                            <li><a href="forosh_daramad/bargesht_az_forosh.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-undo ml-2"></i> برگشت از فروش</a></li>
                            <li><a href="forosh_daramad/factorehaye_forosh.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای فروش</a></li>
                            <li><a href="forosh_daramad/factorehaye_bargasht_az_forosh.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای برگشت از فروش</a></li>
                            <li><a href="forosh_daramad/daramad.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-money-bill-alt ml-2"></i> درآمد</a></li>
                            <li><a href="forosh_daramad/liste_daramadha.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-list ml-2"></i> لیست درآمدها</a></li>
                            <li><a href="forosh_daramad/gharadad_forosh_aghsati.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-file-contract ml-2"></i> قرارداد فروش اقساطی</a></li>
                            <li><a href="forosh_daramad/liste_forosh_aghsati.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-list ml-2"></i> لیست فروش اقساطی</a></li>
                            <li><a href="forosh_daramad/aghlam_takhfif_dar.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-percent ml-2"></i> اقلام تخفیف‌دار</a></li>
                        </ul>
                    </li>
                      <li class="mb-2 dropdown">
                        <a href="#" class="block hover:bg-gray-700 p-2 rounded" onclick="toggleDropdown(this)"><i class="fas fa-shopping-cart ml-2"></i> خرید و هزینه</a>
                        <ul class="dropdown-content">
                            <li><a href="kharid_hazine/kharid_jadid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-plus ml-2"></i> خرید جدید</a></li>
                            <li><a href="kharid_hazine/bargasht_az_kharid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-undo ml-2"></i> برگشت از خرید</a></li>
                            <li><a href="kharid_hazine/factorehaye_kharid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای خرید</a></li>
                            <li><a href="kharid_hazine/factorehaye_bargasht_az_kharid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای برگشت از خرید</a></li>
                            <li><a href="kharid_hazine/hazine.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-money-bill-alt ml-2"></i> هزینه</a></li>
                            <li><a href="kharid_hazine/liste_hazineha.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-list ml-2"></i> لیست هزینه‌ها</a></li>
                            <li><a href="kharid_hazine/zayeat.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-trash-alt ml-2"></i> ضایعات</a></li>
                            <li><a href="kharid_hazine/liste_zayeat.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-list ml-2"></i> لیست ضایعات</a></li>
                        </ul>
                    </li>
                     <li class="mb-2 dropdown">
                        <a href="#" class="block hover:bg-gray-700 p-2 rounded" onclick="toggleDropdown(this)"><i class="fas fa-warehouse ml-2"></i> انبارداری</a>
                        <ul class="dropdown-content">
                            <li><a href="anbardari/anbarha.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-boxes ml-2"></i> انبارها</a></li>
                            <li><a href="anbardari/havale_jadid.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-truck-loading ml-2"></i> حواله جدید</a></li>
                            <li><a href="anbardari/resid_havalehaye_anbar.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-file-alt ml-2"></i> رسید و حواله‌های انبار</a></li>
                            <li><a href="anbardari/mojoodi_kala.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-box ml-2"></i> موجودی کالا</a></li>
                            <li><a href="anbardari/mojoodi_tamami_anbarha.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-boxes ml-2"></i> موجودی تمامی انبارها</a></li>
                            <li><a href="anbardari/anbargardani.php" class="block hover:bg-gray-700 p-2 rounded pr-4"><i class="fas fa-clipboard-check ml-2"></i> انبارگردانی</a></li>
                        </ul>
                    </li>
                    <li class="mb-2"><a href="gozareshha/index.php" class="block hover:bg-gray-700 p-2 rounded"><i class="fas fa-chart-bar ml-2"></i> گزارش‌ها</a></li>
                    <li class="mb-2"><a href="tanzimat/index.php" class="block hover:bg-gray-700 p-2 rounded"><i class="fas fa-cog ml-2"></i> تنظیمات</a></li>
                </ul>
            </nav>
        </div>

        <!-- محتوای اصلی -->
        <div class="flex-1 p-4">
            <?php
                // بررسی کنیم که آیا یک پیام خوش آمدید از طریق GET ارسال شده است یا خیر
                if (isset($_GET['message'])) {
                    echo '<div class="bg-green-200 text-green-800 p-3 rounded mb-4">' . htmlspecialchars($_GET['message']) . '</div>';
                }
            ?>
            <h2 class="text-2xl font-bold mb-4">داشبورد</h2>
            <p>به برنامه حسابداری خود خوش آمدید!</p>
        </div>

    </div>

</body>
</html>