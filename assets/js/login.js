"use strict";

const username = document.querySelector(".username");
const password = document.querySelector(".password");

document
  .querySelector(".dang-nhap-button")
  .addEventListener("click", function (e) {
    if (username.value === "") {
      e.preventDefault();
      username.placeholder = "Hãy nhập tài khoản của bạn";
    }

    if (password.value === "") {
      e.preventDefault();
      password.placeholder = "Hãy nhập mật khẩu của bạn";
    }
  });
