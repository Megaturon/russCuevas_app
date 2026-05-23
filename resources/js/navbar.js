document.addEventListener('DOMContentLoaded', function () {
    const mobileMenu = document.getElementById('mobile-menu');
    const navLeft = document.querySelector('.nav-left');
    const navRight = document.querySelector('.nav-right');

    // Mobile Menu Toggle
    if (mobileMenu) {
        mobileMenu.addEventListener('click', function () {
            this.classList.toggle('active');
            navLeft?.classList.toggle('active');
            navRight?.classList.toggle('active');
        });
    }

    // Dropdown toggles
    const dropdownToggles = [
        { btn: '.gallery-btn', menu: 'galleryDropdown' },
        { btn: '.about-btn', menu: 'aboutDropdown' },
        { btn: '.login-btn', menu: 'loginDropdown' }
    ];

    dropdownToggles.forEach(item => {
        const btn = document.querySelector(item.btn);
        const menu = document.getElementById(item.menu);
        
        if (btn && menu) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close others
                dropdownToggles.forEach(other => {
                    if (other.menu !== item.menu) {
                        document.getElementById(other.menu).style.display = 'none';
                    }
                });

                const isHidden = menu.style.display === 'none' || menu.style.display === '';
                menu.style.display = isHidden ? 'block' : 'none';
            });
        }
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (event) {
        dropdownToggles.forEach(item => {
            const menu = document.getElementById(item.menu);
            const btn = document.querySelector(item.btn);
            if (menu && btn && !btn.contains(event.target) && !menu.contains(event.target)) {
                menu.style.display = 'none';
            }
        });
    });
});