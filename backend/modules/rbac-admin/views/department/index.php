<?php

use yii\helpers\Html;
use rbac\admin\models\Department;
//use rbac\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel rbox\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Department');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a(Yii::t('rbac-admin', 'Create Department'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('rbac-admin', 'Batch ') . Yii::t('rbac-admin', 'Enabled'), '#', ['class' => 'btn btn-primary', 'id' => 'batchEnabled','data-type'=> 'STATUS_ENABLED']) ?>
        <?= Html::a(Yii::t('rbac-admin', 'Batch ') . Yii::t('rbac-admin', 'Disabled'), '#', ['class' => 'btn btn-info', 'id' => 'batchDisabled','data-type'=> 'STATUS_DISABLED']) ?>
        <?= Html::a(Yii::t('rbac-admin', 'Batch ') . Yii::t('rbac-admin', 'Delete'), '#', ['class' => 'btn btn-danger', 'id' => 'batchDelete','data-type'=> 'STATUS_DELETED']) ?>
    </p>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th style="width: 30px;"><input type="checkbox" name="checkbox_all" id="checkbox_all" value=""/></th>
            <th width="50px">ID</th>
            <th><?= Yii::t('rbac-admin', 'Title') ?> </th>
            <th width="80px"><?= Yii::t('rbac-admin', 'Status') ?></th>
            <th width="150px"><?= Yii::t('rbac-admin', 'Actions') ?></th>

        </tr>
        </thead>
        <tbody>
        <?php foreach($dataProvider as $item){ ?>
            <tr data-key="1">
                <td><input type="checkbox" name="checkbox_ids" value="<?= $item['id']; ?>" /></td>
                <td><?= $item['id']; ?></td>
                <td><?= $item['label']; ?></td>
                <td><?php
                 if ($item['status'] == Department::STATUS_ENABLED) {
                     $class = 'label-success';
                 } elseif ($item['status'] == Department::STATUS_DISABLED) {
                     $class = 'label-warning';
                 } else {
                     $class = 'label-info';
                 }
                 $item['status'] = (int)$item['status'];
                 echo '<span class="label ' . $class . '">' . Department::getStatusLabels($item['status']) . '</span>';
                 ?></td>
                <td>
                    <a href="<?= \Yii::$app->getUrlManager()->createUrl(['/rbac/department/create','parent_id'=>$item['id']]); ?>" title="<?= Yii::t('rbac-admin', 'Add Sub Department');?>" data-pjax="0" type="button" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-plus"></span></a>
                    <a href="<?= \Yii::$app->getUrlManager()->createUrl(['/rbac/department/update','id'=>$item['id']]); ?>" title="<?= Yii::t('rbac-admin', 'Update');?>" data-pjax="0" type="button" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="<?= \Yii::$app->getUrlManager()->createUrl(['/rbac/department/delete','id'=>$item['id']]); ?>" title="<?= Yii::t('rbac-admin', 'Delete');?>" data-confirm="<?= Yii::t('cms', 'Are you sure you want to delete this item?');?>" data-method="post" data-pjax="0"  type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
$urlBatchUpdateStatus = \yii\helpers\Url::to(['/rbac/department/batch-update-status']);
$js = <<<JS
jQuery(document).ready(function() {
    //全选 
    $("#checkbox_all").click(function(){
        if($(this).is(':checked')) {
            $("input[name='checkbox_ids']").each(function(){
               $(this).prop("checked",true);
            });
        }else{
            $("input[name='checkbox_ids']").each(function(){
                $(this).prop("checked",false);
            });
            console.log('abc');
        }
    });
    //单一选择框处理
    $("input[name='checkbox_ids']").click(function(){
        if($(this).is(':checked')) {
            checkbox_ids_all = true;
            $("input[name='checkbox_ids']").each(function(){
               if($(this).is(':checked') == false){
                    checkbox_ids_all = false;
                    return false;
                }
            });
            if(checkbox_ids_all == true){
                $("#checkbox_all").prop("checked",true);
            }
        }else{
            $("#checkbox_all").prop("checked",false);
        }
    });
    $("#batchDelete,#batchDisabled,#batchEnabled").click(function() {
        var keys = [];
        var statusType = $(this).data("type");
        $("input[name='checkbox_ids']:checkbox:checked").each(function(){
            keys.push($(this).val());
        });
        if(keys.length ==0){
            alert('请选择操作节点。');
            return ;
        }
        $.ajax({
            type: "POST",
            url: "{$urlBatchUpdateStatus}",
            dataType: "json",
            data: {ids: keys,statusType:statusType}
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_END);