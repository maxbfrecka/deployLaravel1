<?php

//helps functions
//need to worry about composer.json
//files array tells laravel to autoload it

function asDollars($price){
    if ($price<0) return "-".asDollars(-$price);
    return '$' . number_format($price/100, 2);
}
