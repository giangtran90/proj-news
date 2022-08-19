<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SliderModel as SliderModel;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Config;

class HomeController extends Controller
{
    private $pathViewController = 'news.pages.home.';
    private $controllerName = 'home';
    private $model;
    private $params;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }
    public function index(Request $request)
    {
        $sliderModel = new SliderModel();
        $itemsSlider = $sliderModel->listItems(null, ['task' => 'news-list-items']);
        
        $categoryModel = new CategoryModel();
        $itemsCategory = $categoryModel->listItems(null, ['task' => 'news-list-items-is-home']);

        return view($this->pathViewController . 'index', [
            'params'            => $this->params,
            'itemsSlider'       => $itemsSlider,
            'itemsCategory'     => $itemsCategory,
        ]);
    }
}
