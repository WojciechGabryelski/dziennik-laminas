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
            'name' => 'studentCourse',
            'type' => StudentCourseFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true,
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
    }
}