<?php

namespace Application\Form;

use Exception;
use PHPUnit\Framework\TestCase;
use Zend\InputFilter\BaseInputFilter;

/**
 * Class EventFormFilterTest
 * @package Application\Form
 */
class EventFormFilterTest extends TestCase
{
    protected $className;

    protected function setUp()
    {
        parent::setUp();
        $this->className = EventFormFilter::class;
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function checkIfClassExist()
    {
        $this->assertTrue(class_exists($this->className));
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function checkSetInputFilter()
    {
        $formFilter = new $this->className();

        $filterInterface = new BaseInputFilter();
        $formFilter->setInputFilter($filterInterface);
    }

    /**
     * @test
     */
    public function checkGetInputFilter()
    {
        $formFilter = new $this->className();
        $result = $formFilter->getInputFilter();


        $this->assertNotNull($result);
        $this->assertArrayHasKey('id', $result->getInputs());
        $this->assertArrayHasKey('name', $result->getInputs());
        $this->assertArrayHasKey('description', $result->getInputs());
        $this->assertArrayHasKey('location', $result->getInputs());
        $this->assertArrayHasKey('ticketAmount', $result->getInputs());
        $this->assertArrayHasKey('capacity', $result->getInputs());
        $this->assertArrayHasKey('showDate', $result->getInputs());
    }
}
