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
$("#dropdown_entry").on("click", function(e) {
    e.preventDefault();
    $(".dropdown_entry").toggle('hidden');
    $("#dropdown_entry > svg").toggleClass('rotate-90');
})
$("#dropdown_create").on("click", function(e) {
    e.preventDefault();
    $(".dropdown_create").toggle('hidden');
    $("#dropdown_create > svg").toggleClass('rotate-90');
})

var sidebar = document.getElementById('sidebar');
var openSidebar = document.getElementById('openSidebar');
var closeSidebar = document.getElementById('closeSidebar');

openSidebar.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
});

closeSidebar.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
});
