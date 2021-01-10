<?php namespace App\Models;
use CodeIgniter\Model;

class Cargo_package extends Model{

    protected $db = false;
    protected $tb = false;

    public function __construct(){ $this->db = \Config\Database::connect(); $this->tb = $this->db->table('cargo_package'); }
    public function getAll(){ return $this->tb->get()->getResult(); }

}