"use-strict";

const input_area = document.querySelectorAll(".input-area");
console.log(input_area);

const print_func = function (input_area, value, i) {
  input_area[i].placeholder = value;
};

document.querySelector(".button").addEventListener("click", function (e) {
  for (var i = 0; i < input_area.length; i++) {
    if (input_area[i].value === "") {
      if (i === 0) {
        e.preventDefault();
        print_func(input_area, "Hãy nhập tên tài khoản", i);
      } else if (i === 1) {
        e.preventDefault();
        print_func(input_area, "Hãy nhập mật khẩu", i);
      } else if (i === 2) {
        e.preventDefault();
        print_func(input_area, "Hãy nhập họ của bạn", i);
      } else if (i === 3) {
        e.preventDefault();
        print_func(input_area, "Hãy nhập tên của bạn", i);
      }
    } else {
      if (i === 1 && input_area[i].value.length <= 6) {
        e.preventDefault();
        window.alert("Mật khẩu quá yếu");
        input_area[i].value = "";
      }
    }
  }
});
