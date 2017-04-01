<?php

namespace App\Http\Controllers\RawData;

use DB;

class JxlUtils
{
    const CLIENT_SECRET = 'a9021a05cb254f21adb9e604231ce269';
    const ACCESS_TOKEN = '9c28663964be422ab9a1207f7830cf53';

//------------------------------------ 公用方法 ---------------------------------------------------------------------
    /**
     * 请求京东手机验证码
     * @param $token
     * @param $account
     * @param $password
     * @return mixed
     */
    public static function requestVerifyCode($token, $account, $password)
    {
        $url = "https://www.juxinli.com/orgApi/rest/v2/messages/collect/req";
        $params = array(
            "token" => $token,
            "account" => $account,
            "password" => $password,
            "website" => 'jingdong'
        );

        $content = self::postJson($url, json_encode($params));
        $params['password'] = '密码是有的,保密';
        Logger::debug([
            $content, $params, $url
        ]);
        $dd = json_decode($content, true);
        return $content;
    }

    /**
     * @param $url
     * @param string $cookie
     * @param bool $header
     * @param array $opts
     * @return string|false
     */
    public static function get($url, $cookie = '', $header = false, array $opts = [])
    {
        $ch = curl_init($url);
        if (strpos($url, 'https://') === 0) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        curl_setopt($ch, CURLOPT_HEADER, $header); //将头文件的信息作为数据流输出
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($cookie) {
            $dir = dirname($cookie);
            if (!is_dir($dir)) {
                if (!mkdir($dir, 0777, true)) {
                    return false;
                }
            }
            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
            curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        }
        if ($opts) foreach ($opts as $k => $v) {
            curl_setopt($ch, $k, $v);
        }

        $content = curl_exec($ch);
        curl_close($ch);
        return false === $content ? '' : (string)$content;
    }

    /**
     * @author:      Wang
     * @dateTime:    2016-11-15 16:30:02
     * @description:
     * @param $url
     * @param string|array $jsonStr
     * @return mixed
     */
    public static function postJson($url, $jsonStr)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, is_string($jsonStr) ? $jsonStr : json_encode($jsonStr));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf-8',]);
        $response = curl_exec($ch);
        return $response;
    }

//---------------------------------------- 根据手机号取token方法 ---------------------------------------------------------------------
    public static function getYysTokenByPhone($phone)
    {
        $data = (array)(DB::table('data_yys')->where('shoujihao', $phone)->first());
        if ($data) {
            return $data['token'];
        } else {
            return false;
        }
    }

    public static function setYysTokenByPhone($phone, $token)
    {
        //TODO:
    }

    public static function getJdTokenByPhone($phone)
    {
        $data = (array)(DB::table('data_jd')->where('shoujihao', $phone)->first());
        if ($data) {
            return $data['token'];
        } else {
            return false;
        }
    }

    public static function setJdTokenByPhone($phone, $token)
    {
        //TODO:
    }

    public static function getTbTokenByIdcard($idcard)
    {
        $data = (array)(DB::table('data_tb')->where('shenfenzheng', $idcard)->first());
        if ($data) {
            return $data['token'];
        } else {
            return false;
        }
    }


    protected static $error = null;

    public static function getError()
    {
        return self::$error;
    }

    /**
     * 修改form中tab的授权
     * @param $phone
     * @return bool
     */
    public static function setTbForm($phone)
    {
        $dao = Dao::getInstance();
        $data = $dao->query('select c.* from customers c INNER JOIN custom_forms cf on c.wx_openid = cf.uid where phone = \'' . $phone . '\' LIMIT 1 ;');
        if (false === $data) {
            self::$error = $dao->error();
            return false;
        } elseif (empty($data)) {
            self::$error = "查不到手机号为'$phone'的客户信息";
            return false;
        } else {
            $data = array_shift($data);
        }
        $openid = $data['wx_openid'];

        Logger::debug("update custom_forms set auth_tb = 1 WHERE uid = '{$openid}'; ");

        if (false === $dao->exec("update custom_forms set auth_tb = 1 WHERE uid = '{$openid}'; ")) {

            self::$error = $dao->error();
            return false;
        } else {
            return true;
        }

    }

    /**
     * 设置淘宝token
     * @param $phone
     * @param $token
     * @param $idcard
     * @return bool
     */
    public static function setTbToken($phone, $token, $idcard)
    {
//        $data = (array)(DB::table('data_tb')->where('shoujihao', $phone)->first());
        if (empty($idcard) or empty($phone) or empty($token)) {
            self::$error = '设置token时参数不能为空';
            return false;
        }
        $dao = Dao::getInstance();
        $phone = htmlspecialchars($phone);
        $result = $dao->query('select * from data_tb where shoujihao = \'' . $phone . '\';');
        if (false === $result) {
            self::$error = $dao->error();
            return false;
        } elseif (empty($result)) {

            if (!$dao->exec('insert into data_tb (token,shoujihao,shenfenzheng) values (?,?,?)', [
                $token, $phone, $idcard
            ])
            ) {
                self::$error = '添加淘宝授权数据失败';
                return false;
            }


//            self::$error = "查不到手机号为'$phone'的客户信息";
//            return false;
//        } else {
//            $data = array_shift($result);
        }
//        if (!$data) {
//        } else {
        if (false === $dao->exec("update data_tb set token = '{$token}' where shenfenzheng = '{$idcard}';"))
            return false;
//        }
        return true;
    }

