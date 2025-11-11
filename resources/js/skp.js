document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const toggleBtn = document.getElementById('toggle-sidebar');
    const toggleArrow = document.getElementById('toggle-arrow');
    const logo = document.getElementById('sidebar-logo');
    const title = document.getElementById('sidebar-title');
    const sidebarTexts = document.querySelectorAll('.sidebar-text');
    const dropdownArrows = document.querySelectorAll('.sidebar-dropdown-arrow');
    const dropdowns = document.querySelectorAll('.sidebar-dropdown');
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileOverlay = document.getElementById('mobile-overlay');
    
    let isCollapsed = false;

    // Desktop sidebar toggle functionality
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            isCollapsed = !isCollapsed;
            
            if (isCollapsed) {
                // Collapse sidebar
                sidebar.classList.remove('w-[260px]');
                sidebar.classList.add('w-[70px]');
                
                // Update main content margin
                if (mainContent) {
                    mainContent.classList.remove('md:ml-[260px]');
                    mainContent.classList.add('md:ml-[70px]');
                }
                
                // Rotate arrow to right
                toggleArrow.classList.remove('ri-arrow-left-double-line');
                toggleArrow.classList.add('ri-arrow-right-double-line');
                
                // Hide logo and title
                if (logo) {
                    logo.classList.add('w-0', 'opacity-0');
                    logo.classList.remove('w-14', 'mr-1');
                }
                if (title) {
                    title.classList.add('w-0', 'opacity-0');
                }
                
                // Hide all text elements
                sidebarTexts.forEach(text => {
                    text.classList.add('w-0', 'opacity-0');
                });
                
                // Hide dropdown arrows and dropdowns
                dropdownArrows.forEach(arrow => {
                    arrow.classList.add('hidden');
                });
                dropdowns.forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
                // Remove selected state from all groups to close dropdowns
                document.querySelectorAll('.group').forEach(group => {
                    group.classList.remove('selected');
                });
                
            } else {
                // Expand sidebar
                sidebar.classList.add('w-[260px]');
                sidebar.classList.remove('w-[70px]');
                
                // Update main content margin
                if (mainContent) {
                    mainContent.classList.remove('md:ml-[70px]');
                    mainContent.classList.add('md:ml-[260px]');
                }
                
                // Rotate arrow to left
                toggleArrow.classList.remove('ri-arrow-right-double-line');
                toggleArrow.classList.add('ri-arrow-left-double-line');
                
                // Show logo and title
                if (logo) {
                    logo.classList.remove('w-0', 'opacity-0');
                    logo.classList.add('w-14', 'mr-1');
                }
                if (title) {
                    title.classList.remove('w-0', 'opacity-0');
                }
                
                // Show all text elements
                sidebarTexts.forEach(text => {
                    text.classList.remove('w-0', 'opacity-0');
                });
                
                // Show dropdown arrows
                dropdownArrows.forEach(arrow => {
                    arrow.classList.remove('hidden');
                });
                // Show dropdowns that should be visible (selected state)
                dropdowns.forEach(dropdown => {
                    const parent = dropdown.closest('.group');
                    if (parent && parent.classList.contains('selected')) {
                        dropdown.classList.remove('hidden');
                    }
                });
            }
        });
    }

    // Mobile menu toggle
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            const isMobileHidden = sidebar.classList.contains('-translate-x-full');
            
            if (isMobileHidden) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                if (mobileOverlay) {
                    mobileOverlay.classList.remove('hidden');
                }
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                if (mobileOverlay) {
                    mobileOverlay.classList.add('hidden');
                }
                document.body.style.overflow = '';
            }
        });
    }

    // Close mobile menu when overlay is clicked
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            sidebar.classList.remove('translate-x-0');
            mobileOverlay.classList.add('hidden');
            document.body.style.overflow = '';
        });
    }

    // Sidebar dropdown functionality (from your separate JS file)
    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const parent = item.closest('.group');
            
            if (parent.classList.contains('selected')) {
                parent.classList.remove('selected');
            } else {
                // Close all other dropdowns first
                document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function(i) {
                    i.closest('.group').classList.remove('selected');
                });
                // Open current dropdown
                parent.classList.add('selected');
            }
        });
    });
});