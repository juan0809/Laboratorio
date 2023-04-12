<?php
namespace Files\Phpunit;
use CodeA;
use PHPUnit\Framework\TestCase;
include 'code.php';

class CodeTest extends TestCase {
  public function testAdd() {
    $calc = new CodeA();
    $this->assertEquals(5, $calc->add(2, 3));
  }

}
?>  