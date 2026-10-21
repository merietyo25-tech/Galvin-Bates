<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Câmpul :attribute trebuie acceptat.',
    'accepted_if' => 'Câmpul :attribute trebuie acceptat atunci când :other este :value.',
    'active_url' => 'Câmpul :attribute trebuie să fie un URL valid.',
    'after' => 'Câmpul :attribute trebuie să conțină o dată ulterioară datei :date.',
    'after_or_equal' => 'Câmpul :attribute trebuie să conțină o dată ulterioară sau egală cu :date.',
    'alpha' => 'Câmpul :attribute trebuie să conțină doar litere.',
    'alpha_dash' => 'Câmpul :attribute trebuie să conțină doar litere, cifre, cratime și liniuțe de subliniere.',
    'alpha_num' => 'Câmpul :attribute trebuie să conțină doar litere și cifre.',
    'array' => 'Câmpul :attribute trebuie să fie un tablou (array).',
    'ascii' => 'Câmpul :attribute trebuie să conțină doar caractere alfanumerice și simboluri pe un singur octet.',
    'before' => 'Câmpul :attribute trebuie să conțină o dată anterioară datei :date.',
    'before_or_equal' => 'Câmpul :attribute trebuie să conțină o dată anterioară sau egală cu :date.',
    'between' => [
        'array' => 'Câmpul :attribute trebuie să conțină între :min și :max elemente.',
        'file' => 'Câmpul :attribute trebuie să aibă între :min și :max kilobytes.',
        'numeric' => 'Câmpul :attribute trebuie să fie între :min și :max.',
        'string' => 'Câmpul :attribute trebuie să conțină între :min și :max caractere.',
    ],
    'boolean' => 'Câmpul :attribute trebuie să fie adevărat sau fals.',
    'can' => 'Câmpul :attribute conține o valoare neautorizată.',
    'confirmed' => 'Confirmarea câmpului :attribute nu se potrivește.',
    'current_password' => 'Parola este incorectă.',
    'date' => 'Câmpul :attribute trebuie să fie o dată validă.',
    'date_equals' => 'Câmpul :attribute trebuie să fie o dată egală cu :date.',
    'date_format' => 'Câmpul :attribute trebuie să corespundă formatului :format.',
    'decimal' => 'Câmpul :attribute trebuie să aibă :decimal zecimale.',
    'declined' => 'Câmpul :attribute trebuie să fie refuzat.',
    'declined_if' => 'Câmpul :attribute trebuie să fie refuzat atunci când :other este :value.',
    'different' => 'Câmpurile :attribute și :other trebuie să fie diferite.',
    'digits' => 'Câmpul :attribute trebuie să aibă :digits cifre.',
    'digits_between' => 'Câmpul :attribute trebuie să aibă între :min și :max cifre.',
    'dimensions' => 'Câmpul :attribute are dimensiuni de imagine invalide.',
    'distinct' => 'Câmpul :attribute conține o valoare duplicată.',
    'doesnt_end_with' => 'Câmpul :attribute nu trebuie să se termine cu una dintre următoarele valori: :values.',
    'doesnt_start_with' => 'Câmpul :attribute nu trebuie să înceapă cu una dintre următoarele valori: :values.',
    'email' => 'Câmpul :attribute trebuie să fie o adresă de e-mail validă.',
    'ends_with' => 'Câmpul :attribute trebuie să se termine cu una dintre următoarele valori: :values.',
    'enum' => 'Valoarea selectată pentru :attribute este invalidă.',
    'exists' => 'Valoarea selectată pentru :attribute este invalidă.',
    'extensions' => 'Câmpul :attribute trebuie să aibă una dintre următoarele extensii: :values.',
    'file' => 'Câmpul :attribute trebuie să fie un fișier.',
    'filled' => 'Câmpul :attribute trebuie să aibă o valoare.',
    'gt' => [
        'array' => 'Câmpul :attribute trebuie să conțină mai mult de :value elemente.',
        'file' => 'Câmpul :attribute trebuie să fie mai mare de :value kilobytes.',
        'numeric' => 'Câmpul :attribute trebuie să fie mai mare decât :value.',
        'string' => 'Câmpul :attribute trebuie să aibă mai mult de :value caractere.',
    ],
    'gte' => [
        'array' => 'Câmpul :attribute trebuie să conțină :value elemente sau mai multe.',
        'file' => 'Câmpul :attribute trebuie să fie mai mare sau egal cu :value kilobytes.',
        'numeric' => 'Câmpul :attribute trebuie să fie mai mare sau egal cu :value.',
        'string' => 'Câmpul :attribute trebuie să aibă cel puțin :value caractere.',
    ],
    'hex_color' => 'Câmpul :attribute trebuie să fie o culoare hexazecimală validă.',
    'image' => 'Câmpul :attribute trebuie să fie o imagine.',
    'in' => 'Valoarea selectată pentru :attribute este invalidă.',
    'in_array' => 'Câmpul :attribute trebuie să existe în :other.',
    'integer' => 'Câmpul :attribute trebuie să fie un număr întreg.',
    'ip' => 'Câmpul :attribute trebuie să fie o adresă IP validă.',
    'ipv4' => 'Câmpul :attribute trebuie să fie o adresă IPv4 validă.',
    'ipv6' => 'Câmpul :attribute trebuie să fie o adresă IPv6 validă.',
    'json' => 'Câmpul :attribute trebuie să fie un șir JSON valid.',
    'lowercase' => 'Câmpul :attribute trebuie să conțină doar litere mici.',
    'lt' => [
        'array' => 'Câmpul :attribute trebuie să conțină mai puțin de :value elemente.',
        'file' => 'Câmpul :attribute trebuie să fie mai mic de :value kilobytes.',
        'numeric' => 'Câmpul :attribute trebuie să fie mai mic decât :value.',
        'string' => 'Câmpul :attribute trebuie să aibă mai puțin de :value caractere.',
    ],
    'lte' => [
        'array' => 'Câmpul :attribute nu trebuie să conțină mai mult de :value elemente.',
        'file' => 'Câmpul :attribute trebuie să fie mai mic sau egal cu :value kilobytes.',
        'numeric' => 'Câmpul :attribute trebuie să fie mai mic sau egal cu :value.',
        'string' => 'Câmpul :attribute trebuie să aibă cel mult :value caractere.',
    ],
    'mac_address' => 'Câmpul :attribute trebuie să fie o adresă MAC validă.',
    'max' => [
        'array' => 'Câmpul :attribute nu trebuie să conțină mai mult de :max elemente.',
        'file' => 'Câmpul :attribute nu trebuie să fie mai mare de :max kilobytes.',
        'numeric' => 'Câmpul :attribute nu trebuie să fie mai mare de :max.',
        'string' => 'Câmpul :attribute nu trebuie să aibă mai mult de :max caractere.',
    ],
    'max_digits' => 'Câmpul :attribute nu trebuie să aibă mai mult de :max cifre.',
    'mimes' => 'Câmpul :attribute trebuie să fie un fișier de tip: :values.',
    'mimetypes' => 'Câmpul :attribute trebuie să fie un fișier de tip: :values.',
    'min' => [
        'array' => 'Câmpul :attribute trebuie să conțină cel puțin :min elemente.',
        'file' => 'Câmpul :attribute trebuie să aibă cel puțin :min kilobytes.',
        'numeric' => 'Câmpul :attribute trebuie să fie cel puțin :min.',
        'string' => 'Câmpul :attribute trebuie să aibă cel puțin :min caractere.',
    ],
    'min_digits' => 'Câmpul :attribute trebuie să aibă cel puțin :min cifre.',
    'missing' => 'Câmpul :attribute trebuie să lipsească.',
    'missing_if' => 'Câmpul :attribute trebuie să lipsească atunci când :other este :value.',
    'missing_unless' => 'Câmpul :attribute trebuie să lipsească, cu excepția cazului în care :other este :value.',
    'missing_with' => 'Câmpul :attribute trebuie să lipsească atunci când :values este prezent.',
    'missing_with_all' => 'Câmpul :attribute trebuie să lipsească atunci când :values sunt prezente.',
    'multiple_of' => 'Câmpul :attribute trebuie să fie un multiplu al lui :value.',
    'not_in' => 'Valoarea selectată pentru :attribute este invalidă.',
    'not_regex' => 'Formatul câmpului :attribute este invalid.',
    'numeric' => 'Câmpul :attribute trebuie să fie un număr.',
    'password' => [
        'letters' => 'Câmpul :attribute trebuie să conțină cel puțin o literă.',
        'mixed' => 'Câmpul :attribute trebuie să conțină cel puțin o literă mare și o literă mică.',
        'numbers' => 'Câmpul :attribute trebuie să conțină cel puțin o cifră.',
        'symbols' => 'Câmpul :attribute trebuie să conțină cel puțin un simbol.',
        'uncompromised' => 'Valoarea introdusă pentru :attribute a apărut într-o scurgere de date. Vă rugăm să alegeți o altă valoare pentru :attribute.',
    ],
    'present' => 'Câmpul :attribute trebuie să fie prezent.',
    'present_if' => 'Câmpul :attribute trebuie să fie prezent atunci când :other este :value.',
    'present_unless' => 'Câmpul :attribute trebuie să fie prezent, cu excepția cazului în care :other este :value.',
    'present_with' => 'Câmpul :attribute trebuie să fie prezent atunci când :values este prezent.',
    'present_with_all' => 'Câmpul :attribute trebuie să fie prezent atunci când :values sunt prezente.',
    'prohibited' => 'Câmpul :attribute este interzis.',
    'prohibited_if' => 'Câmpul :attribute este interzis atunci când :other este :value.',
    'prohibited_unless' => 'Câmpul :attribute este interzis, cu excepția cazului în care :other se află în :values.',
    'prohibits' => 'Câmpul :attribute interzice prezența câmpului :other.',
    'regex' => 'Formatul câmpului :attribute este invalid.',
    'required' => 'Câmpul :attribute este obligatoriu.',
    'required_array_keys' => 'Câmpul :attribute trebuie să conțină intrări pentru: :values.',
    'required_if' => 'Câmpul :attribute este obligatoriu atunci când :other este :value.',
    'required_if_accepted' => 'Câmpul :attribute este obligatoriu atunci când :other este acceptat.',
    'required_unless' => 'Câmpul :attribute este obligatoriu, cu excepția cazului în care :other se află în :values.',
    'required_with' => 'Câmpul :attribute este obligatoriu atunci când :values este prezent.',
    'required_with_all' => 'Câmpul :attribute este obligatoriu atunci când :values sunt prezente.',
    'required_without' => 'Câmpul :attribute este obligatoriu atunci când :values nu este prezent.',
    'required_without_all' => 'Câmpul :attribute este obligatoriu atunci când niciunul dintre :values nu este prezent.',
    'same' => 'Câmpul :attribute trebuie să corespundă cu :other.',
    'size' => [
        'array' => 'Câmpul :attribute trebuie să conțină :size elemente.',
        'file' => 'Câmpul :attribute trebuie să aibă :size kilobytes.',
        'numeric' => 'Câmpul :attribute trebuie să fie :size.',
        'string' => 'Câmpul :attribute trebuie să aibă :size caractere.',
    ],
    'starts_with' => 'Câmpul :attribute trebuie să înceapă cu una dintre următoarele valori: :values.',
    'string' => 'Câmpul :attribute trebuie să fie un șir de caractere.',
    'timezone' => 'Câmpul :attribute trebuie să fie un fus orar valid.',
    'unique' => 'Valoarea pentru :attribute este deja folosită.',
    'uploaded' => 'Încărcarea câmpului :attribute a eșuat.',
    'uppercase' => 'Câmpul :attribute trebuie să conțină doar litere mari.',
    'url' => 'Câmpul :attribute trebuie să fie un URL valid.',
    'ulid' => 'Câmpul :attribute trebuie să fie un ULID valid.',
    'uuid' => 'Câmpul :attribute trebuie să fie un UUID valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        // Sans ces libelles, les messages affichaient le nom technique du champ.
        'name'             => 'nume și prenume',
        'email'            => 'adresă de e-mail',
        'address'          => 'adresă',
        'phone'            => 'număr de telefon',
        'tax_number'       => 'cod fiscal',
        'activity'         => 'activitate',
        'doc_type'         => 'tip de document',
        'id_photo_recto'   => 'act de identitate (față)',
        'id_photo_verso'   => 'act de identitate (verso)',
        'message'          => 'mesaj',
        'password'         => 'parolă',
        'amount'           => 'sumă',
        'duration'         => 'durată',
    ],

];
