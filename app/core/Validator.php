<?php
// TODO (phụ trách Auth): bổ sung rule: min, max, match, phone...
class Validator
{
    private $errors = [];
    public function required($field, $value, $label)
    {
        if (trim((string)$value) === '') $this->errors[$field] = "$label không được để trống";
        return $this;
    }
    public function email($field, $value, $label = 'Email')
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) $this->errors[$field] = "$label không hợp lệ";
        return $this;
    }
    public function fails()  { return !empty($this->errors); }
    public function errors() { return $this->errors; }
}
