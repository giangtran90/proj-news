<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel as MainModel;
use App\Http\Requests\CategoryRequest as MainRequest;
use Config;

class CategoryController extends Controller
{
    private $pathViewController = 'admin.pages.category.';
    private $controllerName = 'category';
    private $model;
    private $params;

    public function __construct()
    {
        $this->model = new MainModel();
        view()->share('controllerName', $this->controllerName);
        $this->params['pagination']['totalItemsPerPage'] = 10;
    }
    public function index(Request $request)
    {
        $this->params['filter']['status'] = $request->get('filter_status') ?? 'all';
        $this->params['search']['field']  = $request->get('search_field', '');
        $this->params['search']['value']  = $request->get('search_value', '');

        $items              = $this->model->listItems($this->params, ['task' => 'admin-list-items']);
        $itemsStatusCount   = $this->model->countItems($this->params, ['task' => 'admin-count-items-group-by-status']);

        return view($this->pathViewController . 'index', [
            'params'            => $this->params,
            'items'             => $items,
            'itemsStatusCount'  => $itemsStatusCount
        ]);
    }
    public function form(Request $request)
    {
        $item = null;
        if ($request->id !== null) {
            $this->params['id']             = $request->id;
            $item = $this->model->getItem($this->params, ['task' => 'get-item']);
        }
        return view($this->pathViewController . 'form', [
            'item' => $item,
        ]);
    }
    public function save(MainRequest $request)
    {
        if ($request->method() == 'POST') {
            $params = $request->all();

            $task = "add-item";
            $notify = "Thêm phần tử thành công!";

            if (!empty($params['id'])) {
                $task = "edit-item";
                $notify = "Cập nhật phần tử thành công!";
            }
            $this->model->saveItem($params, ['task' => $task]);
            return redirect()->route($this->controllerName)->with('notify', $notify);
        }
    }
    public function delete(Request $request)
    {
        $this->params['id']             = $request->id;
        $this->model->deleteItem($this->params, ['task' => 'delete-item']);
        return redirect()->route($this->controllerName)->with('notify', 'Phần tử có [ ID = ' . $this->params['id'] . ' ] đã được xóa thành công!');
    }
    public function status(Request $request)
    {
        $tmplStatus                     = Config::get('zvn.template.status');
        $this->params['currentStatus']  = $request->status;
        $this->params['id']             = $request->id;
        $this->model->saveItem($this->params, ['task' => 'change-status']);
        return redirect()->route($this->controllerName)->with('notify', 'Phần tử có [ ID = ' . $this->params['id'] . ' ] với trạng thái [ ' . $tmplStatus[$request->status]['name'] . ' ] đã được chuyển đổi trạng thái thành công!');
    }
    public function isHome(Request $request)
    {
        $this->params['currentIsHome']  = $request->isHome;
        $this->params['id']             = $request->id;
        $this->model->saveItem($this->params, ['task' => 'change-is-home']);
        return redirect()->route($this->controllerName)->with('notify', 'Phần tử có [ ID = ' . $this->params['id'] . ' ] đã chuyển trạng thái hiển thị trang chủ thành công!');
    }
}
