<?php namespace App\Models;
use CodeIgniter\Model;

class Cmp_type extends Model{

    protected $db = false;
    protected $tb = false;

    public function __construct(){ $this->db = \Config\Database::connect(); $this->tb = $this->db->table('company_type'); }
    public function getAll(){ return $this->tb->get()->getResult(); }

}