<?php
use yii\helpers\Url;
use backend\components\SideNav;
use yii\bootstrap\Nav;
use rbac\admin\components\MenuHelper;
?>
		<!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
		<aside id="left-panel">
			<span class="minifyme" data-action="minifyMenu" style=""> 
				<i class="fa fa-th-large"></i> 
			</span>
			<nav>
				<!-- 
				NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional href="" links. See documentation for details.
				-->
        <?php
            $menuCallback = function ($menu) {
                $data = eval($menu['data']);
            	 $icon = (isset($data['icon']) && $data['icon'])?$data['icon']:[];
                return [
                    'label' => Yii::t('menu', $menu['name']),
                    'url' => $menu['children']?'#':[$menu['route']],
            		  'icon' => $icon,
                    'items' => $menu['children'],
                    ];
                 };
             echo SideNav::widget([
                'options' => ['class' => 'nav'],
                //'items' => $menuItems,
               'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id, null ,$menuCallback),
                ]);
                ?>

		</nav>

		</aside>
		<!-- END NAVIGATION -->