<?php

namespace GradeBook\Form;

use GradeBook\Form\Fieldset\TeacherFieldset;
use Laminas\Form\Form;

class TeacherForm extends Form
{
    public function init(): void
    {
        $this->add([
            'name' => 'teacher',
            'type' => TeacherFieldset::class,
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