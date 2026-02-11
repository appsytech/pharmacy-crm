/**
 * ---------------------------------------------------------------------
 * Sidebar Controller
 * ---------------------------------------------------------------------
 * This module manages all sidebar-related behaviors including:
 * - Sidebar toggle for mobile and desktop
 * - Collapse / expand behavior on large screens
 * - Submenu open / close logic
 * - Active menu detection based on current URL
 * ---------------------------------------------------------------------
 */

let sidebarCollapsed = false;
let activeSubMenuId = null;

/* ================================
  Toggles sidebar visibility.
=================================== */
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const isLargeScreen = window.innerWidth >= 1024;

    if (!isLargeScreen) {
        sidebar.classList.toggle("-translate-x-full");
        sidebar.classList.toggle("translate-x-0");
    } else {
        // Desktop behavior - collapse/expand
        const searchBar = document.getElementById("search-bar");
        const logo = document.getElementById("logo");
        const sidebarTexts = document.querySelectorAll(".sidebar-text");
        const sidebarSubmenus = document.querySelectorAll(".sidebar-submenu");
        const sidebarSubmenuIcons = document.querySelectorAll(
            ".sidebar-submenu-icon",
        );

        sidebarCollapsed = !sidebarCollapsed;

        if (sidebarCollapsed) {
            //collapse sidebar
            sidebar.classList.remove("w-64");
            sidebar.classList.add("w-20");
            searchBar.classList.add("hidden");
            logo.classList.add("hidden");
            sidebarTexts.forEach((text) => text.classList.add("hidden"));
            sidebarSubmenus.forEach((submenu) =>
                submenu.classList.add("hidden"),
            );
            sidebarSubmenuIcons.forEach((icon) => {
                icon.classList.remove("rotate-90");
            });
        } else {
            //expand sidebar
            sidebar.classList.remove("w-20");
            sidebar.classList.add("w-64");
            searchBar.classList.remove("hidden");
            logo.classList.remove("hidden");
            sidebarTexts.forEach((text) => text.classList.remove("hidden"));

            if (activeSubMenuId) {
                toggleSubmenu(activeSubMenuId);
            }
        }
    }
}

/* ================================================
   Handles click on a menu item that has a submenu.
================================================== */
function handleMenuClick(id) {
    const isLargeScreen = window.innerWidth >= 1024;

    activeSubMenuId == id ? (activeSubMenuId = null) : (activeSubMenuId = id);

    if (isLargeScreen && sidebarCollapsed) {
        toggleSidebar();
        setTimeout(() => {
            toggleSubmenu(id);
        }, 100);
    } else {
        toggleSubmenu(id);
    }
}

/* =============================================================
   Highlights the active menu item based on the current URL path.
================================================================ */
function markActiveMenu() {
    const navLinks = document.querySelectorAll(
        "nav a[data-nav], nav > div > a",
    );

    navLinks.forEach((link) => {
        if (link.classList.contains("is_active")) {
            link.classList.add("bg-blue-100", "text-black");

            const submenu = link.closest(".sidebar-submenu");
            if (submenu) {
                submenu.classList.remove("hidden");
                const parentButton = submenu.previousElementSibling;
                if (
                    parentButton &&
                    parentButton.classList.contains("has-submenu")
                ) {
                    activeSubMenuId = parentButton.id;
                    parentButton.classList.add("bg-indigo-100");
                    const icon = parentButton.querySelector(
                        ".sidebar-submenu-icon",
                    );
                    if (icon) icon.classList.add("rotate-90");
                }
            }
        }
    });
}

/* ==============================================================
   Toggles visibility of a submenu and rotates its indicator icon.
================================================================ */
function toggleSubmenu(id) {
    const submenu = document.getElementById(id + "-submenu");
    const icon = document.getElementById(id + "-icon");
    submenu.classList.toggle("hidden");
    icon.classList.toggle("rotate-90");
}

export { toggleSidebar, handleMenuClick, markActiveMenu };
