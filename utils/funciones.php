<?php

function secure($text){
    return htmlspecialchars(stripslashes(trim($text)));
}