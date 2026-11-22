<?php

class ProfileController extends Controller
{
    public function index($errors = [], $values = [])
    {
        $account = Auth::user();
        $this->view('profile/index', [
            'title' => 'Hồ sơ cá nhân', 'account' => $account,
            'values' => $values + $account, 'errors' => $errors, 'noIndex' => true,
        ]);
    }

    public function details()
    {
        $name = $this->input('name');
        $email = strtolower($this->input('email'));
        $phone = $this->input('phone');
        $values = compact('name', 'email', 'phone');
        $validator = AccountForm::details($name, $email, $phone);
        if ($validator->fails()) return $this->invalid($validator->errors(), $values);
        $account = Auth::user();
        if ($email !== $account['email']
            && !password_verify(AccountForm::password('email_password'), $account['password_hash'])) {
            return $this->invalid(['email_password' => 'Nhập đúng mật khẩu hiện tại để đổi email.'], $values);
        }
        if (!(new User())->updateProfile($account['id'], $name, $email, $phone)) {
            return $this->invalid(['email' => 'Email đã được sử dụng.'], $values);
        }

        $this->flash('success', 'Đã cập nhật thông tin cá nhân.');
        $this->redirect('profile');
    }

    public function password()
    {
        $account = Auth::user();
        $current = AccountForm::password('current_password');
        $password = AccountForm::password('password');
        $validator = (new Validator())->password('password', $password)
            ->match('confirmation', AccountForm::password('confirmation'), $password);
        if (!password_verify($current, $account['password_hash'])) {
            return $this->invalid(['current_password' => 'Mật khẩu hiện tại không đúng.']);
        }
        if ($validator->fails()) return $this->invalid($validator->errors());
        if ($current === $password) return $this->invalid(['password' => 'Hãy chọn mật khẩu khác mật khẩu hiện tại.']);

        $users = new User();
        if (!$users->changePassword($account['id'], $password, $account['session_version'])) {
            Auth::logout();
            $this->redirect('login');
        }
        // Yêu cầu xác thực lại với mật khẩu mới và thu hồi phiên trên các thiết bị khác.
        Auth::logout();
        $this->flash('success', 'Đã đổi mật khẩu. Hãy đăng nhập bằng mật khẩu mới.');
        $this->redirect('login');
    }

    public function avatar()
    {
        $account = Auth::user();
        list($ok, $path) = Upload::image($_FILES['avatar'] ?? [], 'avatars');
        if (!$ok) return $this->invalid(['avatar' => $path]);
        try {
            $updated = (new User())->setAvatar($account['id'], $path, $account['avatar'], $account['session_version']);
        } catch (Throwable $error) {
            $this->removeAvatar($path);
            throw $error;
        }
        if (!$updated) {
            $this->removeAvatar($path);
            return $this->invalid(['avatar' => 'Hồ sơ vừa thay đổi. Hãy tải lại trang và thử lại.']);
        }

        $this->removeAvatar($account['avatar']);
        $this->flash('success', 'Đã cập nhật ảnh đại diện.');
        $this->redirect('profile');
    }

    private function invalid($errors, $values = [])
    {
        http_response_code(422);
        return $this->index($errors, $values);
    }

    private function removeAvatar($path)
    {
        if ($path && preg_match('#\Auploads/avatars/[a-f0-9]{24}\.(jpg|png|webp)\z#', $path)) {
            $file = BASE_PATH . '/public/' . $path;
            if (is_file($file)) unlink($file);
        }
    }
}
