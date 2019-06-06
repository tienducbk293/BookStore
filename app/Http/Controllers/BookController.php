<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use DiDom\Document;
use Illuminate\Http\Request;
use mysql_xdevapi\Session;
use Curl\Curl;
use Google\Cloud\Firestore\FirestoreClient;
class BookController extends Controller
{
    protected $book = array();
    protected $category = array();
    public function __construct(Book $book, Category $category)
    {
        $this->book = $book;
        $this->category = $category;
    }

    function vn_str_filter ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    public function crawl_list() {
        set_time_limit(300);
        $target = "https://tiki.vn/sach-truyen-tieng-viet/c316?src=tree&_lc=Vk4wMzQwMjUwMDU%3D&page=1";
        $document = new Document($target, true);
        $books = $document->find('.product-item');
        foreach ($books as $key => $book) {
            $book = array(
                'id' => null,
                'book_id' => null,
                'image' => null,
                'title' => null,
                'author' => null,
                'final_price' => null,
                'price_regular' => null,
                'category' => null,
                'slug' => null,
                'detail' => null,
                'detail_image' => null,
                'quantity' => 30
            );

            $book['id'] = $key;
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
                $implode = implode("/", $arrays);
                $book['category'] = trim($implode);
            }
            if (isset($book['category'])) {
                $str = $this->vn_str_filter($book['category']);
                $replace = str_replace(" -", "", $str);
                $explode = explode(" ", strtolower($replace));
                $slug = implode("-", $explode);
                $book['slug'] = $slug;
            }
            $detail = $this->getBookDetail($book_id);
            if(isset($detail)) {
                $book['detail'] = trim($detail);
            }
            $detail_image = $this->getImageDetail($book_id);
            if(isset($detail_image)) {
                $book['detail_image'] = trim($detail_image);
            }
            $this->book->getDatabase()->push($book);
        }
        return $this->book->getAll();
    }

    public function listCategory() {
        $books = $this->book->getAll();
        $datas = array();
        foreach ($books as $key => $book) {
            $arrs = explode("/", $book['category']);
            $slug = explode("/", $book['slug']);
            $tree = array();
            foreach ($arrs as $id => $arr) {
                $c = array();
                if ($id == 0) {
                    $c['category_name'] = $arr;
                    $c['slug'] = $slug[$id];
                    $c['parent'] = 0;
                    $tree[$id] = $c;
                } else {
                    $c['category_name'] = $arr;
                    $c['slug'] = $slug[$id];
                    $c['parent'] = $arrs[$id-1];
                    $tree[$id] = $c;
                }
            }
            $datas[$key] = $tree;
        }
        return $datas;
    }

    public function unique_multi_array($arrays, $key) {
        $unique_array = array();
        $i = 0;
        $key_array = array();

        foreach($arrays as $array) {
            if (!in_array($array[$key], $key_array)) {
                $key_array[$i] = $array[$key];
                $unique_array[$i] = $array;
            }
            $i++;
        }
        return $unique_array;
    }

    public function unique_array() {
        $datas = $this->listCategory();
        $arrays = array();
        $i = 0;
        foreach ($datas as $id => $data) {
            $categories = $data;
            foreach ($categories as $key => $category) {
                $arrays[$i] = $category;
                $i++;
            }
        }
        return $unique_arrays = $this->unique_multi_array($arrays, 'category_name');
    }

    function makeRecursive($unique_array) {
        $merge = array();
        foreach ($unique_array as $unique) {
            isset($merge[$unique['parent']]) ?: $merge[$unique['parent']] = array();
            isset($merge[$unique['category_name']]) ?: $merge[$unique['category_name']] = array();
            $merge[$unique['parent']][] = array_merge($unique, array('children' => &$merge[$unique['category_name']]));
        }
        return $merge[0];
    }

    public function merge() {
        $unique_array = $this->unique_array();
        $merge_arrays = $this->makeRecursive($unique_array);
        foreach ($merge_arrays as $merge_array) {
            $this->category->getDatabase()->push($merge_array);
        }
        return $this->category->getDatabase()->getValue();
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

    public function getList() {
        $list_books = $this->book->getAll();
        return view('admin.book.list', compact('list_books'));
    }

    public function getAdd() {
        $categories = $this->category->getAll();
        return view('admin.book.add', compact('categories'));
    }

    public function postAdd(Request $request) {
        $category = $this->category->getDatabase()->getChild($request->category)->getValue();
        $books = $this->book->getAll();
        foreach ($books as $key => $book) {
            if ($book['book_id'] !== $request->input('book_id')) {
                $book_id = $request->input('book_id');
            }
        }
        $book = [
            'book_id' => $book_id,
            'category' => $category['category_name'],
            'slug' => $category['slug'],
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'price_regular' => $request->input('price_regular'),
            'final_price' => $request->input('final_price'),
            'quantity' => $request->input('quantity'),
            'image' => $request->input('image'),
            'detail_image' => $request->input('detail_image')
        ];
        $this->book->getDatabase()->push($book);
        return redirect()->route('book.list')->with(['flash_message', 'Thêm mới sách thành công']);
    }

    public function getEdit ($id) {
        $categories = $this->category->getAll();
        $child = 'book_id';
        $book = $this->book->orderByChild($child, $id);
        $key = key($book);
        return view('admin.book.edit', compact('book', 'categories', 'key'));
    }

    public function postEdit (Request $request, $id, $key) {
        $category = $this->category->getDatabase()->getChild($request->category)->getValue();
        $book = [
            'book_id' => $id,
            'category' => $category['category_name'],
            'slug' => $category['slug'],
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'price_regular' => $request->input('price_regular'),
            'final_price' => $request->input('final_price'),
            'quantity' => $request->input('quantity'),
            'image' => $request->input('image'),
            'detail_image' => $request->input('detail_image')
        ];
        $this->book->getDatabase()->getChild($key)->set($book);
        return redirect()->route('book.list')->with(['flash_message', 'Thay đổi thông tin thành công']);
    }

    public function delete($key) {
        $this->book->getDatabase()->getChild($key)->remove();
        return redirect()->route('user.list')->with(['flash_message', 'Xóa sản phẩm thành công']);
    }
}
