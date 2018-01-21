document.getElementById("products").addEventListener("click", addOrder);
document.getElementById("panel").addEventListener("input", increaseOrder);
let orders = document.getElementById('orders');
let numberOfOrders = 0;

function addOrder(event){
    if(event.target.tagName === "IMG"){
        let product = event.target.name;
        product = product.split("-");
        let ordersNames = document.getElementsByClassName("ordersnames");
        for(let i = 0; i < ordersNames.length; i++){

            if(ordersNames[i].children[0].textContent === product[0]){

                ordersNames[i].children[1].value = Number(ordersNames[i].children[1].value) + 1;
                let sum = ordersNames[i].children[2].textContent;
                sum = sum.split(" ");
                sum = Number(sum[1]) + Number(product[1]);
                ordersNames[i].children[2].innerHTML = "EPG " + sum;
                return;
            }
        }

        let order = document.createElement('div');
        let orderName = document.createElement('p');
        let amount = document.createElement("input");
        let price = document.createElement("p");

        amount.type = "number";
        amount.value = "1";
        amount.min = "1";
        amount.onkeydown="return false";
        orderName.textContent = product[0];
        orderName.setAttribute("name", product[1]);
        order.classList.add("ordersnames");
        orderName.style.display = "inline-block";
        price.style.display = "inline-block";
        price.textContent = "EPG " + product[1];
        order.appendChild(orderName);
        order.appendChild(amount);
        order.appendChild(price);
        orders.appendChild(order);
    }
}

function increaseOrder(event){
    let newNumber = event.target.value;
    let order = event.target.parentElement.children;
    let price = order[0].getAttribute("name");
    let sum = Number(price) * Number(newNumber);
    order[2].innerHTML = "EPG " + sum;  

}
