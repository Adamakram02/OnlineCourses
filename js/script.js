let body = document.body;

let profile = document.querySelector(".header .flex .profile");

document.querySelector("#user-btn").onclick = () => {
  profile.classList.toggle("active");
  searchForm.classList.remove("active");
};

let searchForm = document.querySelector(".header .flex .search-form");
