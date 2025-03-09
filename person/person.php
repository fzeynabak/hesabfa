<?php
$page = '/hesabfa/person/person.php';
include '../index.php';

// اتصال به پایگاه داده
include '../database.php';

// دریافت لیست افراد
$sql = "SELECT * FROM persons ORDER BY id DESC";
$result = executeQuery($sql);
?>

<div class="flex-1 p-4">
    <h2 class="text-2xl font-bold mb-4">لیست افراد</h2>
    
    <?php if (isset($_GET['message'])): ?>
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            <?php echo htmlspecialchars($_GET['message']); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                    <th class="py-3 px-6 text-right">کد حسابداری</th>
                    <th class="py-3 px-6 text-right">شرکت</th>
                    <th class="py-3 px-6 text-right">عنوان</th>
                    <th class="py-3 px-6 text-right">نام</th>
                    <th class="py-3 px-6 text-right">نام خانوادگی</th>
                    <th class="py-3 px-6 text-right">نام مستعار</th>
                    <th class="py-3 px-6 text-right">دسته‌بندی</th>
                    <th class="py-3 px-6 text-right">نوع</th>
                    <th class="py-3 px-6 text-right">اعتبار مالی</th>
                    <th class="py-3 px-6 text-right">تلفن</th>
                    <th class="py-3 px-6 text-right">موبایل</th>
                    <th class="py-3 px-6 text-right">آدرس</th>
                    <th class="py-3 px-6 text-right">عملیات</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['code_hesabdari']); ?></td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['company']); ?></td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['title']); ?></td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['family']); ?></td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['nickname']); ?></td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['category']); ?></td>
                        <td class="py-3 px-6 text-right">
                            <?php
                            $types = [];
                            if ($row['type_customer']) $types[] = 'مشتری';
                            if ($row['type_supplier']) $types[] = 'تامین کننده';
                            if ($row['type_shareholder']) $types[] = 'سهامدار';
                            if ($row['type_employee']) $types[] = 'کارمند';
                            echo htmlspecialchars(implode('، ', $types));
                            ?>
                        </td>
                        <td class="py-3 px-6 text-right"><?php echo number_format($row['credit']); ?> ریال</td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['telephone']); ?></td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['mobile']); ?></td>
                        <td class="py-3 px-6 text-right"><?php echo htmlspecialchars($row['address_text']); ?></td>
                        <td class="py-3 px-6 text-right">
                            <div class="flex item-center justify-end">
                                <a href="edit_person.php?id=<?php echo $row['id']; ?>" class="text-blue-600 hover:text-blue-900 ml-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="delete_person.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-900 ml-2" onclick="return confirm('آیا از حذف این فرد اطمینان دارید؟')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>