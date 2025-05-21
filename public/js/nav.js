function toggleMenu() {
    document.querySelectorAll('.menu').forEach(menu => {
      menu.classList.toggle('show');
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const trigger = document.getElementById('userDropdown');
    const menu = trigger.nextElementSibling;

    trigger.addEventListener('click', (e) => {
        e.preventDefault();
        menu.classList.toggle('show');
    });
    
    document.addEventListener('click', (e) => {
        if (!trigger.contains(e.target) && !menu.contains(e.target)) {
        menu.classList.remove('show');
        }
    });
});