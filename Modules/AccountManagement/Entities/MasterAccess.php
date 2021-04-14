<?php

namespace Modules\AccountManagement\Entities;

use Illuminate\Database\Eloquent\Model;

class MasterAccess extends Model
{
    protected $fillable = [
        'title','title_key','parent_id','description','created_at','updated_at'
    ];

    public function parent() {

        return $this->hasOne('Modules\AccountManagement\Entities\MasterAccess', 'id', 'parent_id');

    }

    public function children() {
        return $this->hasMany('Modules\AccountManagement\Entities\MasterAccess', 'parent_id', 'id');
    }  

    public static function tree() {

        return static::with(implode('.', array_fill(0, 4, 'children')))->where('parent_id', '=', 0)->get();

    }
    


}
