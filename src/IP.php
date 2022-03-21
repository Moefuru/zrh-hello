<?php

namespace Zrh\Hello;

class IP
{
    public $ipList = [];

    //设置ip池
    public function setIpList(array $ipList){
        $this->ipList = $ipList;
    }

    public function getIpList(): array
    {
        return $this->ipList;
    }

    //判断IP是否在允许范围内
    public function square($ip)
    {
        $ipList = $this->getIpList();
        $list = [];
        foreach($ipList as $ip){
            $array = explode('.',$ip);
            //判断是否有子网
            if($array[3] == '0/24'){
                //生成范围ip
                for ($i=1; $i <= 254; $i++) {
                    $list[] = $array[0].'.'.$array[1].'.'.$array[2].'.'.$i;
                }
            }else{
                $list[] = $ip;
            }
        }
        if(in_array($ip,$list)){
            return true;
        }
        return false;
    }
}