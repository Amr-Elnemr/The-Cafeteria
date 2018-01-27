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

                ordersNames[i].children[1].children[0].value = Number(ordersNames[i].children[1].children[0].value) + 1;
                let sum = ordersNames[i].children[2].children[0].textContent;
                sum = sum.split(" ");
                sum = Number(sum[1]) + Number(product[1]);
                totalOrders[`${product[0]}`] = sum;
                ordersNames[i].children[2].children[0].innerHTML = "EPG " + sum;
                computeCheck();
                return;
            }
        }

        let order = document.createElement('tr');
        let orderName = document.createElement('b');
        let orderNameCol = document.createElement('td');
        let amount = document.createElement("input");
        let amountCol = document.createElement('td');
        let price = document.createElement("b");
        let priceCol = document.createElement('td');
        let remove = document.createElement("button");
        let removeCol = document.createElement('td');
        let hidden = document.createElement("input");

        hidden.setAttribute("type", "hidden");
        hidden.setAttribute("name", "products[]");
        hidden.setAttribute("value", product[0]);

        amount.type = "number";
        amount.value = "1";
        amount.min = "1";
        amount.onkeydown="return false";
        amount.setAttribute("name", "count[]");
        amountCol.appendChild(amount);

        orderName.textContent = product[0];
        orderName.setAttribute("name", event.target.name);
        orderNameCol.appendChild(orderName);
        orderNameCol.style["background-color"] ="#0f0";
        //orderName.style.display = "inline-block";

        price.style.display = "inline-block";
        price.textContent = "EPG " + product[1];
        priceCol.appendChild(price);

        remove.textContent = "remove";
        remove.id = product[0];
        removeCol.appendChild(remove);

        order.classList.add("ordersnames");

        order.appendChild(orderNameCol);
        order.appendChild(amountCol);
        order.appendChild(priceCol);
        order.appendChild(removeCol);
        order.style['margin-bottom'] = "25px"
        orders.appendChild(order);
        orders.appendChild(hidden);

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
        order = order.parentElement;
        let orderName = order.children[0];
        orderName = orderName.children[0];
        orderName = orderName.getAttribute("name");
        orderName = orderName.split("-");
        delete totalOrders[`${orderName[0]}`];
        orders.removeChild(order);
        computeCheck();
    }

}

function increaseOrder(event){
    let newNumber = event.target.value;
    if(typeof newNumber == "number"){
        let order = event.target.parentElement.parentElement.children;
        let product = order[0].children[0].getAttribute("name");
        product = product.split("-");
        let sum = Number(product[1]) * Number(newNumber);
        totalOrders[`${product[0]}`] = sum;
        computeCheck();
        order[2].children[0].innerHTML = "EPG " + sum;
    }
}

function computeCheck() {
    let totalPrice = 0;
    for (let price in totalOrders){
        totalPrice += Number(totalOrders[price]);
    }
    document.getElementById("totalprice").textContent = "EPG " + totalPrice;
}
