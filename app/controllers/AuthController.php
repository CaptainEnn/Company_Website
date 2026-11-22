<?php

class AuthController extends Controller
{
    public function registerForm($values = [], $errors = [])
    {
        $this->view('auth/register', [
            'title' => 'Đăng ký', 'values' => $values, 'errors' => $errors, 'noIndex' => true,
        ]);
    }

    public function register()
    {
        $name = $this->input('name');
        $email = strtolower($this->input('email'));
        $password = AccountForm::password('password');
        $validator = AccountForm::details($name, $email)
            ->password('password', $password)
            ->match('confirmation', AccountForm::password('confirmation'), $password);
        $values = compact('name', 'email');
        if ($validator->fails()) {
            http_response_code(422);
            return $this->registerForm($values, $validator->errors());
        }

        if (!(new User())->create($name, $email, $password)) {
            http_response_code(422);
            return $this->registerForm($values, ['email' => 'Email đã được sử dụng.']);
        }

        $this->flash('success', 'Đăng ký thành công. Bạn có thể đăng nhập.');
        $this->redirect('login');
    }

    public function loginForm($email = '', $errors = [])
    {
        $this->view('auth/login', [
            'title' => 'Đăng nhập', 'values' => ['email' => $email], 'errors' => $errors, 'noIndex' => true,
        ]);
    }

    public function login()
    {
        $email = strtolower($this->input('email'));
        $password = AccountForm::password('password');
        $attempts = array_values(array_filter($_SESSION['login_attempts'] ?? [], function ($at) {
            return $at > time() - 300;
        }));
        if (count($attempts) >= 8) {
            http_response_code(429);
            return $this->loginForm($email, ['login' => 'Vui lòng thử lại sau vài phút.']);
        }
        $attempts[] = time();
        $_SESSION['login_attempts'] = $attempts;

        $valid = !(new Validator())->email('email', $email)->fails()
            && $password !== '' && strlen($password) <= 72 && strpos($password, "\0") === false;
        $user = $valid ? (new User())->byEmail($email) : false;

        // Dùng hash giả để xử lý nhất quán khi email không tồn tại.
        $hash = $user ? $user['password_hash'] :
            '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.';
        if (!password_verify($valid ? $password : '', $hash) || !$user || $user['status'] !== 'active') {
            http_response_code(422);
            return $this->loginForm($email, ['login' => 'Thông tin đăng nhập không hợp lệ hoặc tài khoản đã bị khóa.']);
        }

        Auth::login($user);
        $this->redirect(Auth::isAdmin() ? 'admin/users' : 'profile');
    }

    public function logout()
    {
        Auth::logout();
        $this->flash('success', 'Bạn đã đăng xuất.');
        $this->redirect('login');
    }
}
