<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @property int $id
 * @property string $name 客户姓名
 * @property string $idCard 身份证号
 * @property string $phone 客户手机
 * @property int $education 教育程度
 * @property string $company 工作单位
 * @property string $shenfenzheng_img 身份证图片
 * @property string $address 家庭住址
 * @property string $email 电子邮箱
 * @property string $ip ip
 * @property int $sex 性别 1：男 2：女
 * @property int $age 年龄
 * @property string $hujidizhi 户籍地址
 * @property int $manager 客户经理
 * @property string $type 12345对应类型A,B,C,D,N
 * @property string $wx_openid 微信ID
 * @property string $wx_name 微信昵称
 * @property string $wx_img 微信头像
 * @property string $wx_sex 微信性别
 * @property string $wx_addr 微信地址
 * @property string $position 定位信息
 * @property bool $auth_jd 授权京东
 * @property bool $auth_tb 授权淘宝
 * @property bool $auth_yys 授权运营商
 * @property bool $auth_zfb 授权支付宝
 * @property int $money_wanted 客户希望借款数
 * @property bool $wangling 网龄
 * @property int $zhimafen 芝麻分
 * @property int $jdbaitiao 京东白条
 * @property int $huabei 花呗额度
 * @property string $sysAdvice 系统审核意见
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Verify $verify
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Loan[] $loan
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereIdCard($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereEducation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereShenfenzhengImg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereIp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereHujidizhi($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereManager($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereWxOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereWxName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereWxImg($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereWxSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereWxAddr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAuthJd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAuthTb($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAuthYys($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAuthZfb($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereMoneyWanted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereWangling($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereZhimafen($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereJdbaitiao($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereHuabei($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereSysAdvice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    /** 与审核表 一对一关系 */
    public function verify()
    {
        return $this->hasOne('App\Verify');
    }

    /** 与借款表 一对多关系 */
    public function loan()
    {
        return $this->hasMany('App\Loan','Customer_id');
    }
}
