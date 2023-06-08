   // Lấy tất cả các đối tượng có class là "quantity"
   const quantityContainers = document.querySelectorAll(".quantity");

   // Lặp qua tất cả các đối tượng và thêm các sự kiện click vào từng đối tượng riêng lẻ
   quantityContainers.forEach((container) => {
       const plusBtn = container.querySelector(".plus-btn");
       const minusBtn = container.querySelector(".minus-btn");
       const quantityInput = container.querySelector("input[name='quantity']");

       plusBtn.addEventListener("click", () => {
           let currentValue = parseInt(quantityInput.value);
           if (currentValue < 1000) {
               quantityInput.value = ++currentValue;
           }
       });

       minusBtn.addEventListener("click", () => {
           let currentValue = parseInt(quantityInput.value);
           if (currentValue > 1) {
               quantityInput.value = --currentValue;
           }
       });
   });