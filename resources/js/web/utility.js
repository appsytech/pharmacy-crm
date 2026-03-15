/* =====================================
Handles alert dismissal behavior..
========================================*/
function handleAlertAutoDismiss() {
    const alerts = document.querySelectorAll(".alert");
    alerts.forEach((alert) => {
        const timeout = 5000;

        setTimeout(() => {
            alert.classList.add("opacity-0", "translate-x-2");
            setTimeout(() => alert.remove(), 300);
        }, timeout);

        alert.querySelector(".close-alert")?.addEventListener("click", () => {
            alert.classList.add("opacity-0", "translate-x-2");
            setTimeout(() => alert.remove(), 300);
        });
    });
}
/* ============================================
   Creates and displays a reusable success/error
==============================================*/
function showAlert(type, message, duration = 5000) {
    const alertContainer = document.getElementById("popup-container");

    const alertId =
        "alert-" + Date.now() + "-" + Math.floor(Math.random() * 1000);

    const alertDiv = document.createElement("div");
    alertDiv.id = alertId;

    // Base bootstrap classes
    alertDiv.className =
        "alert alert-dismissible fade show d-flex align-items-start gap-2";

    if (type === "success") {
        alertDiv.classList.add("alert-success");

        alertDiv.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                 fill="currentColor" class="bi bi-check-circle-fill shrink-0"
                 viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03l4.992-4.992-1.06-1.06L6.97 8.91 5.098 7.04l-1.06 1.06 2.932 2.93z"/>
            </svg>

            <div>
                <div class="fw-semibold">Success!</div>
                <div>${message}</div>
            </div>

            <button type="button" class="btn-close ms-auto"
                data-bs-dismiss="alert"></button>
        `;
    } else {
        alertDiv.classList.add("alert-danger");

        alertDiv.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                 fill="currentColor" class="bi bi-exclamation-circle-fill shrink-0"
                 viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM7.002 4a1 1 0 0 1 1 1l-.35 4.507a.65.65 0 0 1-1.3 0L6.002 5a1 1 0 0 1 1-1zm.998 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
            </svg>

            <div>
                <div class="fw-semibold">Error occurred</div>
                <div>${message}</div>
            </div>

            <button type="button" class="btn-close ms-auto"
                data-bs-dismiss="alert"></button>
        `;
    }

    alertContainer.appendChild(alertDiv);

    alertDiv.style.transform = "translateY(-20px)";
    alertDiv.style.opacity = "0";

    requestAnimationFrame(() => {
        alertDiv.style.transition = "all 0.5s ease";
        alertDiv.style.transform = "translateY(0)";
        alertDiv.style.opacity = "1";
    });

    setTimeout(() => {
        alertDiv.style.transform = "translateY(-20px)";
        alertDiv.style.opacity = "0";

        alertDiv.addEventListener("transitionend", () => {
            alertDiv.remove();
        });
    }, duration);
}

/* ============================================
 Handles AJAX form submission.
==============================================*/
function handleAjaxForm(event) {
    event.preventDefault();
    const form = event.target;
    const submitButton = form.querySelector('button[type="submit"]');
    const originalText = submitButton.innerText;

    submitButton.disabled = true;
    submitButton.innerText = "Processing...";

    const formData = new FormData(form);

    fetch(form.action, {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status) {
                form.reset();

                data.messages.forEach((message) => {
                    showAlert("success", message);
                });
            } else {
                data.errors.forEach((message) => {
                    showAlert("error", message);
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        })
        .finally(() => {
            submitButton.innerText = originalText;
            submitButton.disabled = false;
        });
}

function togglePasswordField(target) {
    const targetFieldId = event.target.getAttribute("data-targetId");
    const targetField = document.getElementById(`${targetFieldId}`);

    if (!targetField) return;
    const icon = target.querySelector(".toggle-password-icon");
    const isPassword = targetField.type === "password";
    targetField.type = isPassword ? "text" : "password";

    if (icon) {
        icon.src = isPassword ? target.dataset.eyeoff : target.dataset.eye;
    }
}

function loadMoreData(
    containerSelector,
    loadMoreBtn,
    customMessageFieldSelector,
    perPage = 3,
    callback = null,
) {
    const container = document.querySelector(containerSelector);
    const btn = loadMoreBtn;

    if (!container || !btn) return;

    if (!btn.dataset.offset) btn.dataset.offset = 0;
    btn.dataset.limit = perPage;

    const url = btn.dataset.targeturl;

    const customMessageField = document.querySelector(
        customMessageFieldSelector,
    );

    customMessageField ? (customMessageField.innerHTML = "") : "";
    const offset = parseInt(btn.dataset.offset);
    const limit = parseInt(btn.dataset.limit);

    btn.disabled = true;
    const originalHtml = btn.innerHTML;
    btn.textContent = "Loading...";

    fetch(`${url}?offset=${offset}&limit=${limit}`, {
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((res) => res.json())
        .then((data) => {
            if (!data.html.trim() || data.count < 3) {
                if (customMessageField) {
                    const badge = document.createElement("span");
                    badge.textContent = "All data has been displayed";
                    badge.className =
                        "inline-block bg-blue-200 text-blue-700 px-3 py-1 rounded-full mt-3";
                    customMessageField.appendChild(badge);
                }

                btn.style.display = "none";
            }

            if (data.count > 0) {
                container.insertAdjacentHTML("beforeend", data.html);
                btn.dataset.offset = offset + limit;
                if (callback) callback();
            }
        })
        .catch((err) => console.error(err))
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = originalHtml;
        });
}

export {
    handleAlertAutoDismiss,
    handleAjaxForm,
    togglePasswordField,
    loadMoreData,
};
