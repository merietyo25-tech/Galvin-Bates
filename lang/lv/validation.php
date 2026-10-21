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

    'accepted' => 'Lauks :attribute ir jāapstiprina.',
    'accepted_if' => 'The :attribute field must be accepted when :other is :value.',
    'active_url' => 'The :attribute field must be a valid URL.',
    'after' => 'The :attribute field must be a date after :date.',
    'after_or_equal' => 'The :attribute field must be a date after or equal to :date.',
    'alpha' => 'The :attribute field must only contain letters.',
    'alpha_dash' => 'The :attribute field must only contain letters, numbers, dashes, and underscores.',
    'alpha_num' => 'The :attribute field must only contain letters and numbers.',
    'array' => 'The :attribute field must be an array.',
    'ascii' => 'The :attribute field must only contain single-byte alphanumeric characters and symbols.',
    'before' => 'The :attribute field must be a date before :date.',
    'before_or_equal' => 'The :attribute field must be a date before or equal to :date.',
    'between' => [
        'array' => 'The :attribute field must have between :min and :max items.',
        'file' => 'The :attribute field must be between :min and :max kilobytes.',
        'numeric' => 'The :attribute field must be between :min and :max.',
        'string' => 'The :attribute field must be between :min and :max characters.',
    ],
    'boolean' => 'Laukam :attribute jābūt patiesam vai nepatiesam.',
    'can' => 'The :attribute field contains an unauthorized value.',
    'confirmed' => 'Lauka :attribute apstiprinājums nesakrīt.',
    'current_password' => 'The password is incorrect.',
    'date' => 'Laukam :attribute jābūt derīgam datumam.',
    'date_equals' => 'The :attribute field must be a date equal to :date.',
    'date_format' => 'The :attribute field must match the format :format.',
    'decimal' => 'The :attribute field must have :decimal decimal places.',
    'declined' => 'The :attribute field must be declined.',
    'declined_if' => 'The :attribute field must be declined when :other is :value.',
    'different' => 'Laukiem :attribute un :other jāatšķiras.',
    'digits' => 'The :attribute field must be :digits digits.',
    'digits_between' => 'The :attribute field must be between :min and :max digits.',
    'dimensions' => 'The :attribute field has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'doesnt_end_with' => 'The :attribute field must not end with one of the following: :values.',
    'doesnt_start_with' => 'The :attribute field must not start with one of the following: :values.',
    'email' => 'Laukam :attribute jābūt derīgai e-pasta adresei.',
    'ends_with' => 'The :attribute field must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'Izvēlētā :attribute vērtība nav derīga.',
    'extensions' => 'The :attribute field must have one of the following extensions: :values.',
    'file' => 'Laukam :attribute jābūt failam.',
    'filled' => 'Laukam :attribute jābūt aizpildītam.',
    'gt' => [
        'array' => 'The :attribute field must have more than :value items.',
        'file' => 'The :attribute field must be greater than :value kilobytes.',
        'numeric' => 'Laukam :attribute jābūt lielākam par :value.',
        'string' => 'The :attribute field must be greater than :value characters.',
    ],
    'gte' => [
        'array' => 'The :attribute field must have :value items or more.',
        'file' => 'The :attribute field must be greater than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be greater than or equal to :value.',
        'string' => 'The :attribute field must be greater than or equal to :value characters.',
    ],
    'hex_color' => 'The :attribute field must be a valid hexadecimal color.',
    'image' => 'Laukam :attribute jābūt attēlam.',
    'in' => 'Izvēlētā :attribute vērtība nav derīga.',
    'in_array' => 'The :attribute field must exist in :other.',
    'integer' => 'Laukam :attribute jābūt veselam skaitlim.',
    'ip' => 'The :attribute field must be a valid IP address.',
    'ipv4' => 'The :attribute field must be a valid IPv4 address.',
    'ipv6' => 'The :attribute field must be a valid IPv6 address.',
    'json' => 'The :attribute field must be a valid JSON string.',
    'lowercase' => 'The :attribute field must be lowercase.',
    'lt' => [
        'array' => 'The :attribute field must have less than :value items.',
        'file' => 'The :attribute field must be less than :value kilobytes.',
        'numeric' => 'The :attribute field must be less than :value.',
        'string' => 'The :attribute field must be less than :value characters.',
    ],
    'lte' => [
        'array' => 'The :attribute field must not have more than :value items.',
        'file' => 'The :attribute field must be less than or equal to :value kilobytes.',
        'numeric' => 'The :attribute field must be less than or equal to :value.',
        'string' => 'The :attribute field must be less than or equal to :value characters.',
    ],
    'mac_address' => 'The :attribute field must be a valid MAC address.',
    'max' => [
        'array' => 'Lauks :attribute nedrīkst saturēt vairāk par :max vienumiem.',
        'file' => 'Fails :attribute nedrīkst pārsniegt :max KB.',
        'numeric' => 'Lauks :attribute nedrīkst būt lielāks par :max.',
        'string' => 'Lauks :attribute nedrīkst pārsniegt :max rakstzīmes.',
    ],
    'max_digits' => 'The :attribute field must not have more than :max digits.',
    'mimes' => 'Failam :attribute jābūt šāda tipa: :values.',
    'mimetypes' => 'Failam :attribute jābūt šāda tipa: :values.',
    'min' => [
        'array' => 'Laukam :attribute jāsatur vismaz :min vienumi.',
        'file' => 'Failam :attribute jābūt vismaz :min KB.',
        'numeric' => 'Laukam :attribute jābūt vismaz :min.',
        'string' => 'Laukam :attribute jāsatur vismaz :min rakstzīmes.',
    ],
    'min_digits' => 'The :attribute field must have at least :min digits.',
    'missing' => 'The :attribute field must be missing.',
    'missing_if' => 'The :attribute field must be missing when :other is :value.',
    'missing_unless' => 'The :attribute field must be missing unless :other is :value.',
    'missing_with' => 'The :attribute field must be missing when :values is present.',
    'missing_with_all' => 'The :attribute field must be missing when :values are present.',
    'multiple_of' => 'The :attribute field must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute field format is invalid.',
    'numeric' => 'Laukam :attribute jābūt skaitlim.',
    'password' => [
        'letters' => 'The :attribute field must contain at least one letter.',
        'mixed' => 'The :attribute field must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute field must contain at least one number.',
        'symbols' => 'The :attribute field must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'Laukam :attribute jābūt klāt.',
    'present_if' => 'The :attribute field must be present when :other is :value.',
    'present_unless' => 'The :attribute field must be present unless :other is :value.',
    'present_with' => 'The :attribute field must be present when :values is present.',
    'present_with_all' => 'The :attribute field must be present when :values are present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Lauka :attribute formāts nav derīgs.',
    'required' => 'Lauks :attribute ir obligāts.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'Lauks :attribute ir obligāts, ja :other ir :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'Laukiem :attribute un :other jāsakrīt.',
    'size' => [
        'array' => 'The :attribute field must contain :size items.',
        'file' => 'The :attribute field must be :size kilobytes.',
        'numeric' => 'The :attribute field must be :size.',
        'string' => 'The :attribute field must be :size characters.',
    ],
    'starts_with' => 'The :attribute field must start with one of the following: :values.',
    'string' => 'Laukam :attribute jābūt tekstam.',
    'timezone' => 'The :attribute field must be a valid timezone.',
    'unique' => 'Šī :attribute vērtība jau tiek izmantota.',
    'uploaded' => 'Neizdevās augšupielādēt failu :attribute. Iespējams, tas ir pārāk liels.',
    'uppercase' => 'The :attribute field must be uppercase.',
    'url' => 'Laukam :attribute jābūt derīgam URL.',
    'ulid' => 'The :attribute field must be a valid ULID.',
    'uuid' => 'The :attribute field must be a valid UUID.',

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
        'name'             => 'vārds un uzvārds',
        'email'            => 'e-pasta adrese',
        'address'          => 'adrese',
        'phone'            => 'tālruņa numurs',
        'tax_number'       => 'nodokļu numurs',
        'activity'         => 'darbība',
        'doc_type'         => 'dokumenta veids',
        'id_photo_recto'   => 'personu apliecinošs dokuments (priekšpuse)',
        'id_photo_verso'   => 'personu apliecinošs dokuments (aizmugure)',
        'message'          => 'ziņojums',
        'password'         => 'parole',
        'amount'           => 'summa',
        'duration'         => 'termiņš',
    ],

];
