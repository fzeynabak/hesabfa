<?php
// includes/header.php را در اینجا قرار دهید
include('includes/header.php');
?>

<div class="container">
    <h2>افزودن محصول جدید</h2>
    <form action="save_product.php" method="post">
        <div class="form-group">
            <label for="name">نام محصول:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="price">قیمت:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="description">توضیحات:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-success">ذخیره</button>
    </form>
</div>

<?php
// includes/footer.php را در اینجا قرار دهید
include('includes/footer.php');
?>