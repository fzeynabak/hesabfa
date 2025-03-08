<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hesabfa - برنامه حسابداری</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="bg-gray-100">

    <!-- Sidebar Toggle Button (Mobile Only) -->
    <div class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </div>

    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white" id="sidebar">
            <div class="p-4">
                <h1 class="text-2xl font-bold">Hesabfa</h1>
            </div>
            <nav>
                <ul class="p-4">
                    <li class="mb-2"><a href="/hesabfa/dashboard/index.php"><i class="fas fa-tachometer-alt ml-2"></i>
                            داشبورد</a></li>
                    <li class="mb-2">
                        <a href="#"><i class="fas fa-users ml-2"></i> اشخاص</a>
                        <ul class="submenu">
                            <li><a href="/hesabfa/ashkhas/shakhs_jadid.php"><i class="fas fa-plus ml-2"></i> شخص جدید</a>
                            </li>
                            <li><a href="/hesabfa/ashkhas/ashkhas.php"><i class="fas fa-list ml-2"></i> اشخاص</a></li>
                            <li><a href="/hesabfa/ashkhas/categories.php"><i class="fas fa-list ml-2"></i> دسته بندی ها</a>
                            </li>
                        </ul>
                    </li>
                    <li class="mb-2">
                        <a href="#"><i class="fas fa-box-open ml-2"></i> کالاها و خدمات</a>
                        <ul class="submenu">
                            <li><a href="/hesabfa/kala_khadamat/mahsul_jadid.php"><i class="fas fa-plus ml-2"></i> محصول
                                    جدید</a></li>
                            <li><a href="/hesabfa/kala_khadamat/fehrest_mahsolat.php"><i class="fas fa-list ml-2"></i> فهرست
                                    محصولات</a></li>
                            <li><a href="/hesabfa/kala_khadamat/khadamat_jadid.php"><i class="fas fa-plus ml-2"></i> خدمات
                                    جدید</a></li>
                            <li><a href="/hesabfa/kala_khadamat/fehrest_khadamat.php"><i class="fas fa-list ml-2"></i> فهرست
                                    خدمات</a></li>
                            <li><a href="/hesabfa/kala_khadamat/update_ghimat.php"><i class="fas fa-sync ml-2"></i>
                                    به‌روزرسانی لیست قیمت محصولات</a></li>
                            <li><a href="/hesabfa/kala_khadamat/update_ghimat.php"><i class="fas fa-sync ml-2"></i>
                                    به‌روزرسانی لیست قیمت خدمات</a></li>
                            <li><a href="#"><i class="fas fa-barcode ml-2"></i> چاپ بارکد</a></li>
                        </ul>
                    </li>
                    <li class="mb-2">
                        <a href="#"><i class="fas fa-money-bill ml-2"></i> فروش و درآمد</a>
                        <ul class="submenu">
                            <li><a href="/hesabfa/forosh_daramad/forosh_jadid.php"><i class="fas fa-plus ml-2"></i> فروش
                                    جدید</a></li>
                            <li><a href="/hesabfa/forosh_daramad/factore_sريع.php"><i class="fas fa-bolt ml-2"></i> فاکتور
                                    سریع</a></li>
                            <li><a href="/hesabfa/forosh_daramad/bargesht_az_forosh.php"><i class="fas fa-undo ml-2"></i>
                                    برگشت از فروش</a></li>
                            <li><a href="/hesabfa/forosh_daramad/factorehaye_forosh.php"><i class="fas fa-file-invoice ml-2"></i>
                                    فاکتورهای فروش</a></li>
                            <li><a href="/hesabfa/forosh_daramad/factorehaye_bargasht_az_forosh.php"><i
                                        class="fas fa-file-invoice ml-2"></i> فاکتورهای برگشت از فروش</a></li>
                            <li><a href="/hesabfa/forosh_daramad/daramad.php"><i class="fas fa-money-bill-alt ml-2"></i>
                                    درآمد</a></li>
                            <li><a href="/hesabfa/forosh_daramad/liste_daramadha.php"><i class="fas fa-list ml-2"></i> لیست
                                    درآمدها</a></li>
                            <li><a href="/hesabfa/forosh_daramad/gharadad_forosh_aghsati.php"><i
                                        class="fas fa-file-contract ml-2"></i> قرارداد فروش اقساطی</a></li>
                            <li><a href="/hesabfa/forosh_daramad/liste_forosh_aghsati.php"><i class="fas fa-list ml-2"></i>
                                    لیست فروش اقساطی</a></li>
                            <li><a href="/hesabfa/forosh_daramad/aghlam_takhfif_dar.php"><i class="fas fa-percent ml-2"></i>
                                    اقلام تخفیف‌دار</a></li>
                        </ul>
                    </li>
                    <li class="mb-2">
                        <a href="#"><i class="fas fa-shopping-cart ml-2"></i> خرید و هزینه</a>
                        <ul class="submenu">
                            <li><a href="/hesabfa/kharid_hazine/kharid_jadid.php"><i class="fas fa-plus ml-2"></i> خرید
                                    جدید</a></li>
                            <li><a href="/hesabfa/kharid_hazine/bargasht_az_kharid.php"><i class="fas fa-undo ml-2"></i>
                                    برگشت از خرید</a></li>
                            <li><a href="/hesabfa/kharid_hazine/factorehaye_kharid.php"><i
                                        class="fas fa-file-invoice ml-2"></i> فاکتورهای خرید</a></li>
                            <li><a href="/hesabfa/kharid_hazine/factorehaye_bargasht_az_kharid.php"><i
                                        class="fas fa-file-invoice ml-2"></i> فاکتورهای برگشت از خرید</a></li>
                            <li><a href="/hesabfa/kharid_hazine/hazine.php"><i class="fas fa-money-bill-alt ml-2"></i>
                                    هزینه</a></li>
                            <li><a href="/hesabfa/kharid_hazine/liste_hazineha.php"><i class="fas fa-list ml-2"></i> لیست
                                    هزینه‌ها</a></li>
                            <li><a href="/hesabfa/kharid_hazine/zayeat.php"><i class="fas fa-trash-alt ml-2"></i>
                                    ضایعات</a></li>
                            <li><a href="/hesabfa/kharid_hazine/liste_zayeat.php"><i class="fas fa-list ml-2"></i> لیست
                                    ضایعات</a></li>
                        </ul>
                    </li>
                    <li class="mb-2">
                        <a href="#"><i class="fas fa-warehouse ml-2"></i> انبارداری</a>
                        <ul class="submenu">
                            <li><a href="/hesabfa/anbardari/anbarha.php"><i class="fas fa-boxes ml-2"></i> انبارها</a></li>
                            <li><a href="/hesabfa/anbardari/havale_jadid.php"><i class="fas fa-truck-loading ml-2"></i>
                                    حواله جدید</a></li>
                            <li><a href="/hesabfa/anbardari/resid_havalehaye_anbar.php"><i class="fas fa-file-alt ml-2"></i>
                                    رسید و حواله‌های انبار</a></li>
                            <li><a href="/hesabfa/anbardari/mojoodi_kala.php"><i class="fas fa-box ml-2"></i> موجودی
                                    کالا</a></li>
                            <li><a href="/hesabfa/anbardari/mojoodi_tamami_anbarha.php"><i class="fas fa-boxes ml-2"></i>
                                    موجودی تمامی انبارها</a></li>
                            <li><a href="/hesabfa/anbardari/anbargardani.php"><i class="fas fa-clipboard-check ml-2"></i>
                                    انبارگردانی</a></li>
                        </ul>
                    </li>
                    <li class="mb-2"><a href="/hesabfa/gozareshha/index.php"><i class="fas fa-chart-bar ml-2"></i>
                            گزارش‌ها</a></li>
                    <li class="mb-2"><a href="/hesabfa/tanzimat/index.php"><i class="fas fa-cog ml-2"></i>
                            تنظیمات</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4">
            <?php
            if (isset($_GET['message'])) {
                echo '<div class="bg-green-200 text-green-800 p-3 rounded mb-4">' . htmlspecialchars($_GET['message']) . '</div>';
            }
            ?>
            <h2 class="text-2xl font-bold mb-4">داشبورد</h2>
            <p>به برنامه حسابداری خود خوش آمدید!</p>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }

        document.addEventListener("DOMContentLoaded", function () {
            const menuItems = document.querySelectorAll('#sidebar li');

            menuItems.forEach(item => {
                if (item.querySelector('.submenu')) {
                    item.addEventListener('click', function (e) {
                        e.stopPropagation();
                        this.classList.toggle('active');
                        this.querySelector('.submenu').style.display = this.classList.contains('active') ? 'block' : 'none';
                    });
                }
            });

            var currentPage = window.location.pathname;
            var menuLinks = document.querySelectorAll("#sidebar a");

            for (var i = 0; i < menuLinks.length; i++) {
                var link = menuLinks[i];
                var linkPath = link.getAttribute('href');

                if (linkPath === currentPage) {
                    link.classList.add("active-menu");
                }
            }
        });
    </script>

</body>

</html>