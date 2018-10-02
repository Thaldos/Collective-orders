<?php

include_once 'config.php';
require 'library/dom-crawler/vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

const DATE_FORMAT = 'Y-m-d H:i:s';
const LOG_FILENAME = 'logs.txt';

/**
 * Fetch the products data, create the related google form and send the form with text to EMAIL_TO.
 */
function sendTheForm() {
    // Get the products :
    $products = getProducts(URL_TO_BE_PARSED);

    // Get the Google form :


    // Get the text to send :

    // Send the text :

}

/**
 *
 */
function getProducts($urlToBeParsed): array {
    $products =  [];

    // Get html of url :
    $html = getHtml($urlToBeParsed);

    $crawler = new Crawler($html);
    $crawler = $crawler->filter('.product');
    $products = $crawler->each(
        function (Crawler $crawler, $i) {
            // Get the name :
            $title = $crawler->filter(".woocommerce-loop-product__title");
            $small = $crawler->filter('small');
            $pos = strpos($title->text(), $small->text());
            $name = substr_replace($title->text(), "", $pos);

            // Get the link :
            $link = $crawler->filter(".woocommerce-LoopProduct-link");

            // Get the description :
            $description = $small->text();
            $description = trim(preg_replace('/Composition(.*?):/', "", $description));

            // Get the price :
            $price = $crawler->filter(".woocommerce-Price-amount");
            return array(
                'name'        => trim($name),
                'description' => $description,
                'price'       => $price->text(),
                'url'         => $link->attr('href')
            );
        }
    );

    return $products;
}

/**
 * Get html of given url.
 */
function getHtml($url) {
    $html = '';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $html = curl_exec($ch);
    curl_close($ch);

    return $html;
}

/**
 * Log the message in LOG_FILENAME.
 */
function logThat(string $message): void {
    $dateTimeNow = new DateTime('NOW');
    file_put_contents(LOG_FILENAME, $dateTimeNow->format(DATE_FORMAT) . ' : ' .$message . "\n", FILE_APPEND);
}

// Fetch the products data, create the related google form and send the form with text to EMAIL_TO :
sendTheForm();
