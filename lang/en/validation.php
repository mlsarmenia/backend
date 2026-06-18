<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Հասանելի լեզվի տողերը
    |
    | Հետևյալ լեզվի տողերը պարունակում են լավագույն սխալ նախադիմությունները, որոնք օգտագործվում են
    | վալիդատորի դասում: Կամայական այս կանոների ունացում կարող է հատկացյալություններ կամ տարբեր
    | տարբերակներ, օրինակ՝ չափսի կանոները: Առավելանալու համար միացնեք այս տողերը։
    |
    */

    'accepted' => 'Պետք է ընդունվի :attribute-ն:',
    'accepted_if' => 'Երբ :other-ը հավասար է :value, :attribute-ը պետք է ընդունվի:',
    'active_url' => ':attribute-ը անվավեր URL է:',
    'after' => ':attribute-ը պետք է լինի :date-ից հետո երկրպագույն:',
    'after_or_equal' => ':attribute-ը պետք է լինի :date-ից հետո կամ հավասար:',
    'alpha' => ':attribute-ը պետք է պարունակի միայն տառեր:',
    'alpha_dash' => ':attribute-ը պետք է պարունակի միայն տառեր, թվային նշաններ, գծեր և ենթակատեգրեր:',
    'alpha_num' => ':attribute-ը պետք է պարունակի միայն տառեր և թվեր:',
    'array' => ':attribute-ը պետք է լինի զանգված:',
    'before' => ':attribute-ը պետք է լինի :date-ից առաջ երկրպագույն:',
    'before_or_equal' => ':attribute-ը պետք է լինի :date-ից առաջ կամ հավասար:',
    'between' => [
        'array' => ':attribute-ը պետք է ունենա :min-ից :max տարր:',
        'file' => ':attribute-ը պետք է լինի :min-ից :max կիլոբայթ:',
        'numeric' => ':attribute-ը պետք է լինի :min-ից :max:',
        'string' => ':attribute-ը պետք է լինի :min-ից :max նիշ:',
    ],
    'boolean' => ':attribute-ի դաշտը պետք է լինի true կամ false:',
    'confirmed' => ':attribute-ի հաստատումը չի համընկնում:',
    'current_password' => 'Գաղտնաբառը սխալ է:',
    'date' => ':attribute-ը չի վավեր ամսաթիվ:',
    'date_equals' => ':attribute-ը պետք է լինի :date-ին հավասար ամսաթիվ:',
    'date_format' => ':attribute-ը չի համապատասխանում :format ձևաչափին:',
    'declined' => ':attribute-ը պետք է մերժվի:',
    'declined_if' => 'Երբ :other-ը հավասար է :value, :attribute-ը պետք է մերժվի:',
    'different' => ':attribute-ը և :other-ը պետք է տարբեր լինեն:',
    'digits' => ':attribute-ը պետք է պարունակի :digits թիվ:',
    'digits_between' => ':attribute-ը պետք է լինի :min-ից :max թվեր:',
    'dimensions' => ':attribute-ի նկարը որպես չափեր անվավեր է:',
    'distinct' => ':attribute-ի դաշտը ունի կրկնօրինակ արժեք:',
    'doesnt_end_with' => ':attribute-ը չպետք է ավարտվի հետևյալից որևէ մեկով: :values',
    'doesnt_start_with' => ':attribute-ը չպետք է սկսվի հետևյալից որևէ մեկով: :values',
    'email' => ':attribute-ը պետք է լինի վավեր էլ. փոստի հասցե:',
    'ends_with' => ':attribute-ը պետք է ավարտվի հետևյալից որևէ մեկով: :values',
    'enum' => 'Ընտրված :attribute անվավեր է:',
    'exists' => 'Ընտրված :attribute անվավեր է:',
    'file' => ':attribute-ը պետք է լինի ֆայլ:',
    'filled' => ':attribute-ի դաշտը պետք է լինի լրացված:',
    'gt' => [
        'array' => ':attribute-ը պետք է ունենա :value-ից ավել տարրեր:',
        'file' => ':attribute-ը պետք է լինի :value-ից մեծ կիլոբայթ:',
        'numeric' => ':attribute-ը պետք է լինի :value-ից մեծ:',
        'string' => ':attribute-ը պետք է լինի :value նիշից ավել:',
    ],
    'gte' => [
        'array' => ':attribute-ը պետք է ունենա :value տարր կամ ավել:',
        'file' => ':attribute-ը պետք է լինի :value կիլոբայթ կամ մեծ:',
        'numeric' => ':attribute-ը պետք է լինի :value կամ մեծ:',
        'string' => ':attribute-ը պետք է լինի :value նիշ կամ ավել:',
    ],
    'image' => ':attribute-ը պետք է լինի պատկեր:',
    'in' => 'Ընտրված :attribute անվավեր է:',
    'in_array' => ':attribute-ը չկա :other-ի մեջ:',
    'integer' => ':attribute-ը պետք է լինի ամբողջ թիվ:',
    'ip' => ':attribute-ը պետք է լինի վավեր IP հասցե:',
    'ipv4' => ':attribute-ը պետք է լինի վավեր IPv4 հասցե:',
    'ipv6' => ':attribute-ը պետք է լինի վավեր IPv6 հասցե:',
    'json' => ':attribute-ը պետք է լինի վավեր JSON տեքստ:',
    'lt' => [
        'array' => ':attribute-ը պետք է ունենա :value-ից պակաս տարրեր:',
        'file' => ':attribute-ը պետք է լինի :value-ից փոքր կիլոբայթ:',
        'numeric' => ':attribute-ը պետք է լինի :value-ից փոքր:',
        'string' => ':attribute-ը պետք է լինի :value նիշից փոքր:',
    ],
    'lte' => [
        'array' => ':attribute-ը պետք է ունենա :value տարր կամ պակաս:',
        'file' => ':attribute-ը պետք է լինի :value կիլոբայթ կամ փոքր:',
        'numeric' => ':attribute-ը պետք է լինի :value կամ փոքր:',
        'string' => ':attribute-ը պետք է լինի :value նիշ կամ փոքր:',
    ],
    'mac_address' => ':attribute-ը պետք է լինի վավեր MAC հասցե:',
    'max' => [
        'array' => ':attribute-ը պետք է չի պարունակի :max-ից ավել տարր:',
        'file' => ':attribute-ը պետք է լինի :max կիլոբայթից փոքր:',
        'numeric' => ':attribute-ը պետք է լինի :max-ից փոքր:',
        'string' => ':attribute-ը պետք է լինի :max նիշից փոքր:',
    ],
    'max_digits' => ':attribute-ը չպետք է պարունակի :max թիվեր:',
    'mimes' => ':attribute-ը պետք է լինի :values տեսակի ֆայլ:',
    'mimetypes' => ':attribute-ը պետք է լինի :values տեսակի ֆայլ:',
    'min' => [
        'array' => ':attribute-ը պետք է ունենա ամբողջական :min տարր:',
        'file' => ':attribute-ը պետք է լինի առավելագույնը :min կիլոբայթ:',
        'numeric' => ':attribute-ը պետք է լինի ամբողջական :min:',
        'string' => ':attribute-ը պետք է լինի ամբողջական :min նիշ:',
    ],
    'min_digits' => ':attribute-ը պետք է ունենա ամբողջական :min թիվեր:',
    'multiple_of' => ':attribute-ը պետք է լինի :value-ի բազմապատկաս:',
    'not_in' => 'Ընտրված :attribute անվավեր է:',
    'not_regex' => ':attribute-ի ձևաչափը անվավեր է:',
    'numeric' => ':attribute-ը պետք է լինի թիվ:',
    'password' => [
        'letters' => ':attribute-ը պետք է պարունակի առավելագույնը մեկ տառ:',
        'mixed' => ':attribute-ը պետք է պարունակի առավելագույնը մեկ մեծատառ և մեկ փոքրատառ:',
        'numbers' => ':attribute-ը պետք է պարունակի առավելագույնը մեկ թիվ:',
        'symbols' => ':attribute-ը պետք է պարունակի առավելագույնը մեկ նշան:',
        'uncompromised' => 'Տրված :attribute-ը այստեղից է հանդիպել տվյալների դահլիճում։ Խնդրում եմ ընտրեք այլ :attribute:',
    ],
    'present' => ':attribute-ի դաշտը պետք է լինի առաջարկված:',
    'prohibited' => ':attribute-ի դաշտը արգելված է:',
    'prohibited_if' => ':attribute-ը արգելված է, երբ :other-ը հավասար է :value-ին:',
    'prohibited_unless' => ':attribute-ը արգելված է, եթե :other-ը չի ընդգրկվում :values-ի մեջ:',
    'prohibits' => ':attribute-ը արգելում է :other-ի առաջարկելը:',
    'regex' => ':attribute-ի ձևաչափը անվավեր է:',
    'required' => 'Պարտադիր է լրացման համար։',
    'required_array_keys' => ':attribute-ի դաշտը պետք է պարունակի հետևյալ գրքուկերը: :values',
    'required_if' => ':attribute-ի դաշտը պետք է լինի, երբ :other-ը հավասար է :value:',
    'required_if_accepted' => ':attribute-ը պետք է լինի, երբ :other-ը ընդունվում է:',
    'required_unless' => ':attribute-ի դաշտը պետք է լինի, չի ընդունվում, եթե :other-ը ընդգրկվում չէ :values-ի մեջ:',
    'required_with' => ':attribute-ը պետք է լինի, երբ :values-ը առաջարկված է:',
    'required_with_all' => ':attribute-ը պետք է լինի, երբ բոլոր :values-ը առաջարկված են:',
    'required_without' => ':attribute-ը պետք է լինի, երբ :values-ը չի առաջարկված:',
    'required_without_all' => ':attribute-ը պետք է լինի, երբ բոլոր :values-ը չեն առաջարկված:',
    'same' => ':attribute-ը և :other-ը պետք է համընկնեն:',
    'size' => [
        'array' => ':attribute-ը պետք է պարունակի :size տարր:',
        'file' => ':attribute-ը պետք է լինի :size կիլոբայթ:',
        'numeric' => ':attribute-ը պետք է լինի :size:',
        'string' => ':attribute-ը պետք է լինի :size նիշ:',
    ],
    'starts_with' => ':attribute-ը պետք է սկսվի հետևյալից որևէ մեկով: :values',
    'string' => ':attribute-ը պետք է լինի տեքստ:',
    'timezone' => ':attribute-ը պետք է լինի վավեր ժամային գոտ:',
    'unique' => ':attribute-ը արդեն զբաղված է:',
    'uploaded' => ':attribute-ի բեռը վերբեռնելու ընթացքում սխալ է:',
    'url' => ':attribute-ը պետք է լինի վավեր URL:',
    'uuid' => ':attribute-ը պետք է լինի վավեր UUID:',

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
