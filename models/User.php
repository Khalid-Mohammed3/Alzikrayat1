<?php

require_once __DIR__ . '/../core/Model.php';

/**
 * User Model
 * Handles database operations related to user accounts.
 */
class User extends Model
{
    /**
     * Find a user by email address.
     *
     * @param string $email User email.
     * @return array|false User data or false if not found.
     */
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetch();
    }

    /**
     * Create a new user account.
     *
     * @param array $data User information including hashed password.
     * @return bool True if account creation succeeds.
     */
    public function create($data)
    {
        $sql = "INSERT INTO users
                (first_name, last_name, email, password)
                VALUES
                (:first_name, :last_name, :email, :password)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => $data['password']
        ]);
    }

    /**
     * Find a user by their ID.
     *
     * @param int $id User ID.
     * @return array|false User data or false if not found.
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch();
    }

    /**
     * Count all registered users.
     *
     * @return int Total number of users.
     */
    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM users");

        return (int) $stmt->fetchColumn();
    }
}