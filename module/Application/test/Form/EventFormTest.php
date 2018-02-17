<?php

namespace Application\Form;

use DateTime;
use PHPUnit\Framework\TestCase;
use Zend\Form\Element\Csrf;

/**
 * @group Product
 * @group Form
 */
class EventFormTest extends TestCase
{

    protected $form;

    protected function setUp()
    {
        parent::setUp();
        $this->class = EventForm::class;
        $this->form = new $this->class();
    }

    private function getData()
    {
        return [
            'id' => 1,
            'csrf' => (new Csrf())->getValue(),
            'name' => 'Teste',
            'description' => 'Teste',
            'location' => 'Teste',
            'capacity' => 30,
            'ticketAmount' => 19.9,
            'showDate' => date('d/m/Y H:i')
        ];
    }

    public function formFields()
    {
        return [
            ['id'],
            ['csrf'],
            ['name'],
            ['description'],
            ['location'],
            ['capacity'],
            ['ticketAmount'],
            ['showDate'],
            ['submit'],
        ];
    }

    public function getFormAttributes()
    {
        $dataProviderTest = $this->formFields();
        $definedAttributes = [];
        foreach ($dataProviderTest as $item) {
            $definedAttributes[] = $item[0];
        }

        return $definedAttributes;
    }

    /**
     * @test
     */
    public function classIsASubClassOfZendForm()
    {
        $class = class_parents($this->form);
        $formExtendsOf = current($class);
        $this->assertEquals('Zend\Form\Form', $formExtendsOf);
    }

    /**
     * @test
     * @dataProvider formFields()
     */
    public function checkFormFields($fieldName)
    {
        $this->assertTrue($this->form->has($fieldName), 'Field "' . $fieldName . '" not found.');
    }

    /**
     * @test
     *
     * Test if the attributes are in the form and config in tests
     */
    public function isAttributsMirrored()
    {
        $definedAttributes = $this->getFormAttributes();
        $attributesFormClass = $this->form->getElements();
        $attributesForm = array();
        foreach ($attributesFormClass as $key => $value) {
            $attributesForm[] = $key;
            $messageAssert = 'Attribute "' . $key . '" not found in class test. Value - ' . $value->getName();
            $this->assertContains($key, $definedAttributes, $messageAssert);
        }

        $this->assertTrue(($definedAttributes === $attributesForm), 'Attributes not equals.');
    }

    /**
     * @test
     */
    public function completeDataAreValid()
    {
        $form = new EventForm();
        $form->remove('csrf');
        $this->form->remove('csrf');

        $this->form->setData($this->getData());
        $this->form->isValid();

        $this->assertTrue($this->form->isValid());
    }
}
