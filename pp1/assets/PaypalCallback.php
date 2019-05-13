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
class PaypalCallback extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'https://www.paypal.com/sdk/js?client-id=AbG4CPfxLMl4qZC_LBZeXZCnXepLXhnZoJBoTxfQaBIZKbfekvkhpHgXRABXe68HE9sULEfw8cXmaHEQ',
        'js/paypalButton.js'
    ];

//'js/map.js',
//'//maps.googleapis.com/maps/api/js?key=AIzaSyCJfFLygQCdKq_IfW63CFJtb0Vw6bMEMzY&callback=initMap',
    public $depends = [
    ];
}
