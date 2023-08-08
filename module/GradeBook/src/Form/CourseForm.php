<?php

namespace GradeBook\Form;

use GradeBook\Form\Fieldset\CourseFieldset;
use Laminas\Form\Form;

class CourseForm extends Form
{
    public function init(): void
    {
        $this->add([
            'name' => 'course',
            'type' => CourseFieldset::class,
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