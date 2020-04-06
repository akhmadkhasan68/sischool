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

    'accepted' => 'Kolom :attribute harus diterima.',
    'active_url' => 'Kolom :attribute bukan URL yang valid.',
    'after' => 'Kolom :attribute harus tanggal setelah :date.',
    'after_or_equal' => 'Kolom :attribute harus berupa tanggal setelah atau sama dengan tanggal :date.',
    'alpha' => 'Kolom :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Kolom :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num' => 'Kolom :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Kolom :attribute harus berupa sebuah array.',
    'before' => 'Kolom :attribute harus tanggal sebelum tanggal :date.',
    'before_or_equal' => 'Kolom :attribute harus berupa tanggal sebelum atau sama dengan tanggal :date.',
    'between' => [
        'numeric' => 'Kolom :attribute harus di antara :min dan :max.',
        'file' => 'Kolom :attribute harus di antara :min dan :max kilobytes.',
        'string' => 'Kolom :attribute harus di antara :min dan :max karakter.',
        'array' => 'Kolom :attribute harus ada di antara :min dan :max item.',
    ],
    'boolean' => 'Kolom :attribute harus bernilai true or false.',
    'confirmed' => 'Kolom :attribute konfirmasi tidak cocok.',
    'date' => 'Kolom :attribute bukan tanggal yang valid.',
    'date_equals' => 'Kolom :attribute harus sama dengan tanggal :date.',
    'date_format' => 'Kolom :attribute tidak cocok dengan format :format.',
    'different' => 'Kolom :attribute dan :other harus berbeda.',
    'digits' => 'Kolom :attribute harus berupa angka :digits.',
    'digits_between' => 'Kolom :attribute harus di antara angka :min dan angka :max.',
    'dimensions' => 'Kolom :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Kolom :attribute memiliki nilai duplikat.',
    'document' => 'Kolom :attribute harus berupa dokumen.',
    'email' => 'Kolom :attribute harus alamat e-mail yang valid.',
    'ends_with' => 'Kolom :attribute harus diakhiri dengan salah satu dari yang berikut: :values',
    'exists' => 'Kolom :attribute yang dipilih tidak valid.',
    'file' => 'Kolom :attribute harus berupa file.',
    'filled' => 'Kolom :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'Kolom :attribute harus lebih besar dari :value.',
        'file' => 'Kolom :attribute harus lebih besar dari :value kilobytes.',
        'string' => 'Kolom :attribute harus lebih besar dari :value karakter.',
        'array' => 'Kolom :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => 'Kolom :attribute harus lebih besar atau sama dengan :value.',
        'file' => 'Kolom :attribute harus lebih besar atau sama dengan :value kilobytes.',
        'string' => 'Kolom :attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => 'Kolom :attribute harus punya :value item atau lebih.',
    ],
    'image' => 'Kolom :attribute harus berupa gambar.',
    'in' => 'Kolom :attribute yang dipilih tidak valid.',
    'in_array' => 'Kolom :attribute tidak ada di :other.',
    'integer' => 'Kolom :attribute harus berupa integer.',
    'ip' => 'Kolom :attribute harus valid dengan IP address.',
    'ipv4' => 'Kolom :attribute harus valid dengan IPv4 address.',
    'ipv6' => 'Kolom :attribute harus valid dengan IPv6 address.',
    'json' => 'Kolom :attribute harus valid dengan JSON string.',
    'lt' => [
        'numeric' => 'Kolom :attribute harus kurang dari :value.',
        'file' => 'Kolom :attribute harus kurang dari :value kilobytes.',
        'string' => 'Kolom :attribute harus kurang dari :value karakter.',
        'array' => 'Kolom :attribute harus kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => 'Kolom :attribute harus kurang dari atau sama dengan :value.',
        'file' => 'Kolom :attribute harus kurang dari atau sama dengan :value kilobytes.',
        'string' => 'Kolom :attribute harus kurang dari atau sama dengan :value karakter.',
        'array' => 'Kolom :attribute seharusnya tidak boleh lebih dari :value item.',
    ],
    'max' => [
        'numeric' => 'Kolom :attribute seharusnya tidak lebih besar dari :max.',
        'file' => 'Kolom :attribute seharusnya lebih besar dari :max kilobytes.',
        'string' => 'Kolom :attribute seharusnya lebih besar dari :max karakter.',
        'array' => 'Kolom :attribute seharusnya memiliki lebih dari :max item.',
    ],
    'mimes' => 'Kolom :attribute harus berupa file bertipe: :values.',
    'mimetypes' => 'Kolom :attribute harus berupa file bertipe: :values.',
    'min' => [
        'numeric' => 'Kolom :attribute harus minimal :min.',
        'file' => 'Kolom :attribute harus minimal :min kilobytes.',
        'string' => 'Kolom :attribute harus minimal :min karakter.',
        'array' => 'Kolom :attribute minimal harus :min item.',
    ],
    'not_in' => 'Kolom :attribute yang dipilih tidak valid.',
    'not_regex' => 'Kolom :attribute format tidak valid.',
    'numeric' => 'Kolom :attribute berupa angka.',
    'password' => 'Kolom password salah.',
    'present' => 'Kolom :attribute harus ada.',
    'regex' => 'Kolom :attribute format tidak valid.',
    'required' => 'Kolom :attribute wajib diisi.',
    'required_if' => 'Kolom :attribute wajib diisi bila :other adalah :value.',
    'required_unless' => 'Kolom :attribute wajib diisi kecuali :other ada di :values.',
    'required_with' => 'Kolom :attribute wajib diisi bila terdapat :values.',
    'required_with_all' => 'Kolom :attribute wajib diisi bila terdapat :values.',
    'required_without' => 'Kolom :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Kolom :attribute wajib diisi bila tidak terdapat :values yang ada.',
    'same' => 'Kolom :attribute dan :other harus cocok.',
    'size' => [
        'numeric' => 'Kolom :attribute harus berukuran :size.',
        'file' => 'Kolom :attribute harus berukuran :size kilobytes.',
        'string' => 'Kolom :attribute harus berukuran :size karakter.',
        'array' => 'Kolom :attribute harus mengandung :size item.',
    ],
    'starts_with' => 'Kolom :attribute harus dimulai dengan salah satu dari yang berikut: :values',
    'string' => 'Kolom :attribute harus berupa string.',
    'timezone' => 'Kolom :attribute harus berupa zona waktu yang valid.',
    'unique' => 'Kolom :attribute sudah ada sebelumnya.',
    'uploaded' => 'Kolom :attribute gagal diunggah.',
    'url' => 'Kolom :attribute format tidak valid.',
    'uuid' => 'Kolom :attribute harus berupa UUID yang valid.',

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

    'attributes' => [],

];