// Banner images
const bannerImages = [
  'images/banner1.jpg'
];
let currentIndex = 0;
function changeBanner() {
  const banner = document.getElementById('bannerImage');
  if (banner) {
    banner.style.backgroundImage = `url('${bannerImages[currentIndex]}')`;
    currentIndex = (currentIndex + 1) % bannerImages.length;
  }
}
setInterval(changeBanner, 3000);
changeBanner();

// Product data
const products = [
  {
    name: "Product One",
    price: 24.99,
    discount: 10,
    image: "images/banana.jpg"
  },
  {
    name: "Product Two",
    price: 29.99,
    discount: 20,
    image: "images/watermelon.jpg"
  },
  {
    name: "Product Three",
    price: 19.99,
    discount: 15,
    image: "images/apple.jpg"
  },
  {
    name: "Product Four",
    price: 34.99,
    discount: 5,
    image: "images/strawberry.jpg"
  }
];

const container = document.getElementById("product-list");
let cartCount = 0;

products.forEach(product => {
  const card = document.createElement("div");
  card.className = "card";

  const discountAmount = product.price * (product.discount / 100);
  const discountedPrice = (product.price - discountAmount).toFixed(2);

  card.innerHTML = `
    <div class="discount-badge">${product.discount}% OFF</div>
    <img src="${product.image}" alt="${product.name}">
    <h3>${product.name}</h3>
    <div class="price">
      <span class="original-price">$${product.price.toFixed(2)}</span><br>
      <span class="discounted-price">$${discountedPrice}</span>
    </div>
    <button class="order-btn">Order Now</button>
  `;

  card.querySelector(".order-btn").addEventListener("click", () => {
    cartCount++;
    document.getElementById("cart-count").innerText = cartCount;
  });

  container.appendChild(card);
});
