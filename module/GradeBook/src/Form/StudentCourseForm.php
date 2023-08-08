<?php

namespace GradeBook\Form;

use GradeBook\Form\Fieldset\StudentCourseFieldset;
use Laminas\Form\Form;

class StudentCourseForm extends Form
{
    public function init(): void
    {
        parent::init();
        $this->add([
            'name' => 'student',
            'type' => StudentCourseFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true,
            ],
        ]);
        $inputFilter = $this->getInputFilter();
        $inputFilter->add([
            'name' => 'student',
            'required' => true,
            /*'filters' => [
                ['name' => ToInt::class],
            ],*/
        ]);
        $inputFilter->add([
            'name' => 'course',
            'required' => true,
            /*'filters' => [
                ['name' => ToInt::class],
            ],*/
        ]);
        $this->setInputFilter($inputFilter);
    }
}