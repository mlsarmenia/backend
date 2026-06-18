<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

trait ApiMultiLanguage
{
    /**
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (isset($this->multi_lang) && in_array($key, $this->multi_lang)) {
            $locale = App::getLocale();
            $key = $key . '_' . config('constants.' . $locale);
        }

        return parent::__get($key);
    }
}
