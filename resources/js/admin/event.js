import { handleAjaxInput } from "./ajax";
import { calculateRemaining, calculateSalary } from "./calculation";
import { closeModal, handleMediaUpload, openModal } from "./modal";
import { handleMenuClick, markActiveMenu, toggleSidebar } from "./sidebar";
import {
    handleAjaxForm,
    handleAlertAutoDismiss,
    showAlert,
    togglePasswordField,
    toggleVoucherRequirement,
    updateStatus,
} from "./utility";

import Quill from "quill";
import "quill/dist/quill.snow.css";

document.addEventListener("DOMContentLoaded", () => {
    //hide preloader once the page is ready
    let preloader = document.getElementById("loader");
    if (preloader) {
        preloader.classList.add("hidden");
    }

    //if succes message exists show them
    const messages = sessionStorage.getItem("success_messages");
    if (messages) {
        JSON.parse(messages).forEach((message) => {
            showAlert("success", message);
        });

        sessionStorage.removeItem("success_messages");
    }

    // description
    const descriptionEditorEl = document.querySelector("#descriptionEditor");
    let quillDescription;
    if (descriptionEditorEl) {
        quillDescription = new Quill(descriptionEditorEl, {
            theme: "snow",
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ["bold", "italic", "underline", "strike"],
                    [{ color: [] }, { background: [] }],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ align: [] }],
                    ["blockquote", "code-block"],
                    ["link", "image", "video"],
                    ["clean"],
                ],
                history: {
                    delay: 1000,
                    maxStack: 50,
                    userOnly: true,
                },
            },
        });

        quillDescription.on("text-change", function () {
            const content = document.querySelector("#description");
            const text = quillDescription.getText().trim();

            console.log(content, text);
            if (content) {
                if (content.required && text.length === 0) {
                    e.preventDefault();
                    document.querySelector(".ql-container").style.borderColor =
                        "red";

                    return false;
                }
                content.value = quillDescription.root.innerHTML;
            }
        });
    }

    // content
    const contentEditorEl = document.querySelector("#contentEditor");
    if (contentEditorEl) {
        let quillContent = new Quill(contentEditorEl, {
            theme: "snow",
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ["bold", "italic", "underline", "strike"],
                    [{ color: [] }, { background: [] }],
                    [{ list: "ordered" }, { list: "bullet" }],
                    [{ align: [] }],
                    ["blockquote", "code-block"],
                    ["link", "image", "video"],
                    ["clean"],
                ],
                history: {
                    delay: 1000,
                    maxStack: 50,
                    userOnly: true,
                },
            },
        });

        quillContent.on("text-change", function () {
            const content = document.querySelector("#content");
            const text = quillContent.getText().trim();
            if (content) {
                if (content.required && text.length === 0) {
                    e.preventDefault();
                    document.querySelector(".ql-container").style.borderColor =
                        "red";

                    return false;
                }
                content.value = quillContent.root.innerHTML;
            }
        });
    }
});

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

    if (event.target.classList.contains("toggle-voucher-requirement")) {
        toggleVoucherRequirement();
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

document.addEventListener("input", function (event) {
    if (event.target.classList.contains("calculate-salary")) {
        calculateSalary();
    }

    if (event.target.classList.contains("calculate-remaining")) {
        calculateRemaining();
    }

    if (event.target.classList.contains("ajax-input")) {
        handleAjaxInput(event.target);
    }
});

document.addEventListener("change", function (event) {
    if (event.target.classList.contains("image-upload&preview")) {
        handleMediaUpload(event.target);
    }

    if (event.target.classList.contains("status-toggle")) {
        updateStatus(event.target);
    }

    if (event.target.classList.contains("ajax-input")) {
        handleAjaxInput(event.target);
    }

    if (event.target.classList.contains("ajax-select")) {
        handleAjaxInput(event.target);
    }
});

document.addEventListener("submit", function (event) {
    if (event.target.classList.contains("ajax-form")) {
        handleAjaxForm(event);
    }
});

// Highlight active sidebar menu item on page load
markActiveMenu();

handleAlertAutoDismiss();
