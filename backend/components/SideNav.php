<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\bootstrap\BootstrapAsset;

/**
 * Nav renders a nav HTML component.
 *
 * For example:
 *
 * ```php
 * echo SideNav::widget([
 *        [
 *            'label' => 'Home',
 *            'url' => ['site/index'],
 *            'icon' => ['class' => 'menu-icon fa fa-tachometer'],
 *            'linkOptions' => ['class'=>'...'],
 *        ],
 *        [
 *            'label' => 'Dropdown',
 *            'icon' => ['class' => 'menu-icon fa fa-desktop'],
 *            'items' => [
 *                [
 *                    'label' => 'Level 1 - Dropdown A',
 *                    'items' => [
 *                        [
 *                            'label' =>'Level 2',
 *                            'items' => [
 *                                [
 *                                    'label' =>'Level 2',
 *                                    'url' => ['site/index1'],
 *                                ],
 *                                [
 *                                    'label' => 'Level 2 -2',
 *                                    'url' => ['site/index'],
 *                                ],
 *                            ],
 *                        ],
 *                        [
 *                            'label' => 'Level 2 -2',
 *                            'url' => ['site/index2'],
 *                        ],
 *                    ],
 *                ],
 *                ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
 *            ],
 *        ],
 *     ],
 *     'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
 * ]);
 * ```
 *
 * Note: Multilevel dropdowns beyond Level 1 are not supported in Bootstrap 3.
 *
 * @see http://getbootstrap.com/components/#dropdowns
 * @see http://getbootstrap.com/components/#nav
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @since 2.0
 */
class SideNav extends Widget
{
    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: boolean, optional, whether the item should be on active state or not.
     * - dropDownOptions: array, optional, the HTML options that will passed to the [[Dropdown]] widget.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     * - encode: boolean, optional, whether the label will be HTML-encoded. If set, supersedes the $encodeLabels option for only this item.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $items = [];
	/**
	 *
     */
	public $options = [];
    /**
     * @var boolean whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = true;
    /**
     * @var boolean whether to automatically activate items according to whether their route setting
     * matches the currently requested route.
     * @see isItemActive
     */
    public $activateItems = true;
    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $route;
    /**
     * @var array the parameters used to determine if a menu item is active or not.
     * If not set, it will use `$_GET`.
     * @see route
     * @see isItemActive
     */
    public $params;
    /**
     * @var string this property allows you to customize the HTML which is used to generate the drop down caret symbol,
     * which is displayed next to the button text to indicate the drop down functionality.
     * Defaults to `null` which means `<b class="caret"></b>` will be used. To disable the caret, set this property to be an empty string.
     */
    public $dropDownCaret;


    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        if ($this->dropDownCaret === null) {
            $this->dropDownCaret = Html::tag('b', '', ['class' => 'allow']);
        }
        Html::addCssClass($this->options, ['widget' => 'nav']);
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        BootstrapAsset::register($this->getView());
		  $oriItems = $this->items;
        $renderContent = $this->renderItems($oriItems, true);
		return $renderContent['html'];
    }

	public function renderItems($oriItems, $isLevel1 = false)
	{
        $items = [];
        $active = false;
		  $options = $isLevel1 ?['class'=>'nav nav-list']:['class'=>'submenu'];
        foreach ($oriItems as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                continue;
            }
			$renderHtml = $this->renderItem($item);
            $items[] = $renderHtml['html'];
			if ($this->activateItems && $renderHtml['active']) {
				$active = true;
			}
        }
		$active = (isset($active) && $active )?true:false;
        return ['html' => Html::tag('ul', implode("\n", $items), $options) , 'active' => $active];
	}

    public function renderItem($item)
    {
        if (is_string($item)) {
            return ['html' => $item];
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
		$icon = ArrayHelper::getValue($item, 'icon',[]);
		$icon = Html::tag('i','', $icon);
        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
		$label = $icon . Html::tag('span', $label,['class'=>'menu-item-parent']); 
        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

		$active = $subActive = false;
        if (empty($items)) {
			$items = '';
			if (isset($item['active'])) {
				$active = ArrayHelper::remove($item, 'active', false);
			} else {
				$active = $this->isItemActive($item);
			}
        } else {
            Html::addCssClass($linkOptions, ['widget' => 'dropdown-toggle']);
			   //$label .= ' ' . Html::tag('b','',['class'=>'arrow fa fa-angle-down']);
            if (is_array($items)) {
				$renderContent = $this->renderItems($items);
            $items = $renderContent['html'];
				$subActive = $active = $renderContent['active'];
            }
        }

		if (isset($subActive) && $subActive){
			Html::addCssClass($options, ['active','open']);
		}else if($this->activateItems && $active){
            Html::addCssClass($options, ['active']);
		}

        return ['html' => Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options) , 'active' => $active];
    }

    /**
     * Checks whether a menu item is active.
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            $route = ltrim($route, '/');
            if (substr($route,0,strrpos($route, '/')) !== substr($this->route,0,strrpos($this->route,'/'))) {
                return false;
            }
            unset($item['url']['#']);
            if (count($item['url']) > 1) {
                $params = $item['url'];
                unset($params[0]);
                foreach ($params as $name => $value) {
                    if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }

            return true;
        }

        return false;
    }
}
