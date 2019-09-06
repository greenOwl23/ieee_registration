// SRC: https://sabe.io/tutorials/how-to-create-modal-popup-box
var modal = document.querySelector(".cmodal");
var trigger = document.querySelector(".trigger");
var closeButton = document.querySelector(".close-button");

function toggleModal() {
    modal.classList.toggle("show-cmodal");
    setTimeout(function() {
        modal.classList.toggle("show-cmodal");
    }, 1800);
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}
closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);

