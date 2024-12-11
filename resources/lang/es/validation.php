<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'max' => [
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'unique' => 'El :attribute ya ha sido registrado.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'attributes' => [
        'first_name' => 'nombre',
        'last_name' => 'apellido',
        'email' => 'correo electrónico',
        'phone' => 'teléfono',
        'password' => 'contraseña',
    ],
];
