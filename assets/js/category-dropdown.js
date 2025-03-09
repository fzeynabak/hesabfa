/**
 * مدیریت دسته‌بندی‌های اشخاص
 * نسخه 1.0.0
 */

document.addEventListener('DOMContentLoaded', function() {
    // تعریف متغیرهای سراسری
    const searchInput = document.getElementById('categorySearch');
    const dropdown = document.getElementById('categoryDropdown');
    const selectedContainer = document.getElementById('selectedCategoriesContainer');
    const categoryIdsInput = document.getElementById('categoryIds');
    
    let selectedCategories = new Set();
    let mainCategoryId = null;
    let categories = [];
    let searchTimeout;

    // جستجوی دسته‌بندی‌ها با تاخیر برای جلوگیری از درخواست‌های مکرر
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const searchTerm = e.target.value.trim();
            
            searchTimeout = setTimeout(() => {
                if (searchTerm.length > 0) {
                    fetchCategories(searchTerm);
                    showDropdown();
                } else {
                    hideDropdown();
                }
            }, 300);
        });

        // فوکوس روی فیلد جستجو
        searchInput.addEventListener('focus', function() {
            if (categories.length > 0) {
                showDropdown();
            } else {
                fetchCategories();
            }
        });
    }

    // بستن دراپ‌داون با کلیک خارج از آن
    document.addEventListener('click', function(e) {
        if (!searchInput?.contains(e.target) && !dropdown?.contains(e.target)) {
            hideDropdown();
        }
    });

    // دریافت دسته‌بندی‌ها از سرور
    function fetchCategories(search = '') {
        const url = `../categories/get_categories.php${search ? '?search=' + encodeURIComponent(search) : ''}`;
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('خطا در دریافت اطلاعات از سرور');
                }
                return response.json();
            })
            .then(data => {
                categories = Array.isArray(data) ? data : [];
                renderDropdown();
            })
            .catch(error => {
                console.error('خطا در دریافت دسته‌بندی‌ها:', error);
                // نمایش پیام خطا به کاربر
                const errorDiv = document.createElement('div');
                errorDiv.className = 'text-red-500 text-sm mt-1';
                errorDiv.textContent = 'خطا در دریافت دسته‌بندی‌ها. لطفاً مجدداً تلاش کنید.';
                searchInput.parentNode.appendChild(errorDiv);
                setTimeout(() => errorDiv.remove(), 3000);
            });
    }

    // نمایش دراپ‌داون
    function showDropdown() {
        if (dropdown) {
            dropdown.classList.remove('hidden');
        }
    }

    // مخفی کردن دراپ‌داون
    function hideDropdown() {
        if (dropdown) {
            dropdown.classList.add('hidden');
        }
    }

    // نمایش دسته‌بندی‌ها در دراپ‌داون
    function renderDropdown() {
        if (!dropdown) return;

        dropdown.innerHTML = '';
        if (categories.length === 0) {
            dropdown.innerHTML = '<div class="p-2 text-gray-500">موردی یافت نشد</div>';
            return;
        }

        categories.forEach(category => {
            const isSelected = selectedCategories.has(parseInt(category.id));
            const div = document.createElement('div');
            div.className = `p-2 hover:bg-gray-100 cursor-pointer flex justify-between items-center ${isSelected ? 'bg-blue-50' : ''}`;
            div.innerHTML = `
                <div class="flex items-center">
                    <input type="checkbox" 
                           class="ml-2 cursor-pointer" 
                           ${isSelected ? 'checked' : ''}>
                    <span class="mr-2">${category.name}</span>
                    ${category.code ? `<small class="text-gray-500">(${category.code})</small>` : ''}
                </div>
                <button class="text-gray-500 hover:text-yellow-500 ${mainCategoryId === parseInt(category.id) ? 'text-yellow-500' : ''}" 
                        title="انتخاب به عنوان دسته‌بندی اصلی">
                    <i class="fas fa-star"></i>
                </button>
            `;
            
            // مدیریت رویدادهای کلیک
            div.addEventListener('click', (e) => {
                if (!e.target.matches('button, button *')) {
                    toggleCategory(category);
                }
            });

            const starButton = div.querySelector('button');
            starButton.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMainCategory(parseInt(category.id));
            });

            dropdown.appendChild(div);
        });
    }

    // تغییر وضعیت انتخاب دسته‌بندی
    function toggleCategory(category) {
        const categoryId = parseInt(category.id);
        if (selectedCategories.has(categoryId)) {
            selectedCategories.delete(categoryId);
            if (mainCategoryId === categoryId) {
                mainCategoryId = null;
            }
        } else {
            selectedCategories.add(categoryId);
        }
        updateSelectedCategories();
        renderDropdown();
    }

    // تغییر دسته‌بندی اصلی
    function toggleMainCategory(categoryId) {
        if (!selectedCategories.has(categoryId)) {
            selectedCategories.add(categoryId);
        }
        mainCategoryId = mainCategoryId === categoryId ? null : categoryId;
        updateSelectedCategories();
        renderDropdown();
    }

    // بروزرسانی نمایش دسته‌بندی‌های انتخاب شده
    function updateSelectedCategories() {
        if (!selectedContainer || !categoryIdsInput) return;

        selectedContainer.innerHTML = '';
        categoryIdsInput.value = Array.from(selectedCategories).join(',');

        Array.from(selectedCategories).forEach(id => {
            const category = categories.find(c => parseInt(c.id) === id);
            if (category) {
                const tag = document.createElement('span');
                tag.className = 'inline-flex items-center bg-blue-100 text-blue-800 rounded px-2 py-1 text-sm m-1';
                tag.innerHTML = `
                    ${mainCategoryId === parseInt(category.id) ? '<i class="fas fa-star text-yellow-500 ml-1"></i>' : ''}
                    ${category.name}
                    <button class="mr-1 hover:text-red-500" onclick="removeCategoryTag(${category.id})">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                selectedContainer.appendChild(tag);
            }
        });
    }

    // حذف دسته‌بندی - تعریف به صورت عمومی برای دسترسی از HTML
    window.removeCategoryTag = function(categoryId) {
        categoryId = parseInt(categoryId);
        selectedCategories.delete(categoryId);
        if (mainCategoryId === categoryId) {
            mainCategoryId = null;
        }
        updateSelectedCategories();
        renderDropdown();
    };

    // بارگذاری اولیه دسته‌بندی‌ها
    fetchCategories();
});