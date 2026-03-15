// import { playVideo } from "./media";
// import { closeModal, openModal } from "./modal";
// import { toggleSidebar, toggleSubmenu } from "./sidebar";
// import { toggleTab } from "./tab";
import {
    handleAjaxForm,
    handleAlertAutoDismiss,
    // loadMoreData,
    // togglePasswordField,
} from "./utility";

// document.addEventListener("DOMContentLoaded", () => {
//     let preloader = document.getElementById("loader");
//     if (preloader) {
//         preloader.classList.add("hidden");
//     }

//     const messages = sessionStorage.getItem("success_messages");
//     if (messages) {
//         JSON.parse(messages).forEach((message) => {
//             showAlert("success", message);
//         });

//         sessionStorage.removeItem("success_messages");
//     }
// });

// document.addEventListener("click", function (event) {
//     // Toggle sidebar when an element with "toggle-sidebar" class is clicked
//     if (event.target.classList.contains("toggle-sidebar")) {
//         toggleSidebar();
//     }

//     // Toggle submenu when an element with "has-submenu" class is clicked
//     if (event.target.classList.contains("has-submenu")) {
//         toggleSubmenu(event.target.id);
//     }

//     // Open modal when an element with "open-modal" class is clicked
//     if (event.target.classList.contains("open-modal")) {
//         openModal(event.target.getAttribute("data-targetModalId"));
//     }

//     // Close modal when an element with "close-modal" class is clicked
//     if (event.target.classList.contains("close-modal")) {
//         closeModal(event.target.getAttribute("data-targetModalId"));
//     }

//     if (event.target.classList.contains("tab-btn")) {
//         toggleTab(event.target);
//     }

//     if (event.target.classList.contains("toggle-video")) {
//         playVideo(event.target);
//     }

//     if (event.target.classList.contains("toggle-password-field")) {
//         togglePasswordField(event.target);
//     }

//     if (event.target.classList.contains("load-more-btn")) {
//         const target = event.target;
//         loadMoreData(
//             `#${target.getAttribute("data-containerId")}`,
//             target,
//             `#${target.getAttribute("data-MessageFieldId")}`,
//         );
//     }
// });

document.addEventListener("submit", function (event) {
    if (event.target.classList.contains("ajax-form")) {
        handleAjaxForm(event);
    }
});

handleAlertAutoDismiss();
