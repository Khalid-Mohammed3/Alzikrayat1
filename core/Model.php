<?php

require_once __DIR__ . '/../config/database.php';

/**
 * Base Model Class
 * Handles database access for all models
 */

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
}