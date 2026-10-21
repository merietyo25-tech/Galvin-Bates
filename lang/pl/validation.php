<?php

return [
    'accepted'        => 'Pole :attribute musi zostać zaakceptowane.',
    'email'           => 'Pole :attribute musi być prawidłowym adresem e-mail.',
    'max'             => [
        'string' => 'Pole :attribute nie może być dłuższe niż :max znaków.',
    ],
    'min'             => [
        'string' => 'Pole :attribute musi mieć co najmniej :min znaków.',
    ],
    'required'        => 'Pole :attribute jest wymagane.',
    'required_if'     => 'Pole :attribute jest wymagane, gdy :other wynosi :value.',
    'string'          => 'Pole :attribute musi być ciągiem znaków.',
    'unique'          => 'Ta wartość :attribute jest już zajęta.',
    'attributes' => [
        // Sans ces libelles, les messages affichaient le nom technique du champ.
        'name'             => 'imię i nazwisko',
        'email'            => 'adres e-mail',
        'address'          => 'adres',
        'phone'            => 'numer telefonu',
        'tax_number'       => 'numer podatkowy',
        'activity'         => 'działalność',
        'doc_type'         => 'rodzaj dokumentu',
        'id_photo_recto'   => 'dokument tożsamości (przód)',
        'id_photo_verso'   => 'dokument tożsamości (tył)',
        'message'          => 'wiadomość',
        'password'         => 'hasło',
        'amount'           => 'kwota',
        'duration'         => 'okres',
    ],
];
