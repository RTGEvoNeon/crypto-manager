
<?php

function add_coin(&$coin_list, $name, $average_price, $number_of_coins) {
    if ($coin_list[$name]) {
        $deposit = $coin_list[$name][1] * $coin_list[$name][0];
        $new_deposit = $average_price * $number_of_coins;

        $final_deposit = $deposit + $new_deposit;
        $final_numbers_of_coins = $coin_list[$name][1] + $number_of_coins;
        $final_average_price = $final_deposit / $final_numbers_of_coins;
        $coin_list[$name] = [$final_average_price, $final_numbers_of_coins];
    } else {
        $coin_list[$name] = [$average_price, $number_of_coins];
    } 
    }
    

$file = 'coin_list.txt';
$data = [];
if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
}

echo "Ваш портфель:";
print_r($data);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $count = htmlspecialchars($_POST['count']);
    add_coin($data, $name, $price, $count);
}

file_put_contents($file, json_encode($data));

?>