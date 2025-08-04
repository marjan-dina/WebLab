// Items array
const items = [
    { name: "Apple", price: 100 },
    { name: "Banana", price: 50 },
    { name: "Mango", price: 150 },
    { name: "Orange", price: 80 }
];
const discounts = [10, 60, 30, 9];

const offerApplied = [true, false, true, true];

const itemList = document.getElementById("itemList");

for (let i = 0; i < items.length; i++) {
    let originalPrice = items[i].price;
    let finalPrice = originalPrice;

    if (offerApplied[i]) {
        finalPrice = originalPrice - (originalPrice * discounts[i] / 100);
    }

    const listItem = document.createElement("li");
    listItem.textContent = `${items[i].name} - Original: $${originalPrice.toFixed(2)}, Final: $${finalPrice.toFixed(2)} (Discount: ${offerApplied[i] ? discounts[i] + '%' : 'None'})`;
    itemList.appendChild(listItem);
}
