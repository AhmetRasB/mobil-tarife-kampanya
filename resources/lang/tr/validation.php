<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Doğrulama Dil Satırları
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki dil satırları doğrulama sınıfı tarafından kullanılan varsayılan
    | hata mesajlarını içerir. Bazı kuralların birden fazla versiyonu vardır.
    | Bu mesajlar burada kolayca özelleştirilebilir.
    |
    */

    'accepted'             => ':attribute kabul edilmelidir.',
    'accepted_if'          => ':other alanı :value değerine sahip olduğunda :attribute kabul edilmelidir.',
    'active_url'           => ':attribute geçerli bir URL olmalıdır.',
    'after'                => ':attribute değeri :date tarihinden sonra olmalıdır.',
    'after_or_equal'       => ':attribute değeri :date tarihinden sonra veya eşit olmalıdır.',
    'alpha'                => ':attribute sadece harflerden oluşmalıdır.',
    'alpha_dash'           => ':attribute sadece harfler, rakamlar ve tirelerden oluşmalıdır.',
    'alpha_num'            => ':attribute sadece harfler ve rakamlar içermelidir.',
    'array'                => ':attribute dizi olmalıdır.',
    'before'               => ':attribute değeri :date tarihinden önce olmalıdır.',
    'before_or_equal'      => ':attribute değeri :date tarihinden önce veya eşit olmalıdır.',
    'between'              => [
        'numeric' => ':attribute :min - :max arasında olmalıdır.',
        'file'    => ':attribute :min - :max kilobayt boyutunda olmalıdır.',
        'string'  => ':attribute :min - :max karakter arasında olmalıdır.',
        'array'   => ':attribute :min - :max arasında nesneye sahip olmalıdır.',
    ],
    'boolean'              => ':attribute sadece doğru veya yanlış olmalıdır.',
    'confirmed'            => ':attribute tekrarı eşleşmiyor.',
    'current_password'     => 'Parola hatalı.',
    'date'                 => ':attribute geçerli bir tarih olmalıdır.',
    'date_equals'          => ':attribute, :date ile aynı tarih olmalıdır.',
    'date_format'          => ':attribute :format formatına uygun olmalıdır.',
    'declined'             => ':attribute reddedilmelidir.',
    'declined_if'          => ':other alanı :value değerine sahip olduğunda :attribute reddedilmelidir.',
    'different'            => ':attribute ile :other birbirinden farklı olmalıdır.',
    'digits'               => ':attribute :digits rakam olmalıdır.',
    'digits_between'       => ':attribute :min ile :max arasında rakam olmalıdır.',
    'dimensions'           => ':attribute görsel ölçüleri geçersiz.',
    'distinct'             => ':attribute alanı yinelenen bir değere sahip.',
    'email'                => ':attribute alanına geçerli bir e-posta adresi yazılmalıdır.',
    'ends_with'            => ':attribute, şunlardan biriyle bitmelidir: :values',
    'enum'                 => 'Seçili :attribute geçersiz.',
    'exists'               => 'Seçili :attribute geçersiz.',
    'file'                 => ':attribute dosya olmalıdır.',
    'filled'               => ':attribute alanının doldurulması zorunludur.',
    'gt'                   => [
        'numeric' => ':attribute, :value değerinden büyük olmalıdır.',
        'file'    => ':attribute, :value kilobayttan büyük olmalıdır.',
        'string'  => ':attribute, :value karakterden büyük olmalıdır.',
        'array'   => ':attribute, :value öğeden fazla öğeye sahip olmalıdır.',
    ],
    'gte'                  => [
        'numeric' => ':attribute, :value değerinden büyük veya eşit olmalıdır.',
        'file'    => ':attribute, :value kilobayttan büyük veya eşit olmalıdır.',
        'string'  => ':attribute, :value karakterden büyük veya eşit olmalıdır.',
        'array'   => ':attribute, :value veya daha fazla öğeye sahip olmalıdır.',
    ],
    'image'                => ':attribute alanı resim dosyası olmalıdır.',
    'in'                   => ':attribute değeri geçersiz.',
    'in_array'             => ':attribute alanı :other içinde mevcut değil.',
    'integer'              => ':attribute tamsayı olmalıdır.',
    'ip'                   => ':attribute geçerli bir IP adresi olmalıdır.',
    'ipv4'                 => ':attribute geçerli bir IPv4 adresi olmalıdır.',
    'ipv6'                 => ':attribute geçerli bir IPv6 adresi olmalıdır.',
    'json'                 => ':attribute geçerli bir JSON dizesi olmalıdır.',
    'lt'                   => [
        'numeric' => ':attribute, :value değerinden küçük olmalıdır.',
        'file'    => ':attribute, :value kilobayttan küçük olmalıdır.',
        'string'  => ':attribute, :value karakterden küçük olmalıdır.',
        'array'   => ':attribute, :value öğeden az öğeye sahip olmalıdır.',
    ],
    'lte'                  => [
        'numeric' => ':attribute, :value değerinden küçük veya eşit olmalıdır.',
        'file'    => ':attribute, :value kilobayttan küçük veya eşit olmalıdır.',
        'string'  => ':attribute, :value karakterden küçük veya eşit olmalıdır.',
        'array'   => ':attribute, :value veya daha az öğeye sahip olmalıdır.',
    ],
    'mac_address'          => ':attribute geçerli bir MAC adresi olmalıdır.',
    'max'                  => [
        'numeric' => ':attribute değeri en çok :max olmalıdır.',
        'file'    => ':attribute boyutu en çok :max kilobayt olmalıdır.',
        'string'  => ':attribute uzunluğu en çok :max karakter olmalıdır.',
        'array'   => ':attribute en çok :max öğeye sahip olmalıdır.',
    ],
    'mimes'                => ':attribute dosya biçimi :values olmalıdır.',
    'mimetypes'            => ':attribute dosya biçimi :values olmalıdır.',
    'min'                  => [
        'numeric' => ':attribute değeri en az :min olmalıdır.',
        'file'    => ':attribute boyutu en az :min kilobayt olmalıdır.',
        'string'  => ':attribute uzunluğu en az :min karakter olmalıdır.',
        'array'   => ':attribute en az :min öğeye sahip olmalıdır.',
    ],
    'multiple_of'          => ':attribute, :value değerinin katları olmalıdır.',
    'not_in'               => 'Seçili :attribute geçersiz.',
    'not_regex'            => ':attribute biçimi geçersiz.',
    'numeric'              => ':attribute sayı olmalıdır.',
    'password'             => 'Parola geçersiz.',
    'present'              => ':attribute alanı mevcut olmalıdır.',
    'prohibited'           => ':attribute alanı kısıtlanmıştır.',
    'prohibited_if'        => ':other alanının değeri :value olduğunda :attribute alanına izin verilmez.',
    'prohibited_unless'    => ':other alanı :values değerinde olmadığı sürece :attribute alanı yasaktır.',
    'prohibits'            => ':attribute alanı, :other alanının mevcut olmasını yasaklar.',
    'regex'                => ':attribute biçimi geçersiz.',
    'required'             => ':attribute alanı gereklidir.',
    'required_array_keys'  => ':attribute alanı şu anahtarları içermelidir: :values.',
    'required_if'          => ':attribute alanı, :other :value değerine sahip olduğunda zorunludur.',
    'required_unless'      => ':attribute alanı, :other :values değerine sahip olmadığında zorunludur.',
    'required_with'        => ':attribute alanı :values varken zorunludur.',
    'required_with_all'    => ':attribute alanı herhangi bir :values değeri varken zorunludur.',
    'required_without'     => ':attribute alanı :values yokken zorunludur.',
    'required_without_all' => ':attribute alanı :values değerlerinin tamamı yokken zorunludur.',
    'same'                 => ':attribute ile :other eşleşmelidir.',
    'size'                 => [
        'numeric' => ':attribute :size olmalıdır.',
        'file'    => ':attribute :size kilobyte olmalıdır.',
        'string'  => ':attribute :size karakter olmalıdır.',
        'array'   => ':attribute :size nesneye sahip olmalıdır.',
    ],
    'starts_with'          => ':attribute şunlardan biri ile başlamalıdır: :values',
    'string'               => ':attribute dizge olmalıdır.',
    'timezone'             => ':attribute geçerli bir saat dilimi olmalıdır.',
    'unique'               => ':attribute daha önceden kayıt edilmiş.',
    'uploaded'             => ':attribute yüklemesi başarısız.',
    'url'                  => ':attribute biçimi geçersiz.',
    'uuid'                 => ':attribute geçerli bir UUID olmalıdır.',

    /*
    |--------------------------------------------------------------------------
    | Özelleştirilmiş Doğrulama Dil Satırları
    |--------------------------------------------------------------------------
    |
    | Burada her doğrulayıcı için özel hata mesajlarını belirtmek için "attribute.rule"
    | şeklinde bir tanımlama yapabilirsiniz. Bu özellik, son kullanıcıya daha
    | dostça hata mesajları vermek için oldukça faydalıdır.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'musteri_adi' => [
            'required' => 'Müşteri adı alanı zorunludur.',
            'max' => 'Müşteri adı en fazla :max karakter olmalıdır.',
        ],
        'telefon' => [
            'required' => 'Telefon numarası alanı zorunludur.',
            'max' => 'Telefon numarası en fazla :max karakter olmalıdır.',
        ],
        'email' => [
            'required' => 'E-posta adresi alanı zorunludur.',
            'email' => 'Geçerli bir e-posta adresi giriniz.',
        ],
        'baslangic_tarihi' => [
            'required' => 'Başlangıç tarihi alanı zorunludur.',
            'date' => 'Geçerli bir tarih giriniz.',
            'after_or_equal' => 'Başlangıç tarihi bugün veya daha sonraki bir tarih olmalıdır.',
        ],
        'bitis_tarihi' => [
            'required' => 'Bitiş tarihi alanı zorunludur.',
            'date' => 'Geçerli bir tarih giriniz.',
            'after' => 'Bitiş tarihi başlangıç tarihinden sonra olmalıdır.',
        ],
        'ad' => [
            'required' => 'Ad alanı zorunludur.',
            'max' => 'Ad en fazla :max karakter olmalıdır.',
        ],
        'aciklama' => [
            'required' => 'Açıklama alanı zorunludur.',
        ],
        'indirim_orani' => [
            'required' => 'İndirim oranı alanı zorunludur.',
            'integer' => 'İndirim oranı bir tamsayı olmalıdır.',
            'min' => 'İndirim oranı en az :min olmalıdır.',
            'max' => 'İndirim oranı en fazla :max olmalıdır.',
        ],
        'fiyat' => [
            'required' => 'Fiyat alanı zorunludur.',
            'numeric' => 'Fiyat bir sayı olmalıdır.',
            'min' => 'Fiyat en az :min olmalıdır.',
        ],
        'internet_miktari' => [
            'required' => 'İnternet miktarı alanı zorunludur.',
            'integer' => 'İnternet miktarı bir tamsayı olmalıdır.',
            'min' => 'İnternet miktarı en az :min olmalıdır.',
        ],
        'dakika_miktari' => [
            'required' => 'Dakika miktarı alanı zorunludur.',
            'integer' => 'Dakika miktarı bir tamsayı olmalıdır.',
            'min' => 'Dakika miktarı en az :min olmalıdır.',
        ],
        'sms_miktari' => [
            'required' => 'SMS miktarı alanı zorunludur.',
            'integer' => 'SMS miktarı bir tamsayı olmalıdır.',
            'min' => 'SMS miktarı en az :min olmalıdır.',
        ],
        'tarifeler' => [
            'required' => 'En az bir tarife seçmelisiniz.',
            'array' => 'Tarifeler bir dizi olmalıdır.',
        ],
        'tarife_id' => [
            'required' => 'Bir tarife seçmelisiniz.',
            'exists' => 'Seçilen tarife geçerli değil.',
        ],
        'kampanya_id' => [
            'exists' => 'Seçilen kampanya geçerli değil.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Özelleştirilmiş Öznitelik İsimleri
    |--------------------------------------------------------------------------
    |
    | Aşağıdaki dil satırları, öznitelik adı yerine "email" gibi daha okunabilir
    | bir form öğesi adı kullanmak istiyorsak kullanılır. Bu sadece mesajlarımızı
    | daha okunabilir hale getirir.
    |
    */

    'attributes' => [
        'musteri_adi' => 'Müşteri Adı',
        'telefon' => 'Telefon Numarası',
        'email' => 'E-posta Adresi',
        'baslangic_tarihi' => 'Başlangıç Tarihi',
        'bitis_tarihi' => 'Bitiş Tarihi',
        'ad' => 'Ad',
        'aciklama' => 'Açıklama',
        'indirim_orani' => 'İndirim Oranı',
        'fiyat' => 'Fiyat',
        'internet_miktari' => 'İnternet Miktarı',
        'dakika_miktari' => 'Dakika Miktarı',
        'sms_miktari' => 'SMS Miktarı',
        'aktif' => 'Aktif',
        'tarifeler' => 'Tarifeler',
        'tarife_id' => 'Tarife',
        'kampanya_id' => 'Kampanya',
    ],
]; 