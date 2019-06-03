<?php

namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Category;
class CategoryComposer
{
    protected $categories;

    public function __construct(Category $cate)
    {
        $this->categories = $cate->getAll();
    }

    public function compose(View $view) {
        $view->with('categories', $this->categories);
    }
}
