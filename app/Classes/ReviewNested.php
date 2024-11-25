<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewNested
{
    protected $params;
    protected $checked;
    protected $data;
    protected $count;
    protected $count_level;
    protected $lft;
    protected $rgt;
    protected $level;
    protected $originalData;

    function __construct($params = NULL)
    {
        $this->params = $params;
        $this->checked = NULL;
        $this->data = NULL;
        $this->count = 0;
        $this->count_level = 0;
        $this->lft = NULL;
        $this->rgt = NULL;
        $this->level = NULL;
        $this->originalData = [];
    }

    public function Get()
    {
        $result = DB::table($this->params['table'])
            ->select(
                'id',
                'parent_id',
                'lft',
                'rgt',
                'level',
                'reviewable_id',
                'reviewable_type',
                'fullname',
                'email',
                'phone',
                'description',
                'score',
                'gender'
            )
            ->where('reviewable_type', '=', $this->params['reviewable_type'])
            ->orderBy('lft', 'asc')
            ->get()
            ->toArray();

        foreach ($result as $row) {
            $this->originalData[$row->id] = $row;
        }

        $this->data = $result;
    }

    public function Set()
    {
        if (isset($this->data) && is_array($this->data)) {
            $arr = NULL;
            foreach ($this->data as $key => $val) {
                $arr[$val->id][$val->parent_id] = 1;
                $arr[$val->parent_id][$val->id] = 1;
            }
            return $arr;
        }
    }

    public function Recursive($start = 0, $arr = NULL)
    {
        $this->lft[$start] = ++$this->count;
        $this->level[$start] = $this->count_level;
        if (isset($arr) && is_array($arr)) {
            foreach ($arr as $key => $val) {
                if ((isset($arr[$start][$key]) || isset($arr[$key][$start])) &&
                    (!isset($this->checked[$key][$start]) && !isset($this->checked[$start][$key]))
                ) {
                    $this->count_level++;
                    $this->checked[$start][$key] = 1;
                    $this->checked[$key][$start] = 1;
                    $this->Recursive($key, $arr);
                    $this->count_level--;
                }
            }
        }
        $this->rgt[$start] = ++$this->count;
    }

    public function Action()
    {
        if (
            isset($this->level) && is_array($this->level) &&
            isset($this->lft) && is_array($this->lft) &&
            isset($this->rgt) && is_array($this->rgt)
        ) {

            $data = [];
            foreach ($this->level as $key => $val) {
                if ($key == 0) continue;

                // Lấy dữ liệu gốc của record
                $originalRecord = $this->originalData[$key] ?? null;
                if (!$originalRecord) {
                    // \Log::error('Missing original data for ID: ' . $key);
                    continue;
                }

                $data[] = [
                    'id' => $key,
                    'level' => $val,
                    'lft' => $this->lft[$key],
                    'rgt' => $this->rgt[$key],
                    'reviewable_id' => $originalRecord->reviewable_id,
                    'reviewable_type' => $originalRecord->reviewable_type,
                    'fullname' => $originalRecord->fullname,
                    'email' => $originalRecord->email,
                    'phone' => $originalRecord->phone,
                    'description' => $originalRecord->description,
                    'score' => $originalRecord->score,
                    'parent_id' => $originalRecord->parent_id,
                    'gender' => $originalRecord->gender,
                    'updated_at' => now()
                ];
            }

            if (!empty($data)) {
                try {
                    DB::table($this->params['table'])->upsert(
                        $data,
                        ['id'],
                        [
                            'level',
                            'lft',
                            'rgt',
                            'reviewable_id',
                            'reviewable_type',
                            'fullname',
                            'email',
                            'phone',
                            'description',
                            'score',
                            'parent_id',
                            'gender',
                            'updated_at'
                        ]
                    );
                } catch (\Exception $e) {
                    // \Log::error('Upsert Error', [
                    //     'message' => $e->getMessage(),
                    //     'data' => $data
                    // ]);
                    throw $e;
                }
            }
        }
    }
}
