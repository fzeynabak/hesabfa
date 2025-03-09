<?php
$page = '/hesabfa/person/add_person.php';
include '../index.php';
?>

<!-- حذف CDN تیلویند و استفاده از نسخه محلی -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/main.js" defer></script>

<div class="flex-1 p-4">
    <h2 class="text-2xl font-bold mb-4">شخص جدید</h2>
    <form action="save_person.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

        <!-- قسمت بالای صفحه -->
        <div class="flex">
            <div class="w-3/4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="code_hesabdari">
                            کد حسابداری:
                        </label>
                        <!-- قسمت تولید کد حسابداری را به این صورت تغییر دهید -->
                        <div class="flex">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ml-2" 
                                   id="code_hesabdari" 
                                   name="code_hesabdari" 
                                   type="text" 
                                   placeholder="کد حسابداری را وارد کنید">
                            <button type="button" 
                                    onclick="generateCode()" 
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    <i class="fas fa-sync-alt ml-1"></i>
                                    تولید
                            </button>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="company">
                            شرکت:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company" name="company" type="text" placeholder="شرکت">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                            عنوان:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" type="text" placeholder="عنوان">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            نام:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" type="text" placeholder="نام">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="family">
                            نام خانوادگی:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="family" name="family" type="text" placeholder="نام خانوادگی">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nickname">
                            نام مستعار:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nickname" name="nickname" type="text" placeholder="نام مستعار">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            نوع:
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_customer" value="1">
                            <span class="ml-2 text-gray-700">مشتری</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_supplier" value="1">
                            <span class="ml-2 text-gray-700">تامین کننده</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_employee" value="1">
                            <span class="ml-2 text-gray-700">کارمند</span>
                        </label>
                    </div>

                    <!-- بخش جدید: انتخاب دسته‌بندی‌ها -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            دسته‌بندی‌ها:
                        </label>
                        <div class="flex flex-wrap gap-2" id="personCategories">
                            <!-- دسته‌بندی‌های انتخاب شده اینجا نمایش داده می‌شوند -->
                        </div>
                        <input type="hidden" id="categoryIds" name="category_ids" value="">
                        <button type="button" 
                                onclick="openCategoryModal()" 
                                class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            <i class="fas fa-tags ml-1"></i>
                            انتخاب دسته‌بندی‌ها
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="w-1/4">
                <!-- تصویر شخص -->
                <div class="image-upload">
                    <label for="file-input">
                        <div class="image-preview">
                            <img id="imagePreview" src="../uploads/default-image/default person.png" alt="تصویر شخص" />
                        </div>
                    </label>
                    <div class="image-edit">
                        <input type='file' id="file-input" name="person_image" accept=".png, .jpg, .jpeg" />
                        <label for="file-input"></label>
                    </div>
                </div>
            </div>
        </div>

        <!-- تب‌ها -->
        <div class="mt-8">
            <div class="border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                    <li class="mr-2">
                        <button type="button" class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'general')">
                            <i class="fas fa-info-circle ml-2"></i>
                            عمومی
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'address')">
                            <i class="fas fa-map-marker-alt ml-2"></i>
                            اطلاعات آدرس
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'contact')">
                            <i class="fas fa-phone ml-2"></i>
                            اطلاعات تماس
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'bank')">
                            <i class="fas fa-university ml-2"></i>
                            حساب بانکی
                        </button>
                    </li>
                    <li class="mr-2">
                        <button type="button" class="tablinks inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group" onclick="openTab(event, 'other')">
                            <i class="fas fa-ellipsis-h ml-2"></i>
                            سایر
                        </button>
                    </li>
                </ul>
            </div>

            <!-- محتوای تب ها -->
            <div id="general" class="tab-content p-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="credit">
                            اعتبار مالی:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="credit" name="credit" type="text" placeholder="اعتبار مالی">
                        <span>ریال</span>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="price_list">
                            لیست قیمت:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price_list" name="price_list" type="text" placeholder="لیست قیمت">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tax_type">
                            نوع مالیات:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tax_type" name="tax_type" type="text" placeholder="نوع مالیات">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tax_registration">
                            مودی مشمول ثبت نام در نظام مالیاتی:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tax_registration" name="tax_registration" type="text" placeholder="مودی مشمول ثبت نام در نظام مالیاتی">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="shenase_meli">
                            شناسه ملی:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shenase_meli" name="shenase_meli" type="text" placeholder="شناسه ملی">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="code_eghtesadi">
                            کد اقتصادی:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="code_eghtesadi" name="code_eghtesadi" type="text" placeholder="کد اقتصادی">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="shomare_sabt">
                            شماره ثبت:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shomare_sabt" name="shomare_sabt" type="text" placeholder="شماره ثبت">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="code_shobe">
                            کد شعبه:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="code_shobe" name="code_shobe" type="text" placeholder="کد شعبه">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="tozihat">
                            توضیحات:
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tozihat" name="tozihat" placeholder="توضیحات"></textarea>
                    </div>
                </div>
            </div>

            <!-- محتوای تب اطلاعات آدرس -->
            <div id="address" class="tab-content p-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="address_text">
                            آدرس:
                        </label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="address_text" name="address_text" placeholder="آدرس"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
                            کشور:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="country" name="country" type="text" placeholder="کشور">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="ostan">
                            استان:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="ostan" name="ostan" type="text" placeholder="استان">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="shahr">
                            شهر:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="shahr" name="shahr" type="text" placeholder="شهر">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="codeposti">
                            کدپستی:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="codeposti" name="codeposti" type="text" placeholder="کدپستی">
                    </div>
                </div>
            </div>

            <!-- محتوای تب اطلاعات تماس -->
            <div id="contact" class="tab-content p-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone">
                            تلفن:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone" name="telephone" type="text" placeholder="تلفن">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="mobile">
                            موبایل:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="mobile" name="mobile" type="text" placeholder="موبایل">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fax">
                            فکس:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fax" name="fax" type="text" placeholder="فکس">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone1">
                            تلفن 1:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone1" name="telephone1" type="text" placeholder="تلفن 1">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone2">
                            تلفن 2:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone2" name="telephone2" type="text" placeholder="تلفن 2">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone3">
                            تلفن 3:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone3" name="telephone3" type="text" placeholder="تلفن 3">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            ایمیل:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="ایمیل">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="website">
                            وب سایت:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="website" name="website" type="url" placeholder="وب سایت">
                    </div>
                </div>
            </div>

            <!-- محتوای تب حساب بانکی -->
            <div id="bank" class="tab-content p-4">
                <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-4"><i class="fas fa-plus"></i> افزودن حساب بانکی</button>
                <!-- در اینجا باید اطلاعات حساب بانکی به صورت داینامیک اضافه شود -->

            </div>

            <!-- محتوای تب سایر -->
            <div id="other" class="tab-content p-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="birth_date">
                            تاریخ تولد:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="birth_date" name="birth_date" type="date" placeholder="تاریخ تولد">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="marriage_date">
                            تاریخ ازدواج:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="marriage_date" name="marriage_date" type="date" placeholder="تاریخ ازدواج">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="membership_date">
                            تاریخ عضویت:
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="membership_date" name="membership_date" type="date" placeholder="تاریخ عضویت">
                    </div>
                </div>
            </div>

        </div>

        <div class="flex items-center justify-between mt-4">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                ذخیره
            </button>
        </div>
    </form>
    <?php include '/categories/category_modal.php'; ?>
    <script src="../assets/js/category-manager.js"></script>
</div>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" border-blue-500", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " border-blue-500";
}

function generateCode() {
    // Logic to generate code
}

function openCategoryModal() {
    // Logic to open category modal
}

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("general").style.display = "block";
});

</script>