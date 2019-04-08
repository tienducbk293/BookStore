<?php
/**
 * Created by PhpStorm.
 * User: Viem De
 * Date: 11/03/2019
 * Time: 3:34 PM
 */
require 'vendor/autoload.php';
use DiDom\Document;
use Curl\Curl;

function DiDom($url) {
    $url = "https://tiki.vn/sach-truyen-tieng-viet/c316?src=tree&_lc=Vk4wMzQwMjUwMDU%3D&page=1";
    $document = new Document($url);
    $books = $document->find('div.product-item');
    foreach ($books as $book) {
        $book = trim($document->first('.product-image img-responsive'));
        var_dump($book);
        $book = trim($document->first('.title'));
        var_dump($book);
        $book = trim($document->first('.author'));
        var_dump($book);
        $book = trim($document->first('.final-price'));
        var_dump($book);
        $book = trim($document->first('.price-regular'));
        var_dump($book);

    }
    var_dump($books);
}
