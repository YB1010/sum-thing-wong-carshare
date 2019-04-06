<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MapAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/map.js',
        'js/callDistance.js'
    ];

//'js/map.js',
//'//maps.googleapis.com/maps/api/js?key=AIzaSyCJfFLygQCdKq_IfW63CFJtb0Vw6bMEMzY&callback=initMap',
    public $depends = [

        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];


}
