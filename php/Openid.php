<?php
class Openid
{
    private $code = '';
    private $openid = '';

    public function __construct($code){
        $this->code = $code;
        $appsecret = "694dd6032882f2340dffa472eb3f2417";
        $appid = "wx5583a1bdddb9b41b";
        $grant_type = "authorization_code";

        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret=' . $appsecret . '&js_code=' . $code . '&grant_type=' . $grant_type;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($curl);

        curl_close($curl);
        $this->openid = json_decode($res)->openid;       //取得用户的openid
    }
    public function getOpenid(){
        return $this->openid;
    }
}
?>