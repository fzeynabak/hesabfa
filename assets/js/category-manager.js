// تعریف متغیرهای سراسری در ابتدای فایل
let selectedCategories = new Set();
let mainCategoryId = null;

// اضافه کردن Event Listener برای DOM
document.addEventListener('DOMContentLoaded', function() {
    // مقداردهی اولیه دسته‌بندی‌های انتخاب شده
    const initialCategories = document.getElementById('categoryIds')?.value;
    if (initialCategories) {
        initialCategories.split(',').forEach(id => selectedCategories.add(parseInt(id)));
        updateSelectedCategoriesDisplay();
    }

    // اضافه کردن event listener برای جستجو
    const searchInput = document.getElementById('categorySearch');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            loadCategories(e.target.value);
        });
    }
});
// مدیریت مدال دسته‌بندی
function openCategoryModal() {
    const modal = document.getElementById('categoryModal');
    if (!modal) {
        console.error('مدال دسته‌بندی یافت نشد!');
        return;
    }
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    loadCategories();
}

function closeCategoryModal() {
    const modal = document.getElementById('categoryModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

// مدیریت فرم دسته‌بندی
function showAddCategoryForm() {
    const form = document.getElementById('categoryForm');
    if (!form) {
        console.error('فرم دسته‌بندی یافت نشد!');
        return;
    }
    document.getElementById('categoryFormTitle').textContent = 'افزودن دسته‌بندی جدید';
    document.getElementById('categoryId').value = '';
    document.getElementById('addEditCategoryForm').reset();
    form.classList.remove('hidden');
    form.classList.add('flex');
    loadParentCategories();
}

function closeCategoryForm() {
    const form = document.getElementById('categoryForm');
    if (form) {
        form.classList.add('hidden');
        form.classList.remove('flex');
    }
}

// بارگذاری و مدیریت دسته‌بندی‌ها
function loadCategories(search = '') {
    fetch(`../categories/get_categories.php${search ? '?search=' + encodeURIComponent(search) : ''}`)
        .then(response => response.json())
        .then(categories => {
            const list = document.getElementById('categoriesList');
            if (!list) return;

            list.innerHTML = '';
            categories.forEach(category => {
                const div = document.createElement('div');
                div.className = 'category-item flex justify-between items-center p-2 hover:bg-gray-100 border-b';
                div.innerHTML = `
                    <div class="flex items-center">
                        <input type="checkbox"
                               value="${category.id}"
                               ${selectedCategories.has(parseInt(category.id)) ? 'checked' : ''}
                               onchange="toggleCategory(${category.id}, '${category.name}')"
                               class="ml-2">
                        <span>${category.name}</span>
                        <small class="text-gray-500 mr-2">${category.code || ''}</small>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="setMainCategory(${category.id})" 
                                class="text-green-600 hover:text-green-800 ${mainCategoryId === category.id ? 'font-bold' : ''}">
                            <i class="fas fa-star"></i>
                        </button>
                        <button onclick="editCategory(${category.id})" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button onclick="deleteCategory(${category.id})" class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
                list.appendChild(div);
            });
        })
        .catch(error => {
            console.error('خطا در بارگذاری دسته‌بندی‌ها:', error);
            alert('خطا در بارگذاری دسته‌بندی‌ها');
        });
}

// مدیریت دسته‌بندی‌های انتخاب شده
function toggleCategory(id, name) {
    id = parseInt(id);
    if (selectedCategories.has(id)) {
        selectedCategories.delete(id);
        if (mainCategoryId === id) {
            mainCategoryId = null;
        }
    } else {
        selectedCategories.add(id);
    }
    updateSelectedCategoriesDisplay();
}

function setMainCategory(id) {
    if (selectedCategories.has(id)) {
        mainCategoryId = mainCategoryId === id ? null : id;
        updateSelectedCategoriesDisplay();
    } else {
        alert('ابتدا باید این دسته‌بندی را انتخاب کنید');
    }
}

function updateSelectedCategoriesDisplay() {
    const container = document.getElementById('selectedCategories');
    const categoryIdsInput = document.getElementById('categoryIds');
    const personCategoriesDisplay = document.getElementById('personCategories');
    
    if (!container || !categoryIdsInput || !personCategoriesDisplay) return;

    container.innerHTML = '';
    personCategoriesDisplay.innerHTML = '';

    selectedCategories.forEach(id => {
        fetch(`../categories/get_category.php?id=${id}`)
            .then(response => response.json())
            .then(category => {
                // نمایش در مدال
                const span = document.createElement('span');
                span.className = 'selected-category-tag inline-flex items-center bg-blue-100 text-blue-800 rounded px-2 py-1 text-sm m-1';
                span.innerHTML = `
                    ${category.name}
                    ${mainCategoryId === id ? '<i class="fas fa-star text-yellow-500 mr-1"></i>' : ''}
                    <button onclick="toggleCategory(${id})" class="mr-1 hover:text-blue-900">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                container.appendChild(span);

                // نمایش در صفحه اصلی
                const displaySpan = document.createElement('span');
                displaySpan.className = 'inline-flex items-center bg-blue-100 text-blue-800 rounded px-2 py-1 text-sm m-1';
                displaySpan.innerHTML = `
                    ${mainCategoryId === id ? '<i class="fas fa-star text-yellow-500 mr-1"></i>' : ''}
                    ${category.name}
                `;
                personCategoriesDisplay.appendChild(displaySpan);
            });
    });

    // بروزرسانی input مخفی
    categoryIdsInput.value = Array.from(selectedCategories).join(',');
}

// تابع ذخیره نهایی دسته‌بندی‌های انتخاب شده
function saveSelectedCategories() {
    updateSelectedCategoriesDisplay();
    closeCategoryModal();
}