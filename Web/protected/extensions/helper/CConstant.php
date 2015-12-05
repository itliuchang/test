<?php
class CConstant{
    //订单状态
    const ORDER_UNUSE = 0;      //预留
    const ORDER_UNPAY = 1;      //待付款
    const ORDER_PAYED = 2;      //已付款
    const ORDER_CANCEL = 3;     //已取消
    const ORDER_REFUND = 4;     //退款中
    const ORDER_COMPLETE = 5;   //已完成
    const ORDER_REFUNDED = 6;   //退款成功
    const ORDER_CLOSE = 7;      //已关闭

    //支付方式
    const PAYMETHOD_WX = 1;     //微信支付
    const PAYMETHOD_ALI =2;     //支付宝支付

    //用户角色
    const ROLE_ADMIN = 1;   //管理员
    const ROLE_DEFAULT = 3; //普通用户
}