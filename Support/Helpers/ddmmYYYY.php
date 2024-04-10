<?php

function ddmmYYYY(string $date) {
    return date('d/m/Y H:m:s', strtotime($date));
}