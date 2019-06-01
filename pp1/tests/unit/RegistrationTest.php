<?php
namespace tests;
require_once(__DIR__."/../../models/Registration.php");
use app\models\Registration;
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    public function testRegistrationObject()
    {
		$r = new Registration();
		$this->assertInstanceOf('app\models\Registration',$r);
    }
    public function testRegistrationTableName()
    {
        $r = new Registration();
        $this->assertEquals('registration',$r::tableName());
    }
    public function testRegistrationLabel()
    {
        $r = new Registration();
        $this->assertArrayHasKey("FirstName",$r->attributeLabels());
        $this->assertArrayHasKey("LastName",$r->attributeLabels());
        $this->assertArrayHasKey("email",$r->attributeLabels());
        $this->assertArrayHasKey("password",$r->attributeLabels());
        $this->assertArrayHasKey("passwordVerify",$r->attributeLabels());
        $this->assertArrayHasKey("carId",$r->attributeLabels());
    }
}
?>