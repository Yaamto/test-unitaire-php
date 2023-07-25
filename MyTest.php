<?php

use PHPUnit\Framework\TestCase;

class MyTest extends TestCase 
{
    public function testAssertion()
    {
        $testArray = array(1, 2, 3, 4);
  
        // Assert function to test whether testArray contains
        // same number of elements as expectedCount
        $expectedCount = 4;
  
        $this->assertCount(
            $expectedCount,
            $testArray, "testArray doesn't contains 3 elements"
        );
    }
}

?>