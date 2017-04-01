<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\LoanDetail
 *
 * @property int $id
 * @property int $Loan_id 借款ID
 * @property int $operation 操作类型
 * @property int $operator 操作者
 * @property string $next_repayment 下次应还款时间
 * @property int $remain 剩余应还金额
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Loan $loan
 * @method static \Illuminate\Database\Query\Builder|\App\LoanDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoanDetail whereLoanId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoanDetail whereOperation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoanDetail whereOperator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoanDetail whereNextRepayment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoanDetail whereRemain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoanDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\LoanDetail whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LoanDetail extends Model
{
    public function loan()
    {
        return $this->belongsTo('App\Loan');
    }
}
