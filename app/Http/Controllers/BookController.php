<?php

namespace App\Http\Controllers;

require_once('../vendor/autoload.php');

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use DiDom\Document;
use Curl\Curl;

class BookController extends Controller
{
    public function crawl_list() {
        set_time_limit(240);
        $target = "https://tiki.vn/sach-truyen-tieng-viet/c316?src=tree&_lc=Vk4wMzQwMjUwMDU%3D&page=1";
        $document = new Document($target, true);
        $books = $document->find('.product-item');
        foreach ($books as $key => $book) {
            $book = array(
                'book_id' => null,
                'image' => null,
                'title' => null,
                'author' => null,
                'final_price' => null,
                'price_regular' => null,
                'category' => null,
                'detail' => null,
                'detail_image' => null
            );
            $book_id = $document->find('.product-item')[$key]->getAttribute('data-id');
            if (isset($book_id)) {
                $book['book_id'] = trim($book_id);
            }
            $image = $document->find('.product-item')[$key]->first('.product-image')->getAttribute('src');
            if(isset($image)) {
                $book['image'] = trim($image);
            }
            $title = $document->find('.product-item')[$key]->first('.product-item .title');
            if (isset($title)) {
                $book['title'] = trim($title->text());
            }
            $author = $document->find('.product-item')[$key]->first('.product-item .author');
            if (isset($author)) {
                $book['author'] = trim($author->text());
            }
            $final_price = $document->find('.product-item')[$key]->first('.final-price');
            if (isset($final_price)) {
                $book['final_price'] = trim($final_price->text());
            }
            $price_regular = $document->find('.product-item')[$key]->first('.price-regular');
            if (isset($price_regular)) {
                $book['price_regular'] = trim($price_regular->text());
            }
            $category = $document->find('.product-item')[$key]->getAttribute('data-category');
            if (isset($category)) {
                $explode = explode("/", $category);
                $array = array_slice($explode, 2);
                $implode = implode("/", $array);
                $book['category'] = trim($implode);
            }
            $detail = $this->getBookDetail($book_id);
            if(isset($detail)) {
                $book['detail'] = trim($detail);
            }
            $detail_image = $this->getImageDetail($book_id);
            if(isset($detail_image)) {
                $book['detail_image'] = trim($detail_image);
            }
            $firebase = $this->getFirebase();
            $data = $firebase->getDatabase()->getReference('book');
            $data->push($book);
        }
        dd($books);
    }

    public function getDetail ($book_id) {
        $url = "https://tiki.vn/chao-mung-den-voi-n-h-k-p".$book_id.".html?src=category-page-8322.316&2hi=1";
        $html = $this->getHtml($url);
        return $document1 = new Document($html);
    }

    public function getBookDetail ($book_id) {
        $document2 = $this->getDetail($book_id);
        return $details = $document2->first('div#gioi-thieu')->html();
    }

    public function getImageDetail ($book_id) {
        $document3 = $this->getDetail($book_id);
        return $detail_images = $document3->first('.product-magiczoom')->getAttribute('src');
    }

    public function getHtml($url)
    {
        try {
            $curl = new Curl();
            $curl->get($url);
            if($curl->error) {
                echo $curl->errorMessage, PHP_EOL;
                return FALSE;
            }
            return $curl->response;
        } catch (\Exception $exception) {
            echo 'getHtml Exception: '. $exception->getMessage(), PHP_EOL;
        }
    }
}
