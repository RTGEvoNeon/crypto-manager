
<?php

$coin_list = [
    'ATOM'=>[50, 50],
    'DOT'=>[50, 50],
    'STRK'=>[50, 50],
    'SOL'=>[50, 50],
];

$coin_list += array('TON'=>[100, 200]);

print_r($coin_list);

function add_coin($name, $average_price, $number_of_coins) {
    $coin_list[$name] = [$average_price, $number_of_coins];
}
add_coin("TUT", 123, 123);
print_r($coin_list);

// echo add_coin('SOL', 123, 123);


// print_r($coin_list);

// ?>