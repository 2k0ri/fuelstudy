 <?php
/**
 * @group App
 */
class Test_Model_Schedule extends TestCase
{
    private $s;
    public function setUp()
    {
        $this->s = new Model_Schedule();
    }
    public function test_get_detail()
    {
        $this->assertFalse($this->s->save());
    }
}

