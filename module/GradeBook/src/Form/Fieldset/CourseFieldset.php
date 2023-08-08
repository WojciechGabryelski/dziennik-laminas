<?php

namespace GradeBook\Form\Fieldset;

use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\Form\Element\Select;
use Laminas\Form\Fieldset;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator\StringLength;

class CourseFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init(): void
    {
        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'name',
            'type' => 'text',
            'options' => [
                'label' => 'Name',
            ],
        ]);
        $this->add([
            'name' => 'teacher',
            'type' => Select::class,
            'options' => [
                'label' => 'Teacher',
                'empty_option' => 'Select teacher',
            ],
        ]);
    }

    public function getInputFilterSpecification(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ],
            'name' => [
                'required' => true,
                'filters' => [
                    ['name' => StripTags::class],
                    ['name' => StringTrim::class],
                ],
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                ],
            ],
            'teacher' => [
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ],
        ];
    }
}