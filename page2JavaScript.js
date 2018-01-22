document.getElementById("products").addEventListener("click", addOrder);
document.getElementById("panel").addEventListener("input", increaseOrder);
document.getElementById("panel").addEventListener("click", remove);
let orders = document.getElementById('orders');
let totalOrders = {};

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
                totalOrders[`${product[0]}`] = sum;
                ordersNames[i].children[2].innerHTML = "EPG " + sum;
                computeCheck();
                return;
            }
        }

        let order = document.createElement('div');
        let orderName = document.createElement('p');
        let amount = document.createElement("input");
        let price = document.createElement("p");
        let remove = document.createElement("button");

        amount.type = "number";
        amount.value = "1";
        amount.min = "1";
        amount.onkeydown="return false";

        orderName.textContent = product[0];
        orderName.setAttribute("name", event.target.name);
        orderName.style.display = "inline-block";

        price.style.display = "inline-block";
        price.textContent = "EPG " + product[1];

        remove.textContent = "remove";
        remove.id = product[0];

        order.classList.add("ordersnames");

        order.appendChild(orderName);
        order.appendChild(amount);
        order.appendChild(price);
        order.appendChild(remove);
        orders.appendChild(order);

        totalOrders[`${product[0]}`] = product[1];
        computeCheck();

        document.getElementById('notes').style.display = "block";
        document.getElementById('room').style.display = "block";

    }
}

function remove(event){
    if(event.target.tagName === "BUTTON"){        
        let order = document.getElementById(event.target.getAttribute("id"));
        order = order.parentElement;
        let orderName = order.children[0];
        orderName = orderName.getAttribute("name");
        orderName = orderName.split("-");
        delete totalOrders[`${orderName[0]}`];
        orders.removeChild(order);
        computeCheck();
    }

}

function increaseOrder(event){
    let newNumber = event.target.value;
    let order = event.target.parentElement.children;
    let product = order[0].getAttribute("name");
    product = product.split("-");
    let sum = Number(product[1]) * Number(newNumber);
    totalOrders[`${product[0]}`] = sum;
    computeCheck();
    order[2].innerHTML = "EPG " + sum;
}

function computeCheck() {
    let totalPrice = 0;
    for (let price in totalOrders){
        totalPrice += Number(totalOrders[price]);
    }
    document.getElementById("totalprice").textContent = "EPG " + totalPrice;
}
