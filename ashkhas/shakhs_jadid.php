<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شخص جدید</title>
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
            <h2 class="text-2xl font-bold mb-4">شخص جدید</h2>
            <form action="save_shakhs.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

                <!-- قسمت بالای صفحه -->
                <div class="flex">
                    <div class="w-3/4">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="code_hesabdari">
                                    کد حسابداری:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="code_hesabdari" name="code_hesabdari" type="text" placeholder="کد حسابداری">
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
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                                    دسته‌بندی:
                                </label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" name="category" type="text" placeholder="دسته‌بندی">
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
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_shareholder" value="1">
                                    <span class="ml-2 text-gray-700">سهامدار</span>
                                </label>
                                 <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600" name="type_employee" value="1">
                                    <span class="ml-2 text-gray-700">کارمند</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/4">
                        <!-- تصویر شخص -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="person_image">
                                تصویر شخص:
                            </label>
                            <img src="https://via.placeholder.com/150" alt="تصویر شخص" class="rounded-full w-32 h-32 mx-auto">
                            <input type="file" class="form-input mt-2" id="person_image" name="person_image">
                        </div>
                    </div>
                </div>

                <!-- تب‌ها -->
                <div class="mt-8">
                    <div class="border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                            <li class="mr-2">
                                <a href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group">
                                    <i class="fas fa-info-circle ml-2"></i>
                                    عمومی
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group">
                                    <i class="fas fa-map-marker-alt ml-2"></i>
                                    اطلاعات آدرس
                                </a>
                            </li>
                             <li class="mr-2">
                                <a href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group">
                                    <i class="fas fa-phone ml-2"></i>
                                    اطلاعات تماس
                                </a>
                            </li>
                             <li class="mr-2">
                                <a href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group">
                                    <i class="fas fa-university ml-2"></i>
                                    حساب بانکی
                                </a>
                            </li>
                            <li class="mr-2">
                                <a href="#" class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group">
                                    <i class="fas fa-ellipsis-h ml-2"></i>
                                    سایر
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        ذخیره
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>