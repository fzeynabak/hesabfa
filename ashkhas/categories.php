<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت دسته‌بندی‌ها</title>
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
            <h2 class="text-2xl font-bold mb-4">مدیریت دسته‌بندی‌ها</h2>

            <!-- فرم افزودن دسته‌بندی -->
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h3 class="text-xl font-bold mb-2">افزودن دسته‌بندی جدید</h3>
                <form action="save_category.php" method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category_name">
                            نام دسته‌بندی:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category_name" name="category_name" type="text" placeholder="نام دسته‌بندی">
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            ذخیره
                        </button>
                    </div>
                </form>
            </div>

            <!-- لیست دسته‌بندی‌ها -->
            <div class="bg-white shadow-md rounded my-6">
                <h3 class="text-xl font-bold mb-2">لیست دسته‌بندی‌ها</h3>
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-right">نام دسته‌بندی</th>
                            <th class="py-3 px-6 text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php
                            // اتصال به پایگاه داده
                            include '../database.php';

                            // Query برای دریافت اطلاعات دسته‌بندی‌ها
                            $sql = "SELECT * FROM categories";
                            $result = executeQuery($sql);

                            // نمایش اطلاعات دسته‌بندی‌ها
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>";
                                    echo "<td class='py-3 px-6 text-right'>" . $row["category_name"] . "</td>";
                                    echo "<td class='py-3 px-6 text-center'>";
                                    echo "<a href='edit_category.php?id=" . $row["id"] . "' class='text-blue-500 hover:text-blue-700 mr-2'><i class='fas fa-edit'></i></a>";
                                    echo "<a href='delete_category.php?id=" . $row["id"] . "' class='text-red-500 hover:text-red-700'><i class='fas fa-trash-alt'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2' class='py-3 px-6 text-center'>هیچ دسته‌بندی یافت نشد.</td></tr>";
                            }

                            // بستن اتصال
                            closeConnection();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>