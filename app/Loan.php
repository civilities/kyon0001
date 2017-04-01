<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Loan
 *
 * @property int $id
 * @property int $User_id 审核员ID
 * @property int $Customer_id 用户ID
 * @property int $amount 借出金额
 * @property string $out_time 借出日期
 * @property string $back_time 合同还款日期
 * @property string $get_time 实际还款日期
 * @property int $status 借款状态 0借出,1已还,2逾期,3延期,4分期
 * @property int $delay_days 延期天数
 * @property int $delay_fee 延期费用
 * @property int $back_way 还款渠道
 * @property int $remain 剩余需还金额
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @property-read \App\Customer $customer
 * @property-read \App\Installments $installment
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereOutTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereBackTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereGetTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereDelayDays($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereDelayFee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereBackWay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereRemain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Loan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Loan extends Model
{
    protected $guarded = [
        'id',
    ];

    /** 与管理员 多对一关系 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /** 与客户 多对一关系 */
    public function customer()
    {
        return $this->belongsTo('App\Customer','Customer_id');
    }

    /** 与还款(借款详情) 一对多关系 */
    public function repayment()
    {
        return $this->hasMany('App\repayment');
    }
}
