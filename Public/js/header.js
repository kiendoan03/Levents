// Lấy đối tượng cần ẩn đi
var option = document.getElementById("option");

// Bắt sự kiện cuộn trang
window.addEventListener("scroll", function() {
    // Nếu cuộn trang xuống đủ xa để ẩn đi đối tượng
    if (window.scrollY > 100) {
        option.style.display = "none";
        // Bắt sự kiện di chuột vào đối tượng logo
        var logo = document.getElementById("logo");
        logo.addEventListener("mouseover", function(event) {
            option.style.display = ""; // Hiển thị đối tượng option
            option.addEventListener("mouseover", function(event) {
                option.style.display = ""; // Hiển thị đối tượng option
            });
            // Bắt sự kiện di chuột ra khỏi đối tượng option
            option.addEventListener("mouseout", function(event) {
                option.style.display = " none "; // Ẩn đi đối tượng option
            });
        });
    } else {
        option.style.display = ""; // Thay đổi thuộc tính display để hiển thị lại đối tượng
    }
});