// const allSideMenu = document.querySelectorAll("#sidebar .menu a");

// allSideMenu.forEach((item) => {
//   const a = item.parentElement;

//   item.addEventListener("click", function () {
//     allSideMenu.forEach((i) => {
//       i.parentElement.classList.remove("active");
//     });
//     a.classList.add("active");
//   });
// });

// TOGGLE SIDEBAR
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});


