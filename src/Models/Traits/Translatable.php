<?php

namespace T1k3\LaravelTranslatable\Models\Traits;

/**
 * Trait Translatable
 * @package T1k3\LaravelTranslatable\Models\Traits
 */
trait Translatable
{
    protected $translatable = [];

    /**
     * @return array
     */
    public function getTranslatable(): array
    {
        return $this->translatable;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return app()->getLocale();
    }

    /**
     * @return array
     */
    public function getSupportedLocales(): array
    {
        return config('laravel-translatable.locales');
    }

    /**
     * @param $attribute
     * @param $language
     * @return null
     */
    public function translate($attribute, $language)
    {
        $translatable = $this->getTranslatable();
        $supportedLocales = $this->getSupportedLocales();

        if (in_array($attribute, $translatable) && in_array($language, $supportedLocales)) {
            $array = $this->toArray();
            if (isset($array[$attribute]) && isset($array[$attribute][$language])) {
                return $array[$attribute][$language];
            }
        }

        return null;
    }

    /**
     * @param $query
     * @param string $column
     * @param string|null $key
     * @return array
     */
    public function scopePluckWithTranslate($query, string $column, string $key = null)
    {
        $array = [];
        $items = $query->get();

        foreach ($items as $item) {
            if ($key) $array[$item->{$key}] = $item->{$column};
            else $array[] = $item->{$column};
        }

        return $array;
    }

    /**
     * @param $key
     * @return string
     */
    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);
        $translatable = $this->getTranslatable();
        $language = $this->getLocale();

        if ($value && in_array($key, $translatable)) {
            if (isset($value[$language])) return (string)$value[$language];
            else return (string)trim(reset($value));
        }

        return $value;
    }
}