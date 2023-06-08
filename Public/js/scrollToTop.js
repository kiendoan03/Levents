function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}

window.addEventListener("scroll", function() {
    var btnTop = document.getElementById("btnTop");
    if (window.pageYOffset > 100) {
        btnTop.classList.add("show");
    } else {
        btnTop.classList.remove("show");
    }
});