<?php
namespace tests;
require_once(__DIR__."/../../models/Receipt.php");
use app\models\Receipt;
use PHPUnit\Framework\TestCase;

class ReceiptTest extends TestCase
{
    public function testRegistrationObject()
    {
		$r = new Receipt();
		$this->assertInstanceOf('app\models\Receipt',$r);
    }
    public function testRegistrationTableName()
    {
        $r = new Receipt();
        $this->assertEquals('receipt',$r::tableName());
    }
    public function testRegistrationLabel()
    {
        $r = new Receipt();
        $this->assertArrayHasKey("email",$r->attributeLabels());
        $this->assertArrayHasKey("carId",$r->attributeLabels());
        $this->assertArrayHasKey("startDate",$r->attributeLabels());
        $this->assertArrayHasKey("balance",$r->attributeLabels());
    }
}
?>