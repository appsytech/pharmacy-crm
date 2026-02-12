/**
 * ---------------------------------------------------------------------
 * Modal Controller
 * ---------------------------------------------------------------------
 * This module handles opening and closing modal components.
 * It manages visibility and transition animations
 * using CSS utility classes.
 * ---------------------------------------------------------------------
 */

/* ===================================================================
  Opens a modal by making it visible and applying the entry animation.
==================================================================== */
function openModal(modalBtnId) {
    const modal = document.getElementById(`${modalBtnId}`);
    modal.classList.remove("hidden");
    modal.classList.add("modal-enter");
}

/* =========================================================================================
  Closes a modal by triggering the exit animationand hiding it after the animation completes.
============================================================================================ */
function closeModal(modalBtnId) {
    const modal = document.getElementById(`${modalBtnId}`);
    modal.classList.remove("modal-enter");
    modal.classList.add("modal-exit");

    setTimeout(() => {
        modal.classList.add("hidden");
        modal.classList.remove("modal-exit");
    }, 500);
}

/* ====================================================================
  Handles image uploads and previews them in the specified container.
=======================================================================*/
function handleMediaUpload(target) {
    const previewSectionId = target.getAttribute("data-previewSectionId");
    if (!previewSectionId) return;

    const previewContainer = document.getElementById(previewSectionId);
    if (!previewContainer) return;

    if (!target.multiple) {
        previewContainer.innerHTML = "";
    }

    previewContainer.classList.remove("hidden");

    const files = Array.from(target.files);

    files.forEach((file) => {
        const isImage = file.type.startsWith("image/");
        const isVideo = file.type.startsWith("video/");

        if (!isImage && !isVideo) return;

        const mediaWrapper = document.createElement("div");
        mediaWrapper.classList.add("relative", "inline-flex", "gap-2");

        let mediaElement;

        if (isImage) {
            mediaElement = document.createElement("img");
            mediaElement.classList.add(
                "w-24",
                "h-24",
                "object-cover",
                "rounded",
                "border",
            );

            const reader = new FileReader();
            reader.onload = (e) => (mediaElement.src = e.target.result);
            reader.readAsDataURL(file);
        }

        if (isVideo) {
            mediaElement = document.createElement("video");
            mediaElement.classList.add(
                "w-24",
                "h-24",
                "object-cover",
                "rounded",
                "border",
            );

            mediaElement.src = URL.createObjectURL(file);
            mediaElement.controls = true;
            mediaElement.muted = true;
        }

        mediaElement.title = file.name;

        mediaWrapper.appendChild(mediaElement);
        addRemoveButton(mediaWrapper, target);
        previewContainer.appendChild(mediaWrapper);
    });
}

/* ==============================================================================
Adds a small remove button to an image wrapper, allowing users to remove the image.
=================================================================================*/
function addRemoveButton(wrapper, target) {
    const removeBtn = document.createElement("button");
    removeBtn.textContent = "×";
    removeBtn.classList.add(
        "absolute",
        "top-0",
        "right-0",
        "bg-red-500",
        "text-white",
        "rounded-full",
        "w-5",
        "h-5",
        "flex",
        "items-center",
        "justify-center",
        "text-xs",
    );

    removeBtn.addEventListener("click", () => {
        wrapper.remove();
        if (!target.multiple) target.value = "";
    });

    wrapper.appendChild(removeBtn);
}

export { openModal, closeModal, handleMediaUpload };
