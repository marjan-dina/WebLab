const container = document.getElementById("box-container");

for (let i = 1; i <= 10; i++) {
  const box = document.createElement("div");
  box.classList.add("box");
  box.textContent = `This is box ${i}`;
  box.style.backgroundColor = i % 2 === 0 ? "aqua" : "orange";
  container.appendChild(box);
}
