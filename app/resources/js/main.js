const modal = document.getElementById("myModal");
const span = document.getElementById("close");

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

addEventListener("click", function (event) {

    if (event.target.className === "btn btn-dark") {
        modal.style.display = "block";
        let anchor = document.getElementById('delete_link');
        anchor.href = "delete?id=" + event.target.value;
    }
})

//
// var myModal = document.getElementById('myModal')
// var myInput = document.getElementById('myInput')
//
// myModal.addEventListener('shown.bs.modal', function () {
//     myInput.focus()
// })


const form = document.getElementById('upload_form');






