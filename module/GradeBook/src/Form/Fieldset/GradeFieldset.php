<?php

namespace GradeBook\Form\Fieldset;

use Laminas\Filter\ToInt;
use Laminas\Form\Fieldset;

use Laminas\Form\Element;
use Laminas\InputFilter\InputFilterProviderInterface;
use Laminas\Validator\Between;

class GradeFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function init(): void
    {
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
            'type' => Element\Select::class,
            'options' => [
                'label' => 'Student',
                'empty_option' => 'Select student',
            ],
        ]);
        $this->add([
            'name' => 'course',
            'type' => Element\Select::class,
            'options' => [
                'label' => 'Course',
                'empty_option' => 'Select course',
            ],
        ]);
    }
    public function getInputFilterSpecification(): array
    {
        return [
            'id' => [
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ],
            'value' => [
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
            ],
            'wage' => [
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ],
            'date' => [
                'required' => false,
            ],
            'student' => [
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ],
            'course' => [
                'required' => true,
                'filters' => [
                    ['name' => ToInt::class],
                ],
            ],
        ];
    }
}