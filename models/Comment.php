<?php

require_once __DIR__ . '/../core/Model.php';

/**
 * Comment Model
 * Handles database operations related to photo comments.
 */
class Comment extends Model
{
    /**
     * Retrieve all comments belonging to a specific photo.
     *
     * @param int $photoId Photo ID.
     * @return array List of comments with user names.
     */
    public function getByPhoto($photoId)
    {
        $sql = "SELECT comments.*, users.first_name, users.last_name
                FROM comments
                JOIN users ON comments.user_id = users.id
                WHERE comments.photo_id = :photo_id
                ORDER BY comments.date_time DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':photo_id' => $photoId]);

        return $stmt->fetchAll();
    }

    /**
     * Insert a new comment into the database.
     *
     * @param array $data Comment information.
     * @return bool True if insertion succeeds.
     */
    public function create($data)
    {
        $sql = "INSERT INTO comments
                (photo_id, user_id, comment)
                VALUES (:photo_id, :user_id, :comment)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':photo_id' => $data['photo_id'],
            ':user_id' => $data['user_id'],
            ':comment' => $data['comment']
        ]);
    }

    /**
     * Find a comment by its ID.
     *
     * @param int $id Comment ID.
     * @return array|false Comment data or false if not found.
     */
    public function findById($id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM comments WHERE id = :id"
        );

        $stmt->execute([':id' => $id]);

        return $stmt->fetch();
    }

    /**
     * Delete a comment only if it belongs to the specified user.
     *
     * @param int $id Comment ID.
     * @param int $userId User ID.
     * @return bool True if deletion succeeds.
     */
    public function delete($id, $userId)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM comments
             WHERE id = :id AND user_id = :user_id"
        );

        $stmt->execute([
            ':id' => $id,
            ':user_id' => $userId
        ]);

        return $stmt->rowCount() > 0;
    }

    /**
     * Count all comments in the database.
     *
     * @return int Total number of comments.
     */
    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM comments");

        return (int) $stmt->fetchColumn();
    }
}