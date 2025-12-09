<?php
namespace App\Models;

require_once BASE_PATH . '/config/database.php';

/**
 * User Model
 */
class User {
    
    public function create($data) {
        try {
            $query = "
                INSERT INTO users (name, email, matricula, course, password, avatar, role, lgpd_accepted)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ";
            
            return \Database::insert($query, [
                $data['name'],
                $data['email'],
                $data['matricula'],
                $data['course'] ?? null,
                $data['password'],
                $data['avatar'] ?? null,
                $data['role'] ?? 'student',
                $data['lgpd_accepted'] ?? false
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function findByEmail($email) {
        $query = "SELECT * FROM users WHERE email = ? AND deleted_at IS NULL LIMIT 1";
        return \Database::selectOne($query, [$email]);
    }

    public function findById($id) {
        $query = "SELECT * FROM users WHERE id = ? AND deleted_at IS NULL LIMIT 1";
        return \Database::selectOne($query, [$id]);
    }

    public function getAll() {
        $query = "SELECT id, name, email, matricula, course, role, created_at FROM users WHERE deleted_at IS NULL ORDER BY created_at DESC";
        return \Database::select($query);
    }

    public function update($id, $data) {
        $set = [];
        $params = [];

        foreach ($data as $key => $value) {
            $set[] = "{$key} = ?";
            $params[] = $value;
        }

        $params[] = $id;

        $query = "UPDATE users SET " . implode(', ', $set) . " WHERE id = ?";
        return \Database::update($query, $params);
    }

    public function updateRememberToken($user_id, $token) {
        $query = "UPDATE users SET remember_token = ? WHERE id = ?";
        return \Database::update($query, [$token, $user_id]);
    }

    public function delete($id) {
        $query = "UPDATE users SET deleted_at = NOW() WHERE id = ?";
        return \Database::update($query, [$id]);
    }

    public function findByRememberToken($token) {
        $query = "SELECT * FROM users WHERE remember_token = ? AND deleted_at IS NULL LIMIT 1";
        return \Database::selectOne($query, [$token]);
    }
}
?>
