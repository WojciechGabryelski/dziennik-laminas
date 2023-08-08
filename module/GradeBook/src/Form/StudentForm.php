<?php

namespace GradeBook\Form;

use GradeBook\Form\Fieldset\StudentFieldset;
use Laminas\Form\Form;

class StudentForm extends Form
{
    public function init(): void
    {
        $this->add([
            'name' => 'student',
            'type' => StudentFieldset::class,
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