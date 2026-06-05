(function () {

    let userConfirmModal;
    let userConfirmIcon;
    let userConfirmTitle;
    let userConfirmText;
    let userConfirmBtn;

    document.addEventListener("DOMContentLoaded", function () {
        userConfirmModal = document.getElementById("confirmModal");
        userConfirmIcon = document.getElementById("confirmIcon");
        userConfirmTitle = document.getElementById("confirmTitle");
        userConfirmText = document.getElementById("confirmText");
        userConfirmBtn = document.getElementById("confirmBtn");

        const toast = document.getElementById("toast");

        if (toast) {
            setTimeout(function () {
                toast.classList.add("toast-hide");
            }, 2500);

            setTimeout(function () {
                toast.remove();
            }, 3000);

            const url = new URL(window.location);
            url.searchParams.delete("msg");
            window.history.replaceState({}, "", url);
        }
    });

    window.openConfirmModal = function (link, type) {
        const href = link.getAttribute("href");

        userConfirmBtn.setAttribute("href", href);
        userConfirmBtn.className = "";

        if (type === "lock") {
            userConfirmIcon.className = "bx bx-lock-alt";
            userConfirmTitle.innerText = "Khóa tài khoản?";
            userConfirmText.innerText = "User sẽ không thể đăng nhập hệ thống.";
            userConfirmBtn.innerText = "Khóa tài khoản";
            userConfirmBtn.classList.add("btn-danger");
        }

        if (type === "unlock") {
            userConfirmIcon.className = "bx bx-lock-open-alt";
            userConfirmTitle.innerText = "Mở khóa tài khoản?";
            userConfirmText.innerText = "User sẽ được phép đăng nhập lại.";
            userConfirmBtn.innerText = "Mở khóa";
            userConfirmBtn.classList.add("btn-success");
        }

        if (type === "delete") {
            userConfirmIcon.className = "bx bx-trash";
            userConfirmTitle.innerText = "Xóa tài khoản?";
            userConfirmText.innerText = "Tài khoản sẽ bị xóa khỏi hệ thống.";
            userConfirmBtn.innerText = "Xóa tài khoản";
            userConfirmBtn.classList.add("btn-danger");
        }

        userConfirmModal.classList.add("show");

        return false;
    };

    window.closeConfirmModal = function () {
        userConfirmModal.classList.remove("show");
    };

})();