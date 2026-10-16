
window.openTaskModal = function (button) {
    window.openTaskModalUrl(button.dataset.modalUrl);
};

window.openTaskModalUrl = async function (url) {
    const overlay = document.getElementById('taskModal');
    const content = document.getElementById('taskModalContent');

    if (!overlay || !content) {
        console.error('Task modal elements are missing.');
        return;
    }

    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.classList.add('modal-open');

    content.innerHTML = '<p>Loading...</p>';

    try {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html'
            }
        });

        if (!response.ok) {
            throw new Error(`Request failed with status ${response.status}`);
        }

        content.innerHTML = await response.text();
    } catch (error) {
        console.error('Task modal error:', error);
        content.innerHTML =
            '<p>Unable to load this task. Check the browser console.</p>';
    }
};

window.closeTaskModal = function () {
    const overlay = document.getElementById('taskModal');

    if (!overlay) return;

    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('modal-open');
};

document.addEventListener('click', function (event) {
    if (event.target === document.getElementById('taskModal')) {
        window.closeTaskModal();
    }
});

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        window.closeTaskModal();
    }
});
