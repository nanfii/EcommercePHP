const links = document.querySelectorAll(".link");
const profileToggle = document.getElementById("profile-toggle");
const miniProfile = document.querySelector(".mini-profile");
const body = document.querySelector("body");
const cartCount = document.querySelector(".top-text");
const listItems = document.querySelectorAll(".list");

const currentURL = window.location.href;
links.forEach((link) => {
  const linkURL = link.querySelector("a").href;
  if (currentURL.includes(linkURL)) {
    link.classList.add("active");
  } else {
    link.classList.remove("active");
  }
});
if (profileToggle) {
  profileToggle.addEventListener("click", () => {
    miniProfile.classList.toggle("show-profile");
  });
}

if (cartCount) {
  if (Number(cartCount.textContent) > 9) {
    cartCount.innerHTML = "9<sup class='plus-icon'>+</sup>";
  }
}

function alertMessage(text, type, destination) {
  const icon =
    type === "fail"
      ? "<i class='fa fa-exclamation-circle'></i>"
      : "<i class='fa fa-check-circle'></i>";
  const html = `
     <div class="alert">
        <p class="icon ${type}">${icon}</p>
        <p class='text'>${text}</p>
        <button class="${type} ok" id="goto">ok</button>
    </div>`;

  body.innerHTML = html;
  document.querySelector("#goto").addEventListener("click", (e) => {
    e.preventDefault();
    window.open(destination, "_self");
  });
}

// toggling the images

const mainImageContainer = document.querySelector("#main-img");
const imagesContainer = document.querySelector(".other-img-container");

imagesContainer.addEventListener("click", (e) => {
  const mainImage = e.target.src;
  mainImageContainer.src = mainImage;
});
