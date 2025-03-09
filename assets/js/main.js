// بهینه‌سازی کد جاوااسکریپت
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
    initializeEventListeners();
});

function initializeEventListeners() {
    // اضافه کردن event listener برای جستجوی دسته‌بندی
    const categorySearch = document.getElementById('categorySearch');
    if (categorySearch) {
        categorySearch.addEventListener('input', (e) => {
            loadCategories(e.target.value);
        });
    }

    // اضافه کردن event listener برای فرم دسته‌بندی
    const categoryForm = document.getElementById('addEditCategoryForm');
    if (categoryForm) {
        categoryForm.addEventListener('submit', handleCategoryFormSubmit);
    }

    // مقداردهی اولیه دسته‌بندی‌های انتخاب شده
    initializeSelectedCategories();
}

// تابع جدید برای تولید کد حسابداری
function generateCode() {
    try {
        // تولید یک عدد 6 رقمی تصادفی با پیشوند سال
        let prefix = new Date().getFullYear().toString().substr(-2);
        let random = Math.floor(Math.random() * 9000) + 1000;
        let code = prefix + random.toString();
        
        let codeInput = document.getElementById("code_hesabdari");
        if (!codeInput) {
            console.error("فیلد کد حسابداری پیدا نشد");
            return;
        }

        // اعمال کد جدید با افکت بصری
        codeInput.value = code;
        codeInput.classList.add('highlight');
        
        setTimeout(() => {
            codeInput.classList.remove('highlight');
        }, 1000);

        // لاگ برای اطمینان از تولید کد
        console.log('کد جدید تولید شد:', code);

    } catch (error) {
        console.error('خطا در تولید کد:', error);
    }
}

// بهینه‌سازی تابع مدیریت فرم دسته‌بندی
function handleCategoryFormSubmit(e) {
    e.preventDefault();

    const formData = new FormData();
    const categoryId = document.getElementById('categoryId');
    const categoryCode = document.getElementById('categoryCode');
    const categoryName = document.getElementById('categoryName');
    const categoryDescription = document.getElementById('categoryDescription');

    if (!categoryId || !categoryCode || !categoryName || !categoryDescription) {
        console.error('یکی از فیلدهای ضروری پیدا نشد');
        return;
    }

    formData.append('id', categoryId.value);
    formData.append('code', categoryCode.value);
    formData.append('name', categoryName.value);
    formData.append('description', categoryDescription.value);

    const url = categoryId.value ? 'update_category.php' : 'save_category.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeCategoryForm();
            loadCategories();
            alert(data.message);
        } else {
            alert(data.message || 'خطا در ذخیره‌سازی دسته‌بندی');
        }
    })
    .catch(error => {
        console.error('خطا:', error);
        alert('خطا در ارتباط با سرور');
    });
}

// تابع مقداردهی اولیه دسته‌بندی‌های انتخاب شده
function initializeSelectedCategories() {
    const categoryIdsElement = document.getElementById('categoryIds');
    if (categoryIdsElement && categoryIdsElement.value) {
        const ids = categoryIdsElement.value.split(',');
        ids.forEach(id => selectedCategories.add(parseInt(id)));
        updateSelectedCategoriesDisplay();
    }
}

// ادامه توابع موجود بدون تغییر...

// تنظیمات اولیه و متغیرهای جهانی
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

function initializeApp() {
    // مدیریت منوی همبرگری در حالت موبایل
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if(sidebarToggle) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }

    // بستن منو با کلیک خارج از آن در حالت موبایل
    document.addEventListener('click', (e) => {
        if(window.innerWidth <= 768) {
            if(!e.target.closest('.sidebar') && !e.target.closest('#sidebar-toggle')) {
                sidebar.classList.remove('active');
            }
        }
    });

    // مدیریت ارتفاع محتوا
    adjustContentHeight();
    window.addEventListener('resize', adjustContentHeight);
}

function adjustContentHeight() {
    const navbar = document.querySelector('.navbar');
    const mainContent = document.querySelector('.main-content');
    
    if(navbar && mainContent) {
        const navbarHeight = navbar.offsetHeight;
        mainContent.style.minHeight = `calc(100vh - ${navbarHeight}px)`;
    }
}

// مدیریت روت‌ها و نمایش صفحات
function showPage(pageName) {
    // پنهان کردن همه صفحات
    const pages = document.querySelectorAll('.page');
    pages.forEach(page => page.style.display = 'none');
    
    // نمایش صفحه مورد نظر
    const targetPage = document.getElementById(`page-${pageName}`);
    if(targetPage) {
        targetPage.style.display = 'block';
    }
}

// مدیریت فرم‌ها
function handleFormSubmit(event, formType) {
    event.preventDefault();
    // پیاده‌سازی منطق ثبت فرم بر اساس نوع آن
    console.log(`Handling ${formType} form submission`);
}

