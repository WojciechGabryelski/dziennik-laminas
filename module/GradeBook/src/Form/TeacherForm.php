<?php

namespace GradeBook\Form;

use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilter;
use Laminas\Validator\StringLength;

class TeacherForm extends Form
{
    public function __construct($name = 'teacher', array $options = [])
    {
        parent::__construct($name, $options);
        $this->add([
            'name' => 'courses',
            'type' => '',
            'options' => [
                'label' => 'Courses',
            ],
        ]);

        $inputFilter = $this->getInputFilter();
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