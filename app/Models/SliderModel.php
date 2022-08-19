<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use DB;

class SliderModel extends AdminModel
{
    public function __construct(){
        $this->table                = 'slider';
        $this->folderUpload         = 'slider';
        $this->fieldSearchAccepted  = ['id', 'name', 'description', 'link'];
        $this->crudNotAccepted      = ['_token', 'thumb-current'];
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;

        if ($options['task'] == 'admin-list-items') {
            $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'status', 'created', 'created_by', 'modified', 'modified_by');

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
            $query = $this->select('id', 'name', 'description', 'link', 'thumb');

            $result =  $query->where('status','=','active')
                      ->limit(5)->get()->toArray();
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
            $query = $this->select('id', 'name', 'description', 'link', 'thumb', 'status');
            $result = $query->where('id', $params['id'])
                            ->first()->toArray();
        }
        if ($options['task'] == 'get-thumb') {
            $query = $this->select('id', 'thumb');
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
        if ($options['task'] == 'add-item'){
            $params['created']      = date("Y-m-d");
            $params['created_by']   = 'HoangGiang';
            $params['thumb']        = $this->uploadThumb($params['thumb']);

            self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item'){
            if (!empty($params['thumb'])){
                $this->deleteThumb($params['thumb-current']);
                $params['thumb']     = $this->uploadThumb($params['thumb']);
            }
            $params['modified']      = date("Y-m-d");
            $params['modified_by']   = 'HoangGiang';
            
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }

    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item'){
            $item = self::getItem($params, ['task' => 'get-thumb']);
            $this->deleteThumb($item['thumb']);

            self::where('id', $params['id'])->delete();
        }
    }

}
