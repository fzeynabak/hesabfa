<?php
include '../index.php';
include '../database.php';

if (!isset($_GET['id'])) {
    header('Location: list_categories.php');
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT c1.*, 
        (SELECT name FROM categories WHERE id = c1.parent_id) as parent_name,
        (SELECT COUNT(*) FROM categories WHERE parent_id = c1.id) as subcategories_count,
        (SELECT COUNT(*) FROM person_categories WHERE category_id = c1.id) as persons_count
        FROM categories c1 
        WHERE c1.id = ?";

$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();

if (!$category) {
    header('Location: list_categories.php');
    exit;
}

// دریافت زیردسته‌ها
$subcategories = executeQuery("SELECT * FROM categories WHERE parent_id = $id ORDER BY name ASC");
?>

<div class="flex-1 p-4">
    <div class="max-w-4xl mx-auto">
        <!-- هدر و دکمه‌های عملیات -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">اطلاعات دسته‌بندی</h2>
            <div class="flex gap-2">
                <a href="edit_category.php?id=<?php echo $id; ?>" 
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-edit ml-1"></i>
                    ویرایش
                </a>
                <button onclick="history.back()" 
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-arrow-right ml-1"></i>
                    بازگشت
                </button>
            </div>
        </div>

        <!-- کارت اصلی اطلاعات -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- هدر کارت با تصویر -->
            <div class="relative h-48 bg-gray-100">
                <?php if ($category['image']): ?>
                    <img src="<?php echo htmlspecialchars($category['image']); ?>" 
                         alt="<?php echo htmlspecialchars($category['name']); ?>"
                         class="w-full h-full object-cover">
                <?php else: ?>
                    <div class="flex items-center justify-center h-full">
                        <i class="fas fa-layer-group text-6xl text-gray-400"></i>
                    </div>
                <?php endif; ?>
            </div>

            <!-- اطلاعات اصلی -->
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-800">اطلاعات پایه</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <span class="text-gray-600 ml-2">کد دسته‌بندی:</span>
                                <span class="font-semibold"><?php echo htmlspecialchars($category['code']); ?></span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-gray-600 ml-2">نام دسته‌بندی:</span>
                                <span class="font-semibold"><?php echo htmlspecialchars($category['name']); ?></span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-gray-600 ml-2">دسته‌بندی والد:</span>
                                <span class="font-semibold"><?php echo $category['parent_name'] ? htmlspecialchars($category['parent_name']) : 'ندارد'; ?></span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-gray-600 ml-2">وضعیت:</span>
                                <span class="<?php echo $category['status'] ? 'text-green-600' : 'text-red-600'; ?> font-semibold">
                                    <?php echo $category['status'] ? 'فعال' : 'غیرفعال'; ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-800">آمار</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <div class="text-3xl font-bold text-blue-600 mb-1"><?php echo $category['subcategories_count']; ?></div>
                                <div class="text-sm text-gray-600">زیردسته</div>
                            </div>
                            <div class="bg-green-50 rounded-lg p-4">
                                <div class="text-3xl font-bold text-green-600 mb-1"><?php echo $category['persons_count']; ?></div>
                                <div class="text-sm text-gray-600">شخص مرتبط</div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($category['description']): ?>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold mb-4 text-gray-800">توضیحات</h3>
                        <p class="text-gray-600"><?php echo nl2br(htmlspecialchars($category['description'])); ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($subcategories && $subcategories->num_rows > 0): ?>
                    <div class="mt-6">
                        <h3 class="text-lg font-bold mb-4 text-gray-800">زیردسته‌ها</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <?php while ($sub = $subcategories->fetch_assoc()): ?>
                                <a href="view_category.php?id=<?php echo $sub['id']; ?>" 
                                   class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <i class="fas fa-folder text-yellow-500 ml-2"></i>
                                    <span class="text-gray-700"><?php echo htmlspecialchars($sub['name']); ?></span>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>