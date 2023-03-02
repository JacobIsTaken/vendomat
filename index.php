<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <link rel="icon" type="image/x-icon" href="media/favicon.ico">
    <title>Jacob Vending Machine</title>
    <link rel="stylesheet" href="style.css">
    <!-- Importing JQuerry and toastr -->
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
    <!-- Importing vendomat functions -->
    <script src="script.js" defer></script>
</head>

<body>
    <div id="inventory">
        <p>Your Items:</p>
        <p>
            <img src="media/change.svg" alt="money">
            <span id="inventory_balance">100 zł</span>    
        </p>
        <div>Items</div>
        <!-- <div>
            <img src="media/change.svg" alt="money">10 zł
        </div> -->
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
        <div id="display_balance">
            Balance: 0
        </div>
        <div id="money_chute" onclick="insert_money();">
        </div>

        <div id="choose_product_menu">
            <button onclick="keypad_input('1');">1</button>
            <button onclick="keypad_input('2');">2</button>
            <button onclick="keypad_input('3');">3</button>
            <button onclick="keypad_input('4');">4</button>
            <button onclick="keypad_input('5');">5</button>
            <button onclick="keypad_input('6');">6</button>
            <button onclick="keypad_input('7');">7</button>
            <button onclick="keypad_input('8');">8</button>
            <button onclick="keypad_input('9');">9</button>
            <button></button>
            <button onclick="keypad_input('0');">0</button>
            <button></button>
        </div>
        <button id="clear_id_button" onclick="clear_id();">
            CLEAR
        </button>
        <div id="choose_product_menu_enter">
            <button onclick="order_product();">BUY</button>
        </div>
        <div id="change_chute" class="cursor-grab" onclick="claim_change();">
            <!-- <img src="media/change.svg" alt="change"> -->
        </div>
        </div>
    </section>
    <!-- DEV FUNCTIONS, delete later -->
    <div id="dev_div">
        <p>DEV functions</p><span onclick="randomise_products();">randomise_products();</span></br></br><span onclick="refresh_products_display();">refresh_products_display();</span></br></br><span onclick="clear_balance();">clear_balance();</span>
    </div>
    <script> // DEV FUNCTIONS
        function randomise_products(){
            for (let i = 0; i < 32; i++) {
                products_array[i] = 0;
                if(Math.round(Math.random(1))==1){
                    products_array[i] = parseInt(Math.round(Math.random(1)*(products_data.length-1)));
                }
            }
            refresh_products_display();
        }
        function clear_balance(){ // Dev Sets balance to 0
            vendomat_balance = 0;
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