document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("defaultOpen").click();
});

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

const selectedCategories = new Set();
const initialCategories = document.getElementById('categoryIds').value;
if (initialCategories) {
    initialCategories.split(',').forEach(id => selectedCategories.add(parseInt(id)));
    updateSelectedCategoriesDisplay();
}