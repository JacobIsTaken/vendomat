// Import Data from mysql #TODO
// Dummy data
    products_array = [0, 0, 0, 0, 0, 3, 5, 0, 4, 0, 0, 2, 0, 4, 0, 0, 2, 0, 4, 0, 0, 2, 3, 0, 0, 2, 2, 3, 2, 0, 1, 0];
    products_data = [[0, 'Lays', 5.2, 2], [1, 'Woda', 2.5, 1], [2, 'Dorritos', 6.5, 2], [3, 'Fanta', 4.0, 1], [4, 'Popcorn', 3.0, 2], [5, 'Snickers', 3.5, 1]];
    display_data = "HELLO, SELECT PRODUCT";
    inventory_balance = 100;
    vendomat_balance = 0;
// Vendomat functions
function refresh_products_display(){ // Displays the products on the vendomat using products_array and products_data variables
    for (let i = 0; i < 32; i++) {
        // Optimized CHAT-GPT code <3
        if (products_array[i] != 0) {
            const product = products_data[products_array[i]];
            const isWidth1 = product[3] == 1;
            const element = document.getElementById("p" + i);

            if ((i >= 0 && i <= 15) || (i >= 24 && i <= 31)) {
                if (isWidth1) {
                element.innerHTML = `<img class='product_image' src='media/p${products_array[i]}.png' alt='product'><span class='product_label'>${i}; ${product[2].toFixed(2)}</span><img class='product_spring' src='media/spring.png'>`;
                }
            } else if (i >= 16 && i <= 23) {
                if (!isWidth1) {
                element.innerHTML = `<img class='product_image' src='media/p${products_array[i]}.png' alt='product'><span class='product_label'>${i}; ${product[2].toFixed(2)}</span><img class='product_spring' src='media/double_spring.png'>`;
                }
            }
        } else {
        document.getElementById("p" + i).innerHTML = "";
        }
    }
}
refresh_products_display();
function update_display(){ // Updating displays every 400ms
    document.getElementById("inventory_balance").innerHTML = inventory_balance + " zł";
    document.getElementById("display").innerHTML = display_data;
    document.getElementById("display_balance").innerHTML = "Balance: "+vendomat_balance;
    if(vendomat_balance>0)
        document.getElementById("change_chute").innerHTML = "<img src='media/change.svg' alt='change'</img>";
    else
        document.getElementById("change_chute").innerHTML = "";
    setTimeout(update_display,400);
}
window.onload = update_display; // Caling the upper function when site loads

function insert_money(){ // Lets the user insert money
    let transfer = parseInt(prompt("How much money do you want to deposit into Vendomat?",10,0))
    if (inventory_balance - transfer<0){
        alert("You don't have enough money.")
    }
    else{
        vendomat_balance += transfer;
        inventory_balance -= transfer;
    }
}
product_id = "";
function keypad_input(x){
    product_id += x;
    display_data = "SELECTED: "+product_id; 
}
function clear_id(){
    product_id = "";
    display_data = "SELECTED: "+product_id;
}

function order_product(){
    if(parseInt(product_id)<32 && products_array[parseInt(product_id)] != 0){
        if(products_data[products_array[parseInt(product_id)]][2] < vendomat_balance){
            // Showing notification
            toastr['success']('You bought '+products_data[products_array[parseInt(product_id)]][1]+"!");
            // Subtracting product vallue from balance 
            vendomat_balance -= products_data[products_array[parseInt(product_id)]][2];
            // Adding bought product to inventory
            document.getElementById("inventory").innerHTML += "<p><img class='inventory_image' src='media/p"+products_data[products_array[parseInt(product_id)]][0]+".png' alt='produkt'></p>";
            // Removing product from vendomat
            products_array[parseInt(product_id)] = 0;
            refresh_products_display();
            // Updating display
            product_id = "";
            display_data = "THANK YOU FOR BUYING!";
            setTimeout(function(){display_data = "HELLO, SELECT PRODUCT"},5000);
        }
        else{
            toastr['error']("You don't have enough money to buy "+products_data[products_array[parseInt(product_id)]][1]+"!");
            product_id = "";
            display_data = "ERROR, TRY AGAIN";
            setTimeout(function(){display_data = "HELLO, SELECT PRODUCT"},2000);
        }
    }
    else{
        toastr['error']("Enter correct product ID");
        product_id = "";
        display_data = "ERROR, TRY AGAIN";
        setTimeout(function(){display_data = "HELLO, SELECT PRODUCT"},2000);
    }
}

function claim_change(){ // Lets the user claim money back
    inventory_balance += vendomat_balance;
    vendomat_balance = 0;
}

function claim_product(){
    toastr['warning']("TO-DO, DO ZROBIENIA");
}