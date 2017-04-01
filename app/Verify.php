<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    protected $primaryKey = 'customer_id';
    protected $fillable = ['id', 'status', 'comment' ,'verify_at', 'verify_by'];
    public $incrementing = false;
    protected $touches = ['customer'];

    /** 与客户表 一对一关系 */
    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    /** 与管理员表 多对一关系 */
    public function user(){
        return $this->belongsTo('App\User', 'verify_by');
    }

}
