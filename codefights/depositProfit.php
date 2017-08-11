<?php
function depositProfit($deposit, $rate, $threshold) {
    $year = 0;
    $account = $deposit;
    while ($account < $threshold) {
        $account = $account + $account * $rate/100;
        $year++;
    }

    return $year;
}

var_dump(depositProfit(100, 20, 170));