// توابع کمکی برای فرمت‌کردن اعداد و تاریخ
function formatNumber(number) {
    return new Intl.NumberFormat('fa-IR').format(number);
}

function formatDate(date) {
    return new Date(date).toLocaleDateString('fa-IR');
}

// توابع دسته‌بندی‌ها
function generateCode() {
    document.getElementById("code_hesabdari").value = Math.floor(Math.random() * 900000) + 100000;
}

function openCategoryModal() {
    document.getElementById('categoryModal').style.display = 'flex';
    loadCategories();
}

function closeCategoryModal() {
    document.getElementById('categoryModal').style.display = 'none';
}

function showAddCategoryForm() {
    document.getElementById('categoryFormTitle').textContent = 'افزودن دسته‌بندی جدید';
    document.getElementById('categoryId').value = '';
    document.getElementById('addEditCategoryForm').reset();
    document.getElementById('categoryForm').style.display = 'flex';
    loadParentCategories();
}

function closeCategoryForm() {
    document.getElementById('categoryForm').style.display = 'none';
}

function loadCategories(search = '') {
    fetch(`get_categories.php${search ? '?search=' + encodeURIComponent(search) : ''}`)
        .then(response => response.json())
        .then(categories => {
            const list = document.getElementById('categoriesList');
            list.innerHTML = '';

            categories.forEach(category => {
                const div = document.createElement('div');
                div.className = 'category-item';
                div.innerHTML = `
                    <div class="flex items-center">
                        <input type="checkbox"
                               value="${category.id}"
                               ${selectedCategories.has(parseInt(category.id)) ? 'checked' : ''}
                               onchange="toggleCategory(${category.id}, '${category.name}')"
                               class="ml-2">
                        <span>${category.name}</span>
                        ${category.code ? `<span class="text-gray-500 text-sm mr-2">(${category.code})</span>` : ''}
                    </div>
                    <div class="flex gap-2">
                        <button onclick="editCategory(${category.id})" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                `;
                list.appendChild(div);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('خطا در دریافت دسته‌بندی‌ها');
        });
}

function generateCategoryCode() {
    fetch('generate_category_code.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('categoryCode').value = data.code;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('خطا در تولید کد دسته‌بندی');
        });
}

function toggleCategory(id, name) {
    id = parseInt(id);
    if (selectedCategories.has(id)) {
        selectedCategories.delete(id);
    } else {
        selectedCategories.add(id);
    }
    updateSelectedCategoriesDisplay();
}

function updateSelectedCategoriesDisplay() {
    const container = document.getElementById('selectedCategories');
    container.innerHTML = '';

    selectedCategories.forEach(id => {
        fetch(`get_category.php?id=${id}`)
            .then(response => response.json())
            .then(category => {
                const span = document.createElement('span');
                span.className = 'selected-category-tag';
                span.innerHTML = `
                    ${category.name}
                    <button onclick="toggleCategory(${id})" class="mr-1 hover:text-blue-900">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                container.appendChild(span);
            });
    });

    document.getElementById('categoryIds').value = Array.from(selectedCategories).join(',');
}

function editCategory(id) {
    fetch(`get_category.php?id=${id}`)
        .then(response => response.json())
        .then(category => {
            document.getElementById('categoryFormTitle').textContent = 'ویرایش دسته‌بندی';
            document.getElementById('categoryId').value = category.id;
            document.getElementById('categoryCode').value = category.code;
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryDescription').value = category.description;

            loadParentCategories(category.id).then(() => {
                document.getElementById('categoryParent').value = category.parent_id || '';
            });

            document.getElementById('categoryForm').style.display = 'flex';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('خطا در دریافت اطلاعات دسته‌بندی');
        });
}

function loadParentCategories(excludeId = null) {
    return fetch(`get_categories.php${excludeId ? '?exclude=' + excludeId : ''}`)
        .then(response => response.json())
        .then(categories => {
            const select = document.getElementById('categoryParent');
            select.innerHTML = '<option value="">بدون والد</option>';

            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                select.appendChild(option);
            });
        });
}

document.getElementById('categorySearch').addEventListener('input', (e) => {
    loadCategories(e.target.value);
});

document.getElementById('addEditCategoryForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('id', document.getElementById('categoryId').value);
    formData.append('code', document.getElementById('categoryCode').value);
    formData.append('name', document.getElementById('categoryName').value);
    formData.append('description', document.getElementById('categoryDescription').value);

    const url = document.getElementById('categoryId').value ? 'update_category.php' : 'save_category.php';

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            closeCategoryForm();
            loadCategories();
            alert(data.message);
        } else {
            alert(data.message || 'خطا در ذخیره‌سازی دسته‌بندی');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('خطا در ارتباط با سرور');
    });
});


const initialCategories = document.getElementById('categoryIds').value;
if (initialCategories) {
    initialCategories.split(',').forEach(id => selectedCategories.add(parseInt(id)));
    updateSelectedCategoriesDisplay();
}