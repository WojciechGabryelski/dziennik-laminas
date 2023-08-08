<?php

namespace GradeBook\Form;

use GradeBook\Form\Fieldset\GradeFieldset;
use Laminas\Form\Form;

class GradeForm extends Form
{
    public function init(): void
    {
        $this->add([
            'name' => 'grade',
            'type' => GradeFieldset::class,
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