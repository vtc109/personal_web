"use-strict";

const sub_user_nav = document.querySelector(".sub_user_nav");
const navbar = document.querySelector(".navbar");
const avatar = document.querySelector(".avatar");
// let a = 0;
document.querySelector(".avatar").addEventListener("click", function () {
  const check = sub_user_nav.style.display;
  console.log(check);
  if (!sub_user_nav.style.display || sub_user_nav.style.display === "none") {
    sub_user_nav.style.display = "block";
  } else {
    sub_user_nav.style.display = "none";
  }
});

const handleOver = function (opacity, e) {
  if (e.target.classList.contains("nav_link")) {
    const link = e.target;
    const siblings = link.closest(".navbar").querySelectorAll(".nav_link");

    siblings.forEach((element) => {
      if (element !== link) element.style.opacity = opacity;
    });
  }
};

navbar.addEventListener("mouseover", function (e) {
  // console.log("Mouse over");
  handleOver(0.6, e);
});

navbar.addEventListener("mouseout", function (e) {
  // console.log("mouse out");
  handleOver(1, e);
});
