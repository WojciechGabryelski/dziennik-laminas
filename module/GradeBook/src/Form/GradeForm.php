<?php

namespace GradeBook\Form;

use Laminas\Filter\ToInt;
use Laminas\Form\Element;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\Between;

class GradeForm extends Form
{
    public function __construct($name = 'grade', array $options = [])
    {
        parent::__construct($name, $options);
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'value',
            'type' => 'text',
            'options' => [
                'label' => 'Grade',
            ],
        ]);
        $this->add([
            'name' => 'wage',
            'type' => 'text',
            'options' => [
                'label' => 'Wage'
            ],
        ]);
        $this->add([
            'name' => 'date',
            'type' => Element\DateTimeLocal::class,
            'options' => [
                'label' => 'Date of assessment',
                'format' => 'Y-m-d\TH:iP',
            ],
        ]);
        $this->add([
            'name' => 'student',
            'type' => 'text',
            'options' => [
                'label' => 'Student',
            ],
        ]);
        $this->add([
            'name' => 'course',
            'type' => 'text',
            'options' => [
                'label' => 'Course'
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);

        $inputFilter = new InputFilter();
        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
        $inputFilter->add([
            'name' => 'value',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
            'validators' => [
                [
                    'name' => Between::class,
                    'options' => [
                        'min' => 1,
                        'max' => 6,
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'wage',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
        $inputFilter->add([
            'name' => 'date',
            'required' => true,
        ]);
        $inputFilter->add([
            'name' => 'student',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
        $inputFilter->add([
            'name' => 'course',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
        $this->setInputFilter($inputFilter);
    }
}