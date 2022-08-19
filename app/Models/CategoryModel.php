<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;

class CategoryModel extends AdminModel
{
    public function __construct(){
        $this->table                = 'category';
        $this->folderUpload         = 'category';
        $this->fieldSearchAccepted  = ['id', 'name'];
        $this->crudNotAccepted      = ['_token'];
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-list-items') {
            $query = $this->select('id', 'name', 'status', 'is_home', 'display', 'created', 'created_by', 'modified', 'modified_by');

            if ($params['filter']['status'] !== 'all') {
                $query->where('status', '=', $params['filter']['status']);
            }

            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE', '%' . $params['search']['value'] . '%');
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', '%' . $params['search']['value'] . '%');
                }
            }

            $result =  $query->orderByDesc('id')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }

        if ($options['task'] == 'news-list-items') {
            $query = $this->select('id', 'name');

            $result =  $query->where('status','=','active')
                      ->limit(8)->get()->toArray();
        }

        if ($options['task'] == 'news-list-items-is-home') {
            $query = $this->select('id', 'name');

            $result =  $query->where('status','=','active')
                             ->where('is_home','=','yes')
                      ->limit(8)->get()->toArray();
        }

        return $result;
    }

    public function countItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'admin-count-items-group-by-status') {
            $query = $this::groupBy('status')
                ->select(DB::raw('count(id) as count, status'));

            if ($params['search']['value'] !== '') {
                if ($params['search']['field'] == 'all') {
                    $query->where(function ($query) use ($params) {
                        foreach ($this->fieldSearchAccepted as $column) {
                            $query->orWhere($column, 'LIKE', '%' . $params['search']['value'] . '%');
                        }
                    });
                } else if (in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                    $query->where($params['search']['field'], 'LIKE', '%' . $params['search']['value'] . '%');
                }
            }
        }

        $result = $query->get()->toArray();
        return $result;
    }

    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $query = $this->select('id', 'name', 'status', 'is_home', 'display');
            $result = $query->where('id', $params['id'])
                            ->first()->toArray();
        }
        return $result;
    }

    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'change-status'){
            $status = ($params['currentStatus'] == 'inactive' ) ? 'active' : 'inactive';

            self::where('id', $params['id'])
                ->update(['status' => $status]);
        }
        if ($options['task'] == 'change-is-home'){
            $isHome = ($params['currentIsHome'] == 'no' ) ? 'yes' : 'no';

            self::where('id', $params['id'])
                ->update(['is_home' => $isHome]);
        }
        if ($options['task'] == 'add-item'){
            $params['created']      = date("Y-m-d");
            $params['created_by']   = 'HoangGiang';

            self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item'){
            $params['modified']      = date("Y-m-d");
            $params['modified_by']   = 'HoangGiang';
            
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item'){

            self::where('id', $params['id'])->delete();
        }
    }

}
