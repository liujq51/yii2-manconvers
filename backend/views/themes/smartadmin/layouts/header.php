<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
?>
<!-- #HEADER -->
		<header id="header">
			<div id="logo-group">
				<!-- PLACE YOUR LOGO HERE -->
				<a href="/site/index" ><span id="logo" style="color:white;font-size:16px;"> <b style="color:#DD7C37;">Rbox</b><b> Admin System</b></span></a><!-- //<img src="/themes/smartadmin/img/logo.png" alt="Rbox"> -->
				<!-- END LOGO PLACEHOLDER -->
				<!-- Note: The activity badge color changes when clicked and resets the number to 0
					 Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
				<!-- 
				<span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 21 </b> </span>
				// -->
				<!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
				<div class="ajax-dropdown">
					<!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
					<div class="btn-group btn-group-justified" data-toggle="buttons">
						<label class="btn btn-default active">
							<input type="radio" name="activity" id="/site/mail">Msgs (14) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="/site/mail">notify (3) </label>
						<label class="btn btn-default">
							<input type="radio" name="activity" id="/site/mail">Tasks (4) </label>
					</div>
					<!-- notification content -->
					<div class="ajax-notifications custom-scroll">
						<div class="alert alert-transparent">
							<h4>Click a button to show messages here</h4>
							This blank page message helps protect your privacy, or you can show the first message here automatically.
						</div>
						<i class="fa fa-lock fa-4x fa-border"></i>
					</div>
					<!-- end notification content -->

					<!-- footer: refresh area -->
					<span> Last updated on: 12/12/2013 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button> </span>
					<!-- end footer -->
				</div>
				<!-- END AJAX-DROPDOWN -->
			</div>
			<!-- #PROJECTS: projects dropdown -->
			<div class="project-context hidden-xs">
			<!-- 
				<span class="label">Projects:</span>
				<span class="project-selector dropdown-toggle" data-toggle="dropdown">Recent projects <i class="fa fa-angle-down"></i></span>
				 -->
				<!-- Suggestion: populate this list with fetch and push technique -->
				<!-- 
				<ul class="dropdown-menu">
					<li>
						<a href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
					</li>
					<li>
						<a href="javascript:void(0);">Notes on pipeline upgradee</a>
					</li>
					<li>
						<a href="javascript:void(0);">Assesment Report for merchant account</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="javascript:void(0);"><i class="fa fa-power-off"></i> Clear</a>
					</li>
				</ul>
				 -->
				<!-- end dropdown-menu-->
			</div>
			<!-- end projects dropdown -->
			<!-- #TOGGLE LAYOUT BUTTONS -->
			<!-- pulled right: nav area -->
			<div class="pull-right">
			     
				<!-- Top menu profile link : this shows only when top menu is active -->
				<ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
					<li class="">
						<a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
							<img src="/themes/smartadmin/img/avatars/sunny.png" alt="John Doe" class="online" />  
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="/site/profile" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <?php echo Yii::t('cover', 'Profile')?></a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="/site/change-password" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> <?php echo Yii::t('cover', 'Change Password')?></a>
							</li>
							<li class="divider"></li>
							<li>
							    <?php echo Html::a('<i class="fa fa-sign-out fa-lg"></i> <strong>'.Yii::t('cover', 'Logout').'</strong>',['/site/logout'],['data-method' => 'post','class'=>'padding-10 padding-top-5 padding-bottom-5'])?> 
							</li>
						</ul>
					</li>
				</ul>
				<!-- logout button -->
				<!-- end logout button -->
				
				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->
				<!-- #MOBILE -->
				
				<!-- search mobile button (this is hidden till mobile view port) -->
				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
				<!-- end search mobile button -->
				
				<!-- #SEARCH -->
				<!-- input: search field -->
				<!-- 
				<form action="#ajax/search.html" class="header-search pull-right">
					<input id="search-fld" type="text" name="param" placeholder="Find reports and more">
					<button type="submit">
						<i class="fa fa-search"></i>
					</button>
					<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
				</form>
				 -->
				<!-- end input: search field -->

				<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
				<!-- end fullscreen button -->

				<!-- multiple lang dropdown : find all flags in the flags page -->
				<?php
				
				$language = Yii::$app->language;
				$languageArray = Yii::$app->params['languageArray'];
				$menuItemsDetail =                 [
                'label' => '<img src="/themes/smartadmin/img/blank.gif" class="flag '.$languageArray[$language]['class'].'" alt="'.$languageArray[$language]['alt'].'"> '.$languageArray[$language]['name'].'',
                'url' => ['#'],
                'active' => false,
                'encode' => false,
                    //'visible' => Yii::$app->user->can('readPost'),
                ];
				foreach ($languageArray as $lk => $lv){
				    $menuItemsDetail['items'][]= [
				        'label' => '<img src="/themes/smartadmin/img/blank.gif" class="flag '.$lv['class'].'" alt="'.$lv['alt'].'"> '.$lv['label'].'',
				        'url' => ['/site/language','locale'=>$lk],
				        'active' => $lk==$language?true:false,
				        'encode' => false,
				    ];
				}
            $menuItemsMain[] = $menuItemsDetail;
            echo Nav::widget([
                'options' => [
                    'class' => 'header-dropdown-list hidden-xs'
                ],
                'items' => $menuItemsMain,
            ]);
            ?>
				<!-- end multiple lang -->
			</div>
			<!-- end pulled right: nav area -->
		</header>
		<!-- END HEADER -->
