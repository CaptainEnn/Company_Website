<?php

class User extends Model
{
    public function find($id)
    {
        return $this->query('SELECT * FROM users WHERE id = ? AND deleted_at IS NULL', [$id])->fetch();
    }

    public function byEmail($email)
    {
        return $this->query('SELECT * FROM users WHERE email = ? AND deleted_at IS NULL', [$email])->fetch();
    }

    public function create($name, $email, $password, $role = 'member')
    {
        return $this->unique(function () use ($name, $email, $password, $role) {
            $this->query('INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, ?)',
                [$name, $email, password_hash($password, PASSWORD_DEFAULT), $role]);
        });
    }

    public function updateProfile($id, $name, $email, $phone)
    {
        return $this->unique(function () use ($id, $name, $email, $phone) {
            $this->query('UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ? AND deleted_at IS NULL',
                [$name, $email, $phone === '' ? null : $phone, $id]);
        });
    }

    public function setAvatar($id, $path, $oldPath, $version)
    {
        return $this->query('UPDATE users SET avatar = ? WHERE id = ? AND avatar <=> ?
            AND session_version = ? AND status = "active" AND deleted_at IS NULL',
            [$path, $id, $oldPath, $version])->rowCount() === 1;
    }

    public function changePassword($id, $password, $version)
    {
        return $this->query('UPDATE users SET password_hash = ?, must_change_password = 0,
            session_version = session_version + 1
            WHERE id = ? AND session_version = ? AND status = "active" AND deleted_at IS NULL',
            [password_hash($password, PASSWORD_DEFAULT), $id, $version])->rowCount() === 1;
    }

    private function directoryFilter($search)
    {
        $where = 'deleted_at IS NULL';
        $params = [];
        if ($search !== '') {
            $where .= ' AND (LOCATE(?, name) > 0 OR LOCATE(?, email) > 0)';
            $params = [$search, $search];
        }
        return [$where, $params];
    }

    public function countAccounts($search)
    {
        list($where, $params) = $this->directoryFilter($search);
        return (int)$this->query("SELECT COUNT(*) FROM users WHERE $where", $params)->fetchColumn();
    }

    public function accounts($search, Pagination $pagination)
    {
        list($where, $params) = $this->directoryFilter($search);
        $limit = (int)$pagination->perPage;
        $offset = $pagination->offset();
        return $this->query("SELECT id, name, email, role, status, created_at FROM users
            WHERE $where ORDER BY id DESC LIMIT $limit OFFSET $offset", $params)->fetchAll();
    }

    public function updateMember($id, $name, $email, $phone)
    {
        return $this->unique(function () use ($id, $name, $email, $phone) {
            $this->query('UPDATE users SET name = ?, email = ?, phone = ?
                WHERE id = ? AND role = "member" AND deleted_at IS NULL',
                [$name, $email, $phone === '' ? null : $phone, $id]);
        });
    }

    public function setMemberStatus($id, $status)
    {
        return $this->query('UPDATE users SET status = ?, session_version = session_version + 1
            WHERE id = ? AND role = "member" AND deleted_at IS NULL', [$status, $id])->rowCount() === 1;
    }

    public function resetMemberPassword($id, $password)
    {
        return $this->query('UPDATE users SET password_hash = ?, must_change_password = 1,
            session_version = session_version + 1 WHERE id = ? AND role = "member" AND deleted_at IS NULL',
            [password_hash($password, PASSWORD_DEFAULT), $id])->rowCount() === 1;
    }

    public function deleteMember($id)
    {
        return $this->query('UPDATE users SET deleted_at = CURRENT_TIMESTAMP, status = "banned",
            session_version = session_version + 1 WHERE id = ? AND role = "member" AND deleted_at IS NULL',
            [$id])->rowCount() === 1;
    }

    private function unique($write)
    {
        try {
            $write();
            return true;
        } catch (PDOException $error) {
            if ((int)$error->errorInfo[1] === 1062) return false;
            throw $error;
        }
    }
}
