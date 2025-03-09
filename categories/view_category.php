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

<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white" id="sidebar">
        <div class="p-4">
            <h1 class="text-2xl font-bold">حسابفا</h1>
        </div>
        <nav>
            <ul class="p-4">
                <li class="mb-2"><a href="/hesabfa/dashboard/index.php"><i class="fas fa-tachometer-alt ml-2"></i> داشبورد</a></li>
                <li class="mb-2">
                    <a href="#"><i class="fas fa-users ml-2"></i> اشخاص</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/person/add_person.php"><i class="fas fa-plus ml-2"></i> فرد جدید</a></li>
                        <li><a href="/hesabfa/person/person.php"><i class="fas fa-list ml-2"></i> افراد</a></li>
                    </ul>
                </li>
                <li class="mb-2">
                    <a href="#"><i class="fas fa-layer-group ml-2"></i> دسته&zwnj;بندی&zwnj;ها</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/categories/add_category.php"><i class="fas fa-plus ml-2"></i> دسته&zwnj;بندی جدید</a></li>
                        <li><a href="/hesabfa/categories/list_categories.php"><i class="fas fa-list ml-2"></i> لیست دسته&zwnj;بندی&zwnj;ها</a></li>
                    </ul>
                </li>
                <li class="mb-2">
                    <a href="#"><i class="fas fa-box-open ml-2"></i> کالاها و خدمات</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/products_services/add_product.php"><i class="fas fa-plus ml-2"></i> محصول جدید</a></li>
                        <li><a href="/hesabfa/products_services/products_list.php"><i class="fas fa-list ml-2"></i> فهرست محصولات</a></li>
                        <li><a href="/hesabfa/products_services/add_service.php"><i class="fas fa-plus ml-2"></i> خدمات جدید</a></li>
                        <li><a href="/hesabfa/products_services/services_list.php"><i class="fas fa-list ml-2"></i> فهرست خدمات</a></li>
                        <li><a href="/hesabfa/products_services/update_product_prices.php"><i class="fas fa-sync ml-2"></i> به&zwnj;روزرسانی لیست قیمت محصولات</a></li>
                        <li><a href="/hesabfa/products_services/update_service_prices.php"><i class="fas fa-sync ml-2"></i> به&zwnj;روزرسانی لیست قیمت خدمات</a></li>
                        <li><a href="/hesabfa/products_services/print_barcode.php"><i class="fas fa-barcode ml-2"></i> چاپ بارکد</a></li>
                    </ul>
                </li>
                <li class="mb-2">
                    <a href="#"><i class="fas fa-money-bill ml-2"></i> فروش و درآمد</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/sales_income/add_sale.php"><i class="fas fa-plus ml-2"></i> فروش جدید</a></li>
                        <li><a href="/hesabfa/sales_income/quick_invoice.php"><i class="fas fa-bolt ml-2"></i> فاکتور سریع</a></li>
                        <li><a href="/hesabfa/sales_income/return_sale.php"><i class="fas fa-undo ml-2"></i> برگشت از فروش</a></li>
                        <li><a href="/hesabfa/sales_income/sale_invoices.php"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای فروش</a></li>
                        <li><a href="/hesabfa/sales_income/return_sale_invoices.php"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای برگشت از فروش</a></li>
                        <li><a href="/hesabfa/sales_income/income.php"><i class="fas fa-money-bill-alt ml-2"></i> درآمد</a></li>
                        <li><a href="/hesabfa/sales_income/income_list.php"><i class="fas fa-list ml-2"></i> لیست درآمدها</a></li>
                        <li><a href="/hesabfa/sales_income/installment_contract.php"><i class="fas fa-file-contract ml-2"></i> قرارداد فروش اقساطی</a></li>
                        <li><a href="/hesabfa/sales_income/installment_list.php"><i class="fas fa-list ml-2"></i> لیست فروش اقساطی</a></li>
                        <li><a href="/hesabfa/sales_income/discounted_items.php"><i class="fas fa-percent ml-2"></i> اقلام تخفیف&zwnj;دار</a></li>
                    </ul>
                </li>
                <li class="mb-2">
                    <a href="#"><i class="fas fa-shopping-cart ml-2"></i> خرید و هزینه</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/purchase_expense/add_purchase.php"><i class="fas fa-plus ml-2"></i> خرید جدید</a></li>
                        <li><a href="/hesabfa/purchase_expense/return_purchase.php"><i class="fas fa-undo ml-2"></i> برگشت از خرید</a></li>
                        <li><a href="/hesabfa/purchase_expense/purchase_invoices.php"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای خرید</a></li>
                        <li><a href="/hesabfa/purchase_expense/return_purchase_invoices.php"><i class="fas fa-file-invoice ml-2"></i> فاکتورهای برگشت از خرید</a></li>
                        <li><a href="/hesabfa/purchase_expense/expense.php"><i class="fas fa-money-bill-alt ml-2"></i> هزینه</a></li>
                        <li><a href="/hesabfa/purchase_expense/expense_list.php"><i class="fas fa-list ml-2"></i> لیست هزینه&zwnj;ها</a></li>
                        <li><a href="/hesabfa/purchase_expense/waste.php"><i class="fas fa-trash-alt ml-2"></i> ضایعات</a></li>
                        <li><a href="/hesabfa/purchase_expense/waste_list.php"><i class="fas fa-list ml-2"></i> لیست ضایعات</a></li>
                    </ul>
                </li>
                <li class="mb-2">
                    <a href="#"><i class="fas fa-warehouse ml-2"></i> انبارداری</a>
                    <ul class="submenu">
                        <li><a href="/hesabfa/warehouse/warehouses.php"><i class="fas fa-boxes ml-2"></i> انبارها</a></li>
                        <li><a href="/hesabfa/warehouse/add_transfer.php"><i class="fas fa-truck-loading ml-2"></i> حواله جدید</a></li>
                        <li><a href="/hesabfa/warehouse/warehouse_documents.php"><i class="fas fa-file-alt ml-2"></i> رسید و حواله&zwnj;های انبار</a></li>
                        <li><a href="/hesabfa/warehouse/product_inventory.php"><i class="fas fa-box ml-2"></i> موجودی کالا</a></li>
                        <li><a href="/hesabfa/warehouse/all_warehouses_inventory.php"><i class="fas fa-boxes ml-2"></i> موجودی تمامی انبارها</a></li>
                        <li><a href="/hesabfa/warehouse/stocktaking.php"><i class="fas fa-clipboard-check ml-2"></i> انبارگردانی</a></li>
                    </ul>
                </li>
                <li class="mb-2"><a href="/hesabfa/reports/index.php"><i class="fas fa-chart-bar ml-2"></i> گزارش&zwnj;ها</a></li>
                <li class="mb-2"><a href="/hesabfa/settings/index.php"><i class="fas fa-cog ml-2"></i> تنظیمات</a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
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
</div>