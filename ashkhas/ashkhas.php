<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست اشخاص</title>
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
            <h2 class="text-2xl font-bold mb-4">لیست اشخاص</h2>

             <?php
                // نمایش پیام
                if (isset($_GET['message'])) {
                    echo '<div class="bg-green-200 text-green-800 p-3 rounded mb-4">' . htmlspecialchars($_GET['message']) . '</div>';
                }
            ?>

            <div class="bg-white shadow-md rounded my-6">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-right">نام</th>
                            <th class="py-3 px-6 text-right">نام خانوادگی</th>
                            <th class="py-3 px-6 text-right">شماره تلفن</th>
                            <th class="py-3 px-6 text-right">آدرس</th>
                            <th class="py-3 px-6 text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php
                            // اتصال به پایگاه داده
                            include '../database.php';

                            // Query برای دریافت اطلاعات اشخاص
                            $sql = "SELECT * FROM ashkhas";
                            $result = executeQuery($sql);

                            // نمایش اطلاعات اشخاص
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>";
                                    echo "<td class='py-3 px-6 text-right'>" . $row["name"] . "</td>";
                                    echo "<td class='py-3 px-6 text-right'>" . $row["family"] . "</td>";
                                    echo "<td class='py-3 px-6 text-right'>" . $row["phone"] . "</td>";
                                    echo "<td class='py-3 px-6 text-right'>" . $row["address"] . "</td>";
                                    echo "<td class='py-3 px-6 text-center'>";
                                    echo "<a href='edit_shakhs.php?id=" . $row["id"] . "' class='text-blue-500 hover:text-blue-700 mr-2'><i class='fas fa-edit'></i></a>";
                                    echo "<a href='delete_shakhs.php?id=" . $row["id"] . "' class='text-red-500 hover:text-red-700'><i class='fas fa-trash-alt'></i></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='py-3 px-6 text-center'>هیچ شخصی یافت نشد.</td></tr>";
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