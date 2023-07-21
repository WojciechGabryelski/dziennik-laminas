<?php

namespace GradeBook\Form;

class AdminForm extends UserForm
{
    public function __construct($name = 'admin', array $options = [])
    {
        parent::__construct($name, $options);
    }
}