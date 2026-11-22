<?php

class AccountForm
{
    public static function details($name, $email, $phone = '')
    {
        return (new Validator())
            ->required('name', $name, 'Họ tên')
            ->max('name', $name, 100, 'Họ tên')
            ->email('email', $email)
            ->phone('phone', $phone);
    }

    public static function password($key)
    {
        return isset($_POST[$key]) && is_string($_POST[$key]) ? $_POST[$key] : '';
    }
}
