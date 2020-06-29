<?php

return [
    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
    | kelas validasi. Beberapa aturan mempunyai banyak versi seperti aturan 'size'.
    | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
    |
    */

    'accepted'        => 'Isian :attribute harus diterima.',
    'active_url'      => 'Isian :attribute bukan URL yang valid.',
    'after'           => 'Isian :attribute harus berisi tanggal setelah :date.',
    'after_or_equal'  => 'Isian :attribute harus berisi tanggal setelah atau sama dengan :date.',
    'alpha'           => 'Isian :attribute hanya boleh berisi huruf.',
    'alpha_dash'      => 'Isian :attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.',
    'alpha_num'       => 'Isian :attribute hanya boleh berisi huruf dan angka.',
    'array'           => 'Isian :attribute harus berisi sebuah array.',
    'before'          => 'Isian :attribute harus berisi tanggal sebelum :date.',
    'before_or_equal' => 'Isian :attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between'         => [
        'numeric' => 'Isian :attribute harus bernilai antara :min sampai :max.',
        'file'    => 'Isian :attribute harus berukuran antara :min sampai :max kilobita.',
        'string'  => 'Isian :attribute harus berisi antara :min sampai :max karakter.',
        'array'   => 'Isian :attribute harus memiliki :min sampai :max anggota.',
    ],
    'boolean'        => 'Isian :attribute harus bernilai true atau false',
    'confirmed'      => 'Konfirmasi :attribute tidak cocok.',
    'date'           => 'Isian :attribute bukan tanggal yang valid.',
    'date_equals'    => 'Isian :attribute harus berisi tanggal yang sama dengan :date.',
    'date_format'    => 'Isian :attribute tidak cocok dengan format :format.',
    'different'      => 'Isian :attribute dan :other harus berbeda.',
    'digits'         => 'Isian :attribute harus terdiri dari :digits angka.',
    'digits_between' => 'Isian :attribute harus terdiri dari :min sampai :max angka.',
    'dimensions'     => 'Isian :attribute tidak memiliki dimensi gambar yang valid.',
    'distinct'       => 'Isian :attribute memiliki nilai yang duplikat.',
    'email'          => 'Isian :attribute harus berupa alamat surel yang valid.',
    'ends_with'      => 'Isian :attribute harus diakhiri salah satu dari berikut: :values',
    'exists'         => 'Isian :attribute yang dipilih tidak valid.',
    'file'           => 'Isian :attribute harus berupa sebuah berkas.',
    'filled'         => 'Isian :attribute harus memiliki nilai.',
    'gt'             => [
        'numeric' => 'Isian :attribute harus bernilai lebih besar dari :value.',
        'file'    => 'Isian :attribute harus berukuran lebih besar dari :value kilobita.',
        'string'  => 'Isian :attribute harus berisi lebih besar dari :value karakter.',
        'array'   => 'Isian :attribute harus memiliki lebih dari :value anggota.',
    ],
    'gte' => [
        'numeric' => 'Isian :attribute harus bernilai lebih besar dari atau sama dengan :value.',
        'file'    => 'Isian :attribute harus berukuran lebih besar dari atau sama dengan :value kilobita.',
        'string'  => 'Isian :attribute harus berisi lebih besar dari atau sama dengan :value karakter.',
        'array'   => 'Isian :attribute harus terdiri dari :value anggota atau lebih.',
    ],
    'image'    => 'Isian :attribute harus berupa gambar.',
    'in'       => 'Isian :attribute yang dipilih tidak valid.',
    'in_array' => 'Isian :attribute tidak ada di dalam :other.',
    'integer'  => 'Isian :attribute harus berupa bilangan bulat.',
    'ip'       => 'Isian :attribute harus berupa alamat IP yang valid.',
    'ipv4'     => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6'     => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json'     => 'Isian :attribute harus berupa JSON string yang valid.',
    'lt'       => [
        'numeric' => 'Isian :attribute harus bernilai kurang dari :value.',
        'file'    => 'Isian :attribute harus berukuran kurang dari :value kilobita.',
        'string'  => 'Isian :attribute harus berisi kurang dari :value karakter.',
        'array'   => 'Isian :attribute harus memiliki kurang dari :value anggota.',
    ],
    'lte' => [
        'numeric' => 'Isian :attribute harus bernilai kurang dari atau sama dengan :value.',
        'file'    => 'Isian :attribute harus berukuran kurang dari atau sama dengan :value kilobita.',
        'string'  => 'Isian :attribute harus berisi kurang dari atau sama dengan :value karakter.',
        'array'   => 'Isian :attribute harus tidak lebih dari :value anggota.',
    ],
    'max' => [
        'numeric' => 'Isian :attribute maskimal bernilai :max.',
        'file'    => 'Isian :attribute maksimal berukuran :max kilobita.',
        'string'  => 'Isian :attribute maskimal berisi :max karakter.',
        'array'   => 'Isian :attribute maksimal terdiri dari :max anggota.',
    ],
    'mimes'     => 'Isian :attribute harus berupa berkas berjenis: :values.',
    'mimetypes' => 'Isian :attribute harus berupa berkas berjenis: :values.',
    'min'       => [
        'numeric' => 'Isian :attribute minimal bernilai :min.',
        'file'    => 'Isian :attribute minimal berukuran :min kilobita.',
        'string'  => 'Isian :attribute minimal berisi :min karakter.',
        'array'   => 'Isian :attribute minimal terdiri dari :min anggota.',
    ],
    'not_in'               => 'Isian :attribute yang dipilih tidak valid.',
    'not_regex'            => 'Format :attribute tidak valid.',
    'numeric'              => 'Isian :attribute harus berupa angka.',
    'password'             => 'Kata sandi salah.',
    'present'              => 'Isian :attribute wajib ada.',
    'regex'                => 'Format :attribute tidak valid.',
    'required'             => 'Isian :attribute wajib diisi.',
    'required_if'          => 'Isian :attribute wajib diisi bila :other adalah :value.',
    'required_unless'      => 'Isian :attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with'        => 'Isian :attribute wajib diisi bila terdapat :values.',
    'required_with_all'    => 'Isian :attribute wajib diisi bila terdapat :values.',
    'required_without'     => 'Isian :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Isian :attribute wajib diisi bila sama sekali tidak terdapat :values.',
    'same'                 => 'Isian :attribute dan :other harus sama.',
    'size'                 => [
        'numeric' => 'Isian :attribute harus berukuran :size.',
        'file'    => 'Isian :attribute harus berukuran :size kilobyte.',
        'string'  => 'Isian :attribute harus berukuran :size karakter.',
        'array'   => 'Isian :attribute harus mengandung :size anggota.',
    ],
    'starts_with' => 'Isian :attribute harus diawali salah satu dari berikut: :values',
    'string'      => 'Isian :attribute harus berupa string.',
    'timezone'    => 'Isian :attribute harus berisi zona waktu yang valid.',
    'unique'      => 'Isian :attribute telah dipakai, silahkan gunakan :attribute lainnya.',
    'uploaded'    => 'Isian :attribute gagal diunggah.',
    'url'         => 'Format :attribute tidak valid.',
    'uuid'        => 'Isian :attribute harus merupakan UUID yang valid.',

    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi untuk atribut sesuai keinginan dengan
    | menggunakan konvensi "attribute.rule" dalam penamaan barisnya. Hal ini mempercepat
    | dalam menentukan baris bahasa kustom yang spesifik untuk aturan atribut yang diberikan.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |---------------------------------------------------------------------------------------
    | Kustom Validasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar 'placeholder' atribut dengan sesuatu
    | yang lebih mudah dimengerti oleh pembaca seperti "Alamat Surel" daripada "surel" saja.
    | Hal ini membantu kita dalam membuat pesan menjadi lebih ekspresif.
    |
    */

    'attributes' => [
    ],
];
