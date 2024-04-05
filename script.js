document.addEventListener('DOMContentLoaded', function () {
    var username = localStorage.getItem('username');
    if (username) {
        document.getElementById('username').textContent = username;
    }
});

var sidebar = document.getElementById('sidebar');
var menuIcon = document.getElementById('menu-icon');

menuIcon.addEventListener('click', function () {
    sidebar.classList.toggle('show');
});

// vaiiiiiii Fffechar o menu quando um item for clicado
var menuItems = document.querySelectorAll('.sidebar ul li');
menuItems.forEach(function (item) {
    item.addEventListener('click', function (e) {
        if (e.target.nextElementSibling && e.target.nextElementSibling.classList.contains('dropdown')) {
            e.target.nextElementSibling.classList.toggle('show');
        }
    });
});
document.getElementById('menu-icon').addEventListener('click', function () {
    var mainContent = document.getElementById('main-content');
    mainContent.classList.toggle('shifted');
});