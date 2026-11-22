<?php

class AdminUsersController extends Controller
{
    public function index()
    {
        $search = $this->input('q');
        $validator = (new Validator())->max('q', $search, 150, 'Từ khóa');
        $errors = $validator->errors();
        $users = new User();
        $pagination = new Pagination($errors ? 0 : $users->countAccounts($search));
        $accounts = $errors ? [] : $users->accounts($search, $pagination);
        if ($errors) http_response_code(422);
        $this->view('admin/users/index', [
            'title' => 'Quản lý người dùng', 'search' => $search, 'accounts' => $accounts,
            'pagination' => $pagination, 'errors' => $errors,
        ], 'admin/layouts/main');
    }

    public function show($id, $errors = [], $values = [])
    {
        $account = $this->account($id);
        $this->view('admin/users/show', [
            'title' => 'Chi tiết tài khoản', 'account' => $account,
            'errors' => $errors, 'values' => $values + $account,
        ], 'admin/layouts/main');
    }

    public function edit($id)
    {
        $this->member($id);
        $name = $this->input('name');
        $email = strtolower($this->input('email'));
        $phone = $this->input('phone');
        $values = compact('name', 'email', 'phone');
        $validator = AccountForm::details($name, $email, $phone);
        if ($validator->fails()) return $this->invalid($id, $validator->errors(), $values);
        if (!(new User())->updateMember($id, $name, $email, $phone)) {
            return $this->invalid($id, ['email' => 'Email đã được sử dụng.'], $values);
        }
        $this->finish('Đã cập nhật tài khoản.', $id);
    }

    public function status($id)
    {
        $this->member($id);
        $status = $this->input('status');
        if (!in_array($status, ['active', 'banned'], true)) {
            return $this->invalid($id, ['status' => 'Trạng thái không hợp lệ.']);
        }
        $this->checkUpdated((new User())->setMemberStatus($id, $status));
        $this->finish($status === 'active' ? 'Đã mở khóa tài khoản.' : 'Đã khóa tài khoản.', $id);
    }

    public function reset($id)
    {
        $this->member($id);
        $password = AccountForm::password('password');
        $validator = (new Validator())->password('password', $password)
            ->match('confirmation', AccountForm::password('confirmation'), $password);
        if ($validator->fails()) return $this->invalid($id, $validator->errors());
        $this->checkUpdated((new User())->resetMemberPassword($id, $password));
        $this->finish('Đã đặt lại mật khẩu. Thành viên phải đổi mật khẩu tạm khi đăng nhập.', $id);
    }

    public function delete($id)
    {
        $this->member($id);
        if ($this->input('confirm_delete') !== '1') {
            return $this->invalid($id, ['delete' => 'Hãy xác nhận xóa tài khoản.']);
        }
        $this->checkUpdated((new User())->deleteMember($id));
        $this->finish('Đã xóa tài khoản thành viên.');
    }

    private function account($id)
    {
        $account = preg_match('/\A[1-9][0-9]{0,9}\z/', $id) ? (new User())->find($id) : false;
        if (!$account) {
            http_response_code(404);
            $this->view('errors/404', ['title' => 'Không tìm thấy tài khoản'], 'admin/layouts/main');
            exit;
        }
        return $account;
    }

    private function member($id)
    {
        if ($this->account($id)['role'] !== 'member') {
            http_response_code(403);
            exit('403 — Chỉ được quản lý tài khoản thành viên.');
        }
    }

    private function checkUpdated($updated)
    {
        if (!$updated) {
            http_response_code(409);
            exit('Tài khoản đã thay đổi. Vui lòng tải lại danh sách.');
        }
    }

    private function invalid($id, $errors, $values = [])
    {
        http_response_code(422);
        return $this->show($id, $errors, $values);
    }

    private function finish($message, $id = null)
    {
        $this->flash('success', $message);
        $this->redirect($id === null ? 'admin/users' : 'admin/users/' . $id);
    }
}
