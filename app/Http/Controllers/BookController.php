<?php

namespace App\Http\Controllers;

use App\Book;
use DiDom\Document;
use mysql_xdevapi\Session;

class BookController extends Controller
{
    public function crawl_list() {
        set_time_limit(300);
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
                'detail_image' => null,
                'quantity' => 30
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
            $final_price = $document->find('.product-item')[$key]->first('.final-price')->text();
            if (isset($final_price)) {
                $explode = explode("-", $final_price);
                $book['final_price'] = trim($explode[0]);
            }
            $price_regular = $document->find('.product-item')[$key]->first('.price-regular')->text();
            if (isset($price_regular)) {
                $book['price_regular'] = trim($price_regular);
            }
            $category = $document->find('.product-item')[$key]->getAttribute('data-category');
            if (isset($category)) {
                $explode = explode("/", $category);
                $arrays = array_slice($explode, 2);
                $tree_category = array();
                foreach ($arrays as $key => $array) {
                    $tree_category[$key]['parent_id'] = $key;
                    $tree_category[$key]['category'] = $array;
                }
                $book['category'] = $tree_category;
            }
            $detail = $this->getBookDetail($book_id);
            if(isset($detail)) {
                $book['detail'] = trim($detail);
            }
            $detail_image = $this->getImageDetail($book_id);
            if(isset($detail_image)) {
                $book['detail_image'] = trim($detail_image);
            }
            $bookData = new Book();
            $data = $bookData->getDatabase();
            $data->push($book);
        }
        dd($books);
    }

    public function getDetail ($id) {
        $url = "https://tiki.vn/chao-mung-den-voi-n-h-k-p".$id.".html?src=category-page-8322.316&2hi=1";
        $html = $this->getHtml($url);
        return $document1 = new Document($html);
    }

    public function getBookDetail ($id) {
        $document2 = $this->getDetail($id);
        return $details = $document2->first('div#gioi-thieu')->html();
    }

    public function getImageDetail ($id) {
        $document3 = $this->getDetail($id);
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
