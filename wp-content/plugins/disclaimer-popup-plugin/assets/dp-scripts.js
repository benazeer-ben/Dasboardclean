jQuery(window).on('load', function () {
    var modal = document.getElementById("myModal");
    var close = document.getElementsByClassName("modal-footer")[0];
    close.onclick = function () {
        modal.style.display = "none";
    }
});


