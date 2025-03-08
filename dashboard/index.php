<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>داشبورد</title>
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
            <h2 class="text-2xl font-bold mb-4">داشبورد</h2>
            <p>به داشبورد خوش آمدید!</p>
            <!-- محتوای داشبورد -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded p-4">
                    <h3 class="font-bold text-lg mb-2">فروش امروز</h3>
                    <p class="text-gray-700">1,500,000 تومان</p>
                </div>
                <div class="bg-white shadow rounded p-4">
                    <h3 class="font-bold text-lg mb-2">هزینه امروز</h3>
                    <p class="text-gray-700">500,000 تومان</p>
                </div>
                <div class="bg-white shadow rounded p-4">
                    <h3 class="font-bold text-lg mb-2">سود امروز</h3>
                    <p class="text-gray-700">1,000,000 تومان</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>