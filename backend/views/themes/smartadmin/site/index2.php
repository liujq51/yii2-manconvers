<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>

   <h1>Hello, world!</h1>
 
   <div class="row" >
      <div class="col-xs-6 col-sm-4"
         style="background-color: #dedef8;box-shadow:
         inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing
            elit.
         </p>
      </div>
 		<div class="col-xs-6 col-sm-8"
         style="background-color: #dedef8;box-shadow:
         inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing
            elit.
         </p>
      </div>
   </div>
<div class="table-responsive">
   <table class="table">
      <caption>响应式表格布局</caption>
      <thead>
         <tr>
            <th>产品</th>
            <th>付款日期</th>
            <th>状态</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>产品1</td>
            <td>23/11/2013</td>
            <td>待发货</td>
         </tr>
         <tr>
            <td>产品2</td>
            <td>10/11/2013</td>
            <td>发货中</td>
         </tr>
         <tr>
            <td>产品3</td>
            <td>20/10/2013</td>
            <td>待确认</td>
         </tr>
         <tr>
            <td>产品4</td>
            <td>20/10/2013</td>
            <td>已退货</td>
         </tr>
      </tbody>
   </table>
</div> 
<table class="table table-bordered">
	<caption>边框表格布局</caption>
	<thead>
		<tr>
			<th>名称</th>
			<th>城市</th>
			<th>密码</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tanmay</td>
			<td>Bangalore</td>
			<td>560001</td>
		</tr>
		<tr>
			<td>Sachin</td>
			<td>Mumbai</td>
			<td>400003</td>
		</tr>
		<tr>
			<td>Uma</td>
			<td>Pune</td>
			<td>411027</td>
		</tr>
	</tbody>
</table>
<table class="table table-hover">
	<caption>悬停表格布局</caption>
	<thead>
		<tr>
			<th>名称</th>
			<th>城市</th>
			<th>密码</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tanmay</td>
			<td>Bangalore</td>
			<td>560001</td>
		</tr>
		<tr>
			<td>Sachin</td>
			<td>Mumbai</td>
			<td>400003</td>
		</tr>
		<tr>
			<td>Uma</td>
			<td>Pune</td>
			<td>411027</td>
		</tr>
	</tbody>
</table>
<table class="table">
   <caption>上下文表格布局</caption>
   <thead>
      <tr>
         <th>产品</th>
         <th>付款日期</th>
         <th>状态</th>
      </tr>
   </thead>
   <tbody>
      <tr class="active">
         <td>产品1</td>
         <td>23/11/2013</td>
         <td>待发货</td>
      </tr>
      <tr class="success">
         <td>产品2</td>
         <td>10/11/2013</td>
         <td>发货中</td>
      </tr>
      <tr  class="warning">
         <td>产品3</td>
         <td>20/10/2013</td>
         <td>待确认</td>
      </tr>
      <tr  class="danger">
         <td>产品4</td>
         <td>20/10/2013</td>
         <td>已退货</td>
      </tr>
   </tbody>
</table>
<div id="con" class="container">  
        <div id="2">    
        <table class="table table-bordered scrolltable">  
        <thead style="display:block;overflow-y: scroll;border-bottom:1px solid #eee;">  
                <tr>  
                    <th>栏目一</th>  
                    <th>栏目二</th>  
                    <th>栏目三</th>  
                    <th>栏目一</th>  
                    <th>栏目二</th>  
                    <th>栏目三</th>  
                </tr>  
            </thead>  
            <tbody style="display:block; max-height:200px;overflow-y: scroll;">  
                <tr>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                </tr>  
                <tr>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                </tr>  
                <tr>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                </tr>  
                <tr>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                </tr>  
                <tr>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                </tr>  
                <tr>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                </tr>  
                <tr>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                </tr>  
                <tr>  
                    <td>星期一一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                    <td>星期一</td>  
                    <td>星期二</td>  
                    <td>星期三</td>  
                </tr>  
            </tbody>  
        </table>  
        </div>  
    </div> 
<?php 
    $this->registerJs("
        $(document).ready(function(){  
        var _width=$('#2').width();  
        $('#2 th:first-child').width(_width*0.1);  
        $('#2 td:first-child').width(_width*0.1);  
        $('#2 th:nth-child(2)').width(_width*0.2);  
        $('#2 td:nth-child(2)').width(_width*0.2);  
        $('#2 th:nth-child(3)').width(_width*0.3);  
        $('#2 td:nth-child(3)').width(_width*0.3);  
        $('#2 th:nth-child(4)').width(_width*0.1);  
        $('#2 td:nth-child(4)').width(_width*0.1);  
        $('#2 th:nth-child(5)').width(_width*0.1);  
        $('#2 td:nth-child(5)').width(_width*0.1);  
        $('#2 th:nth-child(6)').width(_width*0.2);  
        $('#2 td:nth-child(6)').width(_width*0.2);  
    })"
        );
?>
<div class="container" style="padding: 40px;">
	<div class="row visible-on">
		<div class="col-xs-6 col-sm-3"
			style="background-color: #dedef8; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
			<span class="hidden-xs">特别小型</span> <span class="visible-xs">✔
				在特别小型设备上可见</span>
		</div>
		<div class="col-xs-6 col-sm-3"
			style="background-color: #dedef8; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
			<span class="hidden-sm">小型</span> <span class="visible-sm">✔ 在小型设备上可见</span>
		</div>
		<div class="clearfix visible-xs"></div>
		<div class="col-xs-6 col-sm-3"
			style="background-color: #dedef8; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
			<span class="hidden-md">中型</span> <span class="visible-md">✔ 在中型设备上可见</span>
		</div>
		<div class="col-xs-6 col-sm-3"
			style="background-color: #dedef8; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
			<span class="hidden-lg">大型</span> <span class="visible-lg">✔ 在大型设备上可见</span>
		</div>
	</div>
</div>
<div class="dropdown">
   <button type="button" class="btn dropdown-toggle" id="dropdownMenu1"
      data-toggle="dropdown">
      主题
      <span class="caret"></span>
   </button>
   <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
      <li role="presentation">
         <a role="menuitem" tabindex="-1" href="#">Java</a>
      </li>
      <li role="presentation">
         <a role="menuitem" tabindex="-1" href="#">数据挖掘</a>
      </li>
      <li role="presentation">
         <a role="menuitem" tabindex="-1" href="#">
            数据通信/网络
         </a>
      </li>
      <li role="presentation" class="divider"></li>
      <li role="presentation">
         <a role="menuitem" tabindex="-1" href="#">分离的链接</a>
      </li>
   </ul>
</div>

<!-- 按钮触发模态框 -->
<a class="btn btn-primary btn-lg" data-toggle="modal" href="http://www.baidu.com" data-target="#myModal">
   开始演示模态框
</a>
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close"
               data-dismiss="modal" aria-hidden="true">
                  &times;
            </button>
            <h4 class="modal-title" id="myModalLabel">
               模态框（Modal）标题
            </h4>
         </div>
         <div class="modal-body">
            在这里添加一些文本
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default"
               data-dismiss="modal">关闭
            </button>
            <button type="button" class="btn btn-primary">
               提交更改
            </button>
         </div>
      </div><!-- /.modal-content -->
</div>
</div>