<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/9
 * Time: 10:51
 */
/**
 * 随机生成兑换码
 * @param int $length  长度
 * @param string $type 类型
 * @return string
 */
function random($length=6, $type='number'){
    $config = array(
        'number'=>'1234567890',
        'lower'=>'abcdefghjkmnpqrstuvwxyz1234567890',
        'upper'=>'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
        'all'  => 'abcdefghjkmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890',
    );

    if(!isset($config[$type])) $type = 'upper';
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) -1;
    for($i = 0; $i < $length; $i++){
        $code .= $string{mt_rand(0, $strlen)};
    }
    return $code;
}