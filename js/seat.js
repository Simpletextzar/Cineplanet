// document.addEventListener("DOMContentLoaded", () => {
//     const seats = document.querySelectorAll(".seat:not(.occupied)");

//     seats.forEach(seat => {
//         seat.addEventListener("click", () => {
//             seat.classList.toggle("selected");
//         });
//     });
// });
document.addEventListener("DOMContentLoaded", () => {
  const seats = document.querySelectorAll(".seat input[type='checkbox']:not(:disabled)");

  seats.forEach(seatInput => {
    seatInput.addEventListener("change", () => {
      seatInput.parentElement.classList.toggle("selected", seatInput.checked);
    });
  });
});
