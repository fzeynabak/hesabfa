<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش شخص</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'IranSans', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- محتوای اصلی -->
        <div class="flex-1 p-4">
            <h2 class="text-2xl font-bold mb-4">ویرایش شخص</h2>

            <?php
                // اتصال به پایگاه داده
                include '../database.php';

                // دریافت ID شخص از URL
                $id = $_GET['id'];

                 // نمایش پیام
                if (isset($_GET['message'])) {
                    echo '<div class="bg-red-200 text-red-800 p-3 rounded mb-4">' . htmlspecialchars($_GET['message']) . '</div>';
                }

                // Query برای دریافت اطلاعات شخص
                $sql = "SELECT * FROM ashkhas WHERE id = " . escapeString($id);
                $result = executeQuery($sql);

                // نمایش فرم ویرایش
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
            ?>

            <form action="update_shakhs.php" method="post" class="max-w-md mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                 <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="code">
                        کد/شناسه:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="code" name="code" type="text" placeholder="کد/شناسه" value="<?php echo $row['code']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="company_name">
                        نام شرکت:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_name" name="company_name" type="text" placeholder="نام شرکت"  value="<?php echo $row['company_name']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        نام شخص:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="نام شخص" value="<?php echo $row['name']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="family">
                        نام خانوادگی:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="family" name="family" type="text" placeholder="نام خانوادگی شخص"  value="<?php echo $row['family']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="father_name">
                        نام پدر:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="father_name" name="father_name" type="text" placeholder="نام پدر"  value="<?php echo $row['father_name']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="shenasname">
                        شماره شناسنامه:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shenasname" name="shenasname" type="text" placeholder="شماره شناسنامه"  value="<?php echo $row['shenasname']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="eghtesadi">
                        کد اقتصادی:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="eghtesadi" name="eghtesadi" type="text" placeholder="کد اقتصادی"  value="<?php echo $row['eghtesadi']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="shomare_sabt">
                        شماره ثبت:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shomare_sabt" name="shomare_sabt" type="text" placeholder="شماره ثبت"  value="<?php echo $row['shomare_sabt']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                        تلفن:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="text" placeholder="تلفن"  value="<?php echo $row['phone']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mobile">
                        موبایل:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mobile" name="mobile" type="text" placeholder="موبایل"  value="<?php echo $row['mobile']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fax">
                        فکس:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fax" name="fax" type="text" placeholder="فکس"  value="<?php echo $row['fax']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        ایمیل:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="ایمیل"  value="<?php echo $row['email']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="website">
                        وبسایت:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="website" name="website" type="text" placeholder="وبسایت"  value="<?php echo $row['website']; ?>">
                </div>
                 <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
                        کشور:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="country" name="country" type="text" placeholder="کشور"  value="<?php echo $row['country']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ostan">
                        استان:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ostan" name="ostan" type="text" placeholder="استان"  value="<?php echo $row['ostan']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="shahr">
                        شهر:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shahr" name="shahr" type="text" placeholder="شهر"  value="<?php echo $row['shahr']; ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="codeposti">
                        کد پستی:
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="codeposti" name="codeposti" type="text" placeholder="کد پستی"  value="<?php echo $row['codeposti']; ?>">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                        آدرس:
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address" name="address" placeholder="آدرس"><?php echo $row['address']; ?></textarea>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        ذخیره تغییرات
                    </button>
                </div>
            </form>

            <?php
                } else {
                    echo "<p class='text-red-500'>شخص مورد نظر یافت نشد.</p>";
                }

                // بستن اتصال
                closeConnection();
            ?>

        </div>

    </div>

</body>
</html>