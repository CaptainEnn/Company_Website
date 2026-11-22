<?php

class Validator
{
    private $errors = [];

    public function required($field, $value, $label)
    {
        if (trim((string)$value) === '') $this->errors[$field] = "$label không được để trống.";
        return $this;
    }

    public function email($field, $value, $label = 'Email')
    {
        if (strlen($value) > 150 || !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "$label không hợp lệ hoặc vượt quá 150 ký tự.";
        }
        return $this;
    }

    public function max($field, $value, $max, $label)
    {
        if (preg_match_all('/./us', $value) > $max || !preg_match('//u', $value)) {
            $this->errors[$field] = "$label phải có tối đa $max ký tự Unicode hợp lệ.";
        }
        return $this;
    }

    public function phone($field, $value)
    {
        if ($value !== '' && !preg_match('/\A[+0-9][0-9 ().-]{6,24}\z/', $value)) {
            $this->errors[$field] = 'Số điện thoại không hợp lệ.';
        }
        return $this;
    }

    public function password($field, $value)
    {
        if (strlen($value) > 72 || strpos($value, "\0") !== false
            || !preg_match('/\A.{8,}\z/us', $value) || trim($value) === '') {
            $this->errors[$field] = 'Mật khẩu cần ít nhất 8 ký tự và tối đa 72 byte.';
        }
        return $this;
    }

    public function match($field, $value, $expected)
    {
        if ($value !== $expected) $this->errors[$field] = 'Mật khẩu xác nhận không trùng khớp.';
        return $this;
    }

    public function fails() { return !empty($this->errors); }

    public function errors() { return $this->errors; }
}