//----------------------------------------- 取得数据报告 --------------------------------------------------
    /**
     * 获取淘宝数据
     * @param string $idcard 手机号
     * @param bool $bejson 是否格式化成json数组
     * @return bool|array 返回淘宝数据(array)或者false(发送了错误)
     */
    public
    static function getTbData($idcard, $bejson = false)
    {
        $dao = Dao::getInstance();
        $data = $dao->query("select * from data_tb where shenfenzheng = '{$idcard}';");
        if (false === $data) {
            self::$error = '查询失败';
            return false;
        } elseif (!empty($data[0]['content'])) {
            $content = htmlspecialchars_decode($data[0]['content']);
        } else {
            $token = self::getTbTokenByIdcard($idcard);
            if (false === $token) {
                self::$error = "查询不到'$idcard'对应的授权信息";
                return false;
            }
            $query = http_build_query([
                'client_secret' => self::CLIENT_SECRET,
                'access_token' => self::ACCESS_TOKEN,
                'token' => $token,
            ]);
            $content = self::get('https://www.juxinli.com/api/access_e_business_raw_data_by_token?' . $query);
            if (false === $content) {
                self::$error = '请求JXL失败';
                return false;
            }

            //存入数据库
            if (false === $dao->exec("update data_tb set `content` = '" . htmlspecialchars($content) . "' where shenfenzheng = '{$idcard}';")) {
                Logger::error('存入数据库失败');
            }
        }
//        mydump('https://www.juxinli.com/api/access_e_business_raw_data_by_token?' . $query);
        return $bejson ? json_decode($content, true) : $content;
    }

    /**
     * @param $phone
     * @param bool $bejson
     * @return bool|false|mixed|string
     */
    public static function getJdData($phone, $bejson = false)
    {
        $token = self::getJdTokenByPhone($phone);
        if (false === $token) {
            self::$error = "查询不到手机号为'$phone'对应的授权信息";
            return false;
        }
        $query = http_build_query([
            'client_secret' => self::CLIENT_SECRET,
            'access_token' => self::ACCESS_TOKEN,
            'token' => $token,
        ]);
        $content = self::get('https://www.juxinli.com/api/access_e_business_raw_data_by_token?' . $query);
        mydump('https://www.juxinli.com/api/access_e_business_raw_data_by_token?' . $query, $content);
        return $bejson ? json_decode($content, true) : $content;
    }

    public static function checkTbStatus($phone)
    {
        $dao = Dao::getInstance();
        $result = $dao->query('select * from data_tb where shoujihao = \'' . $phone . '\';');
        if (false === $result) {
            self::$error = $dao->error();
            return false;
        } elseif (empty($result)) {
            self::$error = "查不到手机号为'$phone'的客户信息";
            return false;
        } else {
            $data = array_shift($result);
        }
        if (empty($data['token'])) {
            self::$error = "手机号为'$phone'的淘宝token为空";
            return false;
        }
        $token = $data['token'];
        $content = self::postJson('https://www.juxinli.com/orgApi/rest/v3/taobao/messages/qrcodeCollect/resp/', json_encode([
            'token' => $token,
        ]));
        if (is_string($content)) {
            $content = json_decode($content, true);
        }

        if ($content['success'] === true and !empty($content['data']['process_code']) and $content['data']['process_code'] === 10008) {
            //检测到已经在采集了，删除loop脚本
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取数据报告
     * @param string $idcard
     * @param bool $bejson
     * @return array|string|false
     */
    public
    static function getReportData($idcard, $bejson = false)
    {
        $idcard = htmlspecialchars(trim($idcard));
        $customer = \CustomerModel::getInstance(1)->where(['idCard' => $idcard])->find();
        if (!$customer) {
            //todo:日志-->查询不到这个身份证号XXX的信息
            return false;
        }
        $query = http_build_query([
            'client_secret' => self::CLIENT_SECRET,
            'access_token' => self::ACCESS_TOKEN,
            'name' => $customer['name'],
            'phone' => $customer['phone'],
            'idcard' => $idcard,
        ]);
        $content = self::get('https://dev.juxinli.com/reportApi/access_report_data?' . $query);
        return $bejson ? json_decode($content, true) : $content;
    }


    public static function getTokenOfYys($name, $phone, $idcard)
    {
        $url = "https://www.juxinli.com/orgApi/rest/v3/applications/pgyxxkj";
        $params = array(
            'skip_mobile' => false,
            'basic_info' => array(
                "name" => $name,
                "id_card_num" => $idcard,
                "cell_phone_num" => $phone
            ),
        );
        $content = self::curlPostJson($url, $params);
        $dd = json_decode($content, true);
        return $dd;
    }


    private static function curlPostJson($url, $json)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        if (!is_string($json)) {
            $json = json_encode($json);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
            )
        );
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        return $response;
    }


}