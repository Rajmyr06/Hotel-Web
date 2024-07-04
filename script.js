window.addEventListener("scroll", function () {
  var header = document.querySelector(".header");
  if (window.scrollY > 100) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});
// Seleksi elemen yang ingin di-animasi
const aboutContent = document.querySelector(".about-content");
const aboutImage = document.querySelector(".about-image");
const aboutText = document.querySelectorAll(".about-text div");

// Fungsi untuk menganimasi elemen
function animateElements() {
  // Ambil posisi scroll saat ini
  const scrollPosition = window.scrollY;

  // Ambil tinggi elemen about-content
  const aboutContentHeight = aboutContent.offsetHeight;

  // Ambil posisi elemen about-content
  const aboutContentPosition = aboutContent.offsetTop;

  // Cek apakah elemen about-content sudah di-scroll ke atas
  if (scrollPosition > aboutContentPosition - aboutContentHeight) {
    // Animasi elemen about-image
    aboutImage.classList.add("animate-from-right");

    // Animasi elemen about-text
  }
}

// Tambahkan event listener untuk scroll
window.addEventListener("scroll", animateElements);

// Tambahkan animasi awal ketika halaman di-load
animateElements();

const roomList = document.querySelectorAll(".room-list li");
const bookingSection = document.getElementById("ketersediaan");

// Add a class to hide the images initially
roomList.forEach((room, index) => {
  room.classList.add("animate");
  setTimeout(() => {
    room.classList.remove("animate");
  }, 500 * (index + 1));
});
const observer = new IntersectionObserver(
  (entries) => {
    if (entries[0].isIntersecting) {
      animateRoomList();
    }
  },
  { threshold: 1.0 }
);

observer.observe(bookingSection);

function animateRoomList() {
  roomList.forEach((room, index) => {
    room.classList.remove("hidden");
    room.style.opacity = 0;
    room.style.transform = "translateY(20px)";
    setTimeout(() => {
      room.style.opacity = 1;
      room.style.transform = "translateY(0)";
    }, 500 * (index + 1));
  });
}
