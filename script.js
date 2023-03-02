//Import Data from mysql #TODO
// Dummy data
    products_array = [0, 0, 0, 0, 0, 3, 5, 0, 4, 0, 0, 2, 0, 4, 0, 0, 2, 0, 4, 0, 0, 2, 3, 0, 0, 2, 2, 3, 2, 0, 1, 0];
    products_data = [[0, 'Lays', 5.2, 2], [1, 'Woda', 2.5, 1], [2, 'Dorritos', 6.5, 2], [3, 'Fanta', 4.0, 1], [4, 'Popcorn', 3.0, 2], [5, 'Snickers', 3.5, 1]];

// Vendomat functions
function refresh_products_display(){
    for (let i = 0; i < 32; i++) {
        // Optimized CHAT-GPT code <3 for displaying
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
function order_product(product){
    // Spring animation -TODO
    // for (let i = 0; i < 360; i++) {
    //     document.getElementById("p"+product).getElementsByClassName('product_spring').style.transform = "rotate("+i+"deg)";
    // }
}