<?php

include_once 'config.php';

const DATE_FORMAT = 'Y-m-d H:i:s';
const LOG_FILENAME = 'logs.txt';

function sendTheFormOfTheWeek() {
    // Get the products of the week :

    // Get the Google form of the week :

    // Get the text to send of the week :

    // Send the text of the week :

}

function log($message) {
    $dateTimeNow = new DateTime('NOW');
    file_put_contents(LOG_FILENAME, $dateTimeNow->format(DATE_FORMAT) . ': ' .$message . '\n', FILE_APPEND);
}

sendTheFormOfTheWeek();
