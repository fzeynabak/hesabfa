document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('categorySearch');
    const dropdown = document.getElementById('categoryDropdown');
    const selectedContainer = document.getElementById('selectedCategoriesContainer');
    const categoryIdsInput = document.getElementById('categoryIds');
    
    let selectedCategories = new Set();
    let mainCategoryId = null;
    let categories = [];
    let searchTimeout;

    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            clearTimeout(searchTimeout);
            const searchTerm = e.target.value.trim();
            
            searchTimeout = setTimeout(() => {
                fetchCategories(searchTerm);
            }, 300);
        });

        searchInput.addEventListener('focus', function() {
            fetchCategories();
            showDropdown();
        });
    }

    document.addEventListener('click', function(e) {
        if (!searchInput?.contains(e.target) && !dropdown?.contains(e.target)) {
            hideDropdown();
        }
    });

    function fetchCategories(search = '') {
        // تغییر مسیر API مطابق با ساختار پروژه
        const apiUrl = '/hesabfa/person/categories/get_categories.php' + (search ? `?search=${encodeURIComponent(search)}` : '');
        
        // نمایش پیام در حال بارگذاری
        if (dropdown) {
            dropdown.innerHTML = '<div class="p-2 text-gray-500">در حال بارگذاری...</div>';
            showDropdown();
        }

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('خطا در دریافت اطلاعات از سرور');
                }
                return response.json();
            })
            .then(response => {
                if (response.status === 'success' && Array.isArray(response.data)) {
                    categories = response.data;
                    renderDropdown();
                } else {
                    throw new Error('داده‌های دریافتی معتبر نیستند');
                }
            })
            .catch(error => {
                console.error('خطا در دریافت دسته‌بندی‌ها:', error);
                showError('خطا در دریافت دسته‌بندی‌ها. لطفاً مجدداً تلاش کنید.');
            });
    }

    function showError(message) {
        if (dropdown) {
            dropdown.innerHTML = `<div class="p-2 text-red-500">${message}</div>`;
            showDropdown();
        }
    }

    function showDropdown() {
        if (dropdown) {
            dropdown.classList.remove('hidden');
        }
    }

    function hideDropdown() {
        if (dropdown) {
            dropdown.classList.add('hidden');
        }
    }

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
            
            div.addEventListener('click', (e) => {
                if (!e.target.matches('button, button *')) {
                    toggleCategory(category);
                }
            });

            div.querySelector('button').addEventListener('click', (e) => {
                e.stopPropagation();
                toggleMainCategory(parseInt(category.id));
            });

            dropdown.appendChild(div);
        });
    }

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

    function toggleMainCategory(categoryId) {
        if (!selectedCategories.has(categoryId)) {
            selectedCategories.add(categoryId);
        }
        mainCategoryId = mainCategoryId === categoryId ? null : categoryId;
        updateSelectedCategories();
        renderDropdown();
    }

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