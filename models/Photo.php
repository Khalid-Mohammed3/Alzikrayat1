<?php

require_once __DIR__ . '/../core/Model.php';

/**
 * Photo Model
 * Handles all database operations related to photos.
 */
class Photo extends Model
{
    /**
     * Get all photos with their owners' names.
     *
     * @return array List of photos.
     * @throws PDOException If a database error occurs.
     */
    public function getAll()
    {
        $sql = "SELECT photos.*, users.first_name, users.last_name
                FROM photos
                JOIN users ON photos.user_id = users.id
                ORDER BY photos.date_time DESC";

        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Insert a new photo into the database.
     *
     * @param array $data Photo information.
     * @return bool True if insertion succeeds.
     * @throws PDOException If a database error occurs.
     */
    public function create($data)
    {
        $sql = "INSERT INTO photos
                (user_id, file_name, title, description)
                VALUES
                (:user_id, :file_name, :title, :description)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':user_id' => $data['user_id'],
            ':file_name' => $data['file_name'],
            ':title' => $data['title'],
            ':description' => $data['description']
        ]);
    }

    /**
     * Find a photo using its ID.
     *
     * @param int $id Photo ID.
     * @return array|false Photo data or false if not found.
     * @throws PDOException If a database error occurs.
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM photos WHERE id = :id"
        );

        $stmt->execute([':id' => $id]);

        return $stmt->fetch();
    }

    /**
     * Delete a photo only if it belongs to the specified user.
     *
     * @param int $id Photo ID.
     * @param int $userId Owner user ID.
     * @return bool True if a photo was deleted.
     * @throws PDOException If a database error occurs.
     */
    public function delete($id, $userId)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM photos
             WHERE id = :id AND user_id = :user_id"
        );

        $stmt->execute([
            ':id' => $id,
            ':user_id' => $userId
        ]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Count all photos stored in the database.
     *
     * @return int Total number of photos.
     * @throws PDOException If a database error occurs.
     */
    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM photos");

        return (int) $stmt->fetchColumn();
    }
}