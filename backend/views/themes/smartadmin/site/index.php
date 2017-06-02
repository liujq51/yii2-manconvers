<?php
use yii\helpers\Html;
use function Symfony\Component\Debug\header;
/* @var $this yii\web\View */
$this->title = Yii::t('app','My Yii Application');
?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="0">0</span>
                </div>
                <div class="desc"> 今日订单数 </div>
            </div>
            <a class="more" href="?r=order/default/index">查看更多
                <i class="fa fa-arrow-circle-right hit"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    ￥ <span data-counter="counterup" data-value="0.00">0.00</span> </div>
                <div class="desc"> 今日已付金额 </div>
            </div>
            <a class="more" href="?r=order/default/index">查看更多
                <i class="fa fa-arrow-circle-right hit"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="0">0</span>
                </div>
                <div class="desc"> 会员增加数 </div>
            </div>
            <a class="more" href="?r=member/default/index"> 查看更多
                <i class="fa fa-arrow-circle-right hit"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="127">127</span> </div>
                <div class="desc"> 会员总数 </div>
            </div>
            <a class="more" href="?r=member/default/index"> 查看更多
                <i class="fa fa-arrow-circle-right hit"></i>
            </a>
        </div>
    </div>
</div>