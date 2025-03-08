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