// function reset() {
//     document.querySelectorAll("li").forEach(li => {
//         li.classList.remove("active")
//     })
// }

// document.querySelectorAll("li").forEach(li => {
//     li.addEventListener("click", () => {
//         reset()
//         li.classList.add("active")
//     })
// })

var sidebar = document.getElementById('sidebar');
var openSidebar = document.getElementById('openSidebar');
var closeSidebar = document.getElementById('closeSidebar');

openSidebar.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
});

closeSidebar.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
});
