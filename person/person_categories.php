<?php
include '../database.php';

// دریافت پیام خطا یا موفقیت (اگر وجود داشته باشد)
$message = isset($_GET['message']) ? $_GET['message'] : '';

// نمایش پیام
if (!empty($message)) {
    echo "<div class='alert alert-info'>$message</div>";
}

// دریافت لیست دسته‌بندی‌ها
$sql = "SELECT * FROM categories ORDER BY parent_id, id";
$result = executeQuery($sql);

// تبدیل نتایج به آرایه
$categories = array();
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت دسته‌بندی‌ها</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container mt-4">
        <h2>مدیریت دسته‌بندی‌ها</h2>

        <!-- فرم افزودن دسته‌بندی جدید -->
        <div class="card mb-4">
            <div class="card-header">
                افزودن دسته‌بندی جدید
            </div>
            <div class="card-body">
                <form action="save_category.php" method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="title" class="form-label">عنوان دسته‌بندی *</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-4">
                            <label for="parent_id" class="form-label">دسته‌بندی والد</label>
                            <select class="form-select" id="parent_id" name="parent_id">
                                <option value="0">دسته‌بندی اصلی</option>
                                <?php
                                foreach ($categories as $category) {
                                    echo "<option value='{$category['id']}'>{$category['title']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary d-block">افزودن دسته‌بندی</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- جدول نمایش دسته‌بندی‌ها -->
        <div class="card">
            <div class="card-header">
                لیست دسته‌بندی‌ها
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>دسته‌بندی والد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($categories as $category) {
                            echo "<tr>";
                            echo "<td>{$category['title']}</td>";
                            echo "<td>";
                            if ($category['parent_id'] > 0) {
                                foreach ($categories as $parent) {
                                    if ($parent['id'] == $category['parent_id']) {
                                        echo $parent['title'];
                                        break;
                                    }
                                }
                            } else {
                                echo "دسته‌بندی اصلی";
                            }
                            echo "</td>";
                            echo "<td>
                                    <a href='edit_category.php?id={$category['id']}' class='btn btn-sm btn-warning'>ویرایش</a>
                                    <a href='delete_category.php?id={$category['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"آیا از حذف این دسته‌بندی اطمینان دارید؟\")'>حذف</a>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
closeConnection();
?>