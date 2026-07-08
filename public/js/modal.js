const modalState = { pendingUrl: null };

window.showModal = function (url) {
    modalState.pendingUrl = url;
    const modal = document.getElementById('loginModal');
    if (modal) modal.classList.remove('hidden');
};

window.hideModal = function () {
    modalState.pendingUrl = null;
    const modal = document.getElementById('loginModal');
    if (modal) modal.classList.add('hidden');
};

document.addEventListener('DOMContentLoaded', function () {
    const isAuth = window.App.isAuth;
    const { urls, csrf } = window.App;

    // ── Login Modal ──
    const modal = document.getElementById('loginModal');
    const backdrop = document.getElementById('modalBackdrop');
    const cancelBtn = document.getElementById('modalCancel');

    if (backdrop) backdrop.addEventListener('click', window.hideModal);
    if (cancelBtn) cancelBtn.addEventListener('click', window.hideModal);

    document.querySelectorAll('.login-required').forEach(link => {
        link.addEventListener('click', function (e) {
            if (isAuth) return;
            e.preventDefault();
            window.showModal(this.href);
        });
    });

    const loginModalLink = document.querySelector('#loginModal a[href]');
    if (loginModalLink) {
        loginModalLink.addEventListener('click', function (e) {
            if (modalState.pendingUrl) {
                e.preventDefault();
                window.location.href = this.href + '?redirect=' + encodeURIComponent(modalState.pendingUrl);
            }
        });
    }

    // ── History Modal ──
    const historyFab = document.getElementById('historyFab');
    const historyModal = document.getElementById('historyModal');
    const historyBackdrop = document.getElementById('historyBackdrop');
    const historyClose = document.getElementById('historyClose');

    function openHistory() {
        if (!isAuth) {
            window.showModal(urls.login);
            return;
        }
        historyModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeHistory() {
        historyModal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    if (historyFab) historyFab.addEventListener('click', openHistory);
    if (historyBackdrop) historyBackdrop.addEventListener('click', closeHistory);
    if (historyClose) historyClose.addEventListener('click', closeHistory);
});
