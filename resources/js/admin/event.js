import { closeModal, handleMediaUpload, openModal } from "./modal";
import { handleMenuClick, markActiveMenu, toggleSidebar } from "./sidebar";
import { handleAjaxForm, togglePasswordField, updateStatus } from "./utility";

/* ============================================================
  Global Click Events.
=============================================================== */
document.addEventListener("click", function (event) {
    // Toggle sidebar visibility
    if (event.target.classList.contains("toggle-sidebar")) {
        toggleSidebar();
    }

    // Handle sidebar submenu toggle
    if (event.target.classList.contains("has-submenu")) {
        handleMenuClick(event.target.id);
    }

    // Open modal window
    if (event.target.classList.contains("open-modal")) {
        openModal(event.target.getAttribute("data-targetModalId"));
    }

    // Close modal window
    if (event.target.classList.contains("close-modal")) {
        closeModal(event.target.getAttribute("data-targetModalId"));
    }

    if (event.target.classList.contains("toggle-password-field")) {
        togglePasswordField(event.target);
    }
});

document.addEventListener("change", function (event) {
    if (event.target.classList.contains("image-upload&preview")) {
        handleMediaUpload(event.target);
    }

    if (event.target.classList.contains("status-toggle")) {
        updateStatus(event.target);
    }
});

document.addEventListener("submit", function (event) {
    if (event.target.classList.contains("ajax-form")) {
        handleAjaxForm(event);
    }
});

// Highlight active sidebar menu item on page load
markActiveMenu();
