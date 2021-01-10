<?php namespace App\Models;
use CodeIgniter\Model;

class Paycheck extends Model{
    protected $db = false;
    protected $tb = false;

    public function __construct(){ $this->db = \Config\Database::connect(); $this->tb = $this->db->table('paycheck'); }
    public function savePaycheck($reqData){
        return $this->tb->insert($reqData);
    }
}