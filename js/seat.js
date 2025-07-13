// document.addEventListener("DOMContentLoaded", () => {
//     const seats = document.querySelectorAll(".seat:not(.occupied)");

//     seats.forEach(seat => {
//         seat.addEventListener("click", () => {
//             seat.classList.toggle("selected");
//         });
//     });
// });
document.addEventListener("DOMContentLoaded", () => {
    const seats = document.querySelectorAll(".seat:not(.ocupado)");

    seats.forEach(seat => {
        seat.addEventListener("click", () => {
            seat.classList.toggle("selected");
        });
    });
});