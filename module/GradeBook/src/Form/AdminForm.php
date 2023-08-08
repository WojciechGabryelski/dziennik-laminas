<?php

namespace GradeBook\Form;

use GradeBook\Form\Fieldset\AdminFieldset;
use Laminas\Form\Form;

class AdminForm extends Form
{
    public function init(): void
    {
        $this->add([
            'name' => 'admin',
            'type' => AdminFieldset::class,
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