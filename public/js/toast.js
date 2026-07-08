function showToast(message, type = 'error') {
    const container = document.getElementById('toastContainer');
    const icons = {
        error: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        success: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
    };

    const toast = document.createElement('div');
    toast.className = 'toast toast-' + type;
    toast.innerHTML =
        '<div class="toast-icon">' + (icons[type] || icons.error) + '</div>' +
        '<div class="toast-body">' + message + '</div>' +
        '<button class="toast-close" onclick="this.closest(\'.toast\').classList.add(\'hide\');setTimeout(()=>this.closest(\'.toast\').remove(),400)">' +
        '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>' +
        '<div class="toast-progress"></div>';

    container.appendChild(toast);

    requestAnimationFrame(() => {
        toast.classList.add('show');
        const bar = toast.querySelector('.toast-progress');
        requestAnimationFrame(() => { bar.style.width = '100%'; });
    });

    setTimeout(() => {
        toast.classList.add('hide');
        setTimeout(() => toast.remove(), 400);
    }, 3500);
}
