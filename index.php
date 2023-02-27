<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <link rel="icon" type="image/x-icon" href="media/favicon.ico">
    <title>Jacob Vending Machine</title>
    <link rel="stylesheet" href="style.css">
    <!-- Importowanie JQuerry i toastr -->
    <link href="js/toastr/toastr.scss" rel="stylesheet" />
    <script src="js/jquery-3.6.1.min.js"></script>
    <script src="js/toastr/toastr.js"></script>
    <script>
        //Opcje toastr
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
</head>

<body>
    <div id="inventory">
        Inventory:
        <div>Items</div>
        <div><img src="media/change.svg" alt="money">10 zł</div>
    </div>
    <section>
        <div id="products_display">
            <table>
                <tr style="height: 16%;">
                    <td id="p0">1</td>
                    <td id="p1">2</td>
                    <td id="p2">3</td>
                    <td id="p3">4</td>
                    <td id="p4">5</td>
                    <td id="p5">6</td>
                    <td id="p6">7</td>
                    <td id="p7">8</td>
                </tr>
                <tr>
                    <td style="height: 3%;"></td>
                </tr>
                <tr style="height: 18%;">
                    <td id="p8">9</td>
                    <td id="p9">10</td>
                    <td id="p10">11</td>
                    <td id="p11">12</td>
                    <td id="p12">13</td>
                    <td id="p13">14</td>
                    <td id="p14">15</td>
                    <td id="p15">16</td>
                </tr>
                <tr>
                    <td style="height: 1%;"></td>
                </tr>
                <tr style="height: 20%;">
                    <td id="p16" colspan="2">17</td>
                    <td id="p17" colspan="2">18</td>
                    <td id="p18" colspan="2">19</td>
                    <td id="p19" colspan="2">20</td>
                </tr>
                <tr>
                    <td style="height: 2%;"></td>
                </tr>
                <tr style="height: 19%;">
                    <td id="p20" colspan="2">21</td>
                    <td id="p21" colspan="2">22</td>
                    <td id="p22" colspan="2">23</td>
                    <td id="p23" colspan="2">24</td>
                </tr>
                <tr>
                    <td style="height: 1%;"></td>
                </tr>
                <tr style="height: 20%;">
                    <td id="p24">25</td>
                    <td id="p25">26</td>
                    <td id="p26">27</td>
                    <td id="p27">28</td>
                    <td id="p28">29</td>
                    <td id="p29">30</td>
                    <td id="p30">31</td>
                    <td id="p31">32</td>
                </tr>
            </table>
        </div>
        <div id="products_chute" class="grab" onclick="claim_product();">
        </div>
        <div id="display">
            HELLO, SELECT PRODUCT
        </div>
        <div id="choose_product_menu">
            <button onclick="keypad_input(1);">1</button>
            <button onclick="keypad_input(2);">2</button>
            <button onclick="keypad_input(3);">3</button>
            <button onclick="keypad_input(4);">4</button>
            <button onclick="keypad_input(5);">5</button>
            <button onclick="keypad_input(6);">6</button>
            <button onclick="keypad_input(7);">7</button>
            <button onclick="keypad_input(8);">8</button>
            <button onclick="keypad_input(9);">9</button>
        </div>
        <div id="choose_product_menu_enter">
            <button onclick="order_product();">BUY</button>
        </div>
        <div id="change_chute" class="cursor-grab" onclick="claim_change();">
            <img src="media/change.svg" alt="change" hidden>
        </div>
        </div>
    </section>
    <!-- DIV FUNCTIONS, disable later -->
    <div id="dev_div"><p>DEV functions</p><span onclick="randomise_products();">randomise_products();</span></br></br><span onclick="refresh_products_display();">refresh_products_display();</span></div>
    <script>
        //Import Data from mysql #TODO
        // Dummy data
            products_array = [0, 0, 0, 0, 0, 3, 5, 0, 4, 0, 0, 2, 0, 4, 0, 0, 2, 0, 4, 0, 0, 2, 3, 0, 0, 2, 2, 3, 2, 0, 1, 0];
            products_data = [[0, 'Lays', 5.2, 2], [1, 'Woda', 2.5, 1], [2, 'Dorritos', 6.5, 2], [3, 'Fanta', 4.0, 1], [4, 'Popcorn', 3.0, 2], [5, 'Snickers', 3.5, 1]];
        // DEV FUNCTIONS
            function randomise_products(){
                for (let i = 0; i < 32; i++) {
                    products_array[i] = 0;
                    if(Math.round(Math.random(1))==1){
                        products_array[i] = parseInt(Math.round(Math.random(1)*(products_data.length-1)));
                    }
                }
                refresh_products_display();
            }
        // Vendomat functions
        function refresh_products_display(){
            for (let i = 0; i < 32; i++) {

                // if(products_array[i]!=0){
                //     // If current products width is 1 then fill all 16
                //     if(i >= 0 && i <= 15){
                //         if(products_data[products_array[i]][3]==1){
                //             document.getElementById("p"+i).innerHTML = "<img class='product_image' src='media/p"+products_array[i]+".png' alt='product'><span class='product_label'>"+i+"; "+products_data[products_array[i]][2].toFixed(2)+"</span>";
                //         }
                //     }
                //     // If current products width is 2 then fill all 8
                //     if(i >= 16 && i <= 23){
                //         // Width 1
                //         if(products_data[products_array[i]][3]==2){
                //             document.getElementById("p"+i).innerHTML = "<img class='product_image' src='media/p"+products_array[i]+".png' alt='product'><span class='product_label'>"+i+"; "+products_data[products_array[i]][2].toFixed(2)+"</span>";
                //         }
                //     }
                //     if(i >= 24 && i <= 31){
                //         if(products_data[products_array[i]][3]==1){
                //                 document.getElementById("p"+i).innerHTML = "<img class='product_image' src='media/p"+products_array[i]+".png' alt='product'><span class='product_label'>"+i+"; "+products_data[products_array[i]][2].toFixed(2)+"</span>";
                //         }
                //     }
                // }
                // else{
                //     document.getElementById("p"+i).innerHTML = "";
                // }

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
                        element.innerHTML = `<img class='product_image' src='media/p${products_array[i]}.png' alt='product'><span class='product_label'>${i}; ${product[2].toFixed(2)}</span>`;
                        }
                    }
                } else {
                document.getElementById("p" + i).innerHTML = "";
                }
            }
        }
        refresh_products_display();
        function order_product(product){
            // Spring animation
            for (let i = 0; i < 360; i++) {
                document.getElementById("p"+product).getElementsByClassName('product_spring').style.transform = "rotate("+i+"deg)";
                
            }
        }
    </script>
</body>

</html>

<!-- <?php
    // $con = mysqli_connect('localhost', 'root', '', 'vendomat');
    // $query = mysqli_query($con, "Select * from produkty;");
    // $fetch_all = mysqli_fetch_all($query, MYSQLI_ASSOC);

    // for ($i = 0; $i < count($fetch_all); $i++) {
    //     echo "<td>" . $fetch_all[$i]['nazwa'] . "<br>" . $fetch_all[$i]['cena'] . "</td>";
    // }
    // mysqli_close($con);
    // var_dump($fetch_all);
    // echo "<script>toastr['error']('You dont have enough funds to transfer');</script>";
?> -->