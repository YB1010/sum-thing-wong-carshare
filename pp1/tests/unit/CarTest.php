<?php
namespace tests;
require_once(__DIR__."/../../models/Car.php");
use app\models\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    public function testCarObject()
    {
		$c = new Car();
		$this->assertInstanceOf('app\models\Car',$c);
    }
    public function testCarTableName()
    {
        $c = new Car();
        $this->assertEquals('car',$c::tableName());
    }
    public function testCarLabel()
    {
        $c = new Car();
        $this->assertArrayHasKey("id",$c->attributeLabels());
        $this->assertArrayHasKey("latitude",$c->attributeLabels());
        $this->assertArrayHasKey("longitude",$c->attributeLabels());
        $this->assertArrayHasKey("pendingTime",$c->attributeLabels());
        $this->assertArrayHasKey("inUse",$c->attributeLabels());
        $this->assertArrayHasKey("carName",$c->attributeLabels());
        $this->assertArrayHasKey("carImgUrl",$c->attributeLabels());
        $this->assertArrayHasKey("numOfPassenger",$c->attributeLabels());
    }

}
?>