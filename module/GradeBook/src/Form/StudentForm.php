<?php

namespace GradeBook\Form;

use Laminas\Filter\ToInt;

class StudentForm extends UserForm
{
    public function __construct($name = 'student', array $options = [])
    {
        parent::__construct($name, $options);
        $this->add([
            'name' => 'grades',
            'type' => '',
            'options' => [
                'label' => 'Grades',
            ],
        ]);
        $this->add([
            'name' => 'courses',
            'type' => '',
            'options' => [
                'label' => 'Courses',
            ],
        ]);

        $inputFilter = $this->getInputFilter();
        $inputFilter->add([
            'name' => 'grades',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
        $inputFilter->add([
            'name' => 'courses',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);
        $this->setInputFilter($inputFilter);
    }
}