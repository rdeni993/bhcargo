<?php namespace App\Models;
use CodeIgniter\Model;

class Cargo extends Model{

    protected $db = false;
    protected $tb = false;

    public function __construct(){ $this->db = \Config\Database::connect(); $this->tb = $this->db->table('cargo'); }
    public function getAll(){ return $this->tb->get()->getResult(); }

    public function saveCargo($reqData){
        if(empty($reqData)){return false;}
        else{
            $expectedData = [
                'description', 
                'loading_date', 
                'loading_town', 
                'loading_country',
                'unloading_date',
                'unloading_town',
                'unloading_country',
                'cargo_type',
                'cargo_package',
                'cargo_weight',
                'cargo_size'
            ];

            foreach($expectedData as $data){
                if(!$reqData[$data] || empty($reqData[$data])){
                    if($data == 'description'){ $reqData['description'] = "nema"; continue; }
                    return false;
                }
            }

            $session = session();
            $userData = $session->get('bhCargoData');

	    $reqData['loading_country'] = strtolower($reqData['loading_country']);
	    $reqData['unloading_country'] = strtolower($reqData['unloading_country']);

            $insertQuery = $reqData;
            $insertQuery['cargo_active'] = 1;
            $insertQuery['owner'] = $userData->id;

            // Session
            $this->cargoSearchSession($reqData, 'c');

            return $this->tb->insert($insertQuery);

        }
    }

    public function listCargo($offset = 0, $limit = DEF_DB_LIMIT){
        $return = [];
        $this->tb->select("
            cargo.id,
            cargo.loading_country,
            cargo.loading_date,
            cargo.loading_town,
            cargo.unloading_country,
            cargo.unloading_town,
            cargo.unloading_date,
            cargo.cargo_size,
            cargo.cargo_weight,
            cargo_package.package_type
        ");
        $this->tb->join('cargo_package', 'cargo_package.id = cargo.cargo_package');
        $this->tb->where('loading_date >=', date('Y-m-d', time()));
        $this->tb->orderBy('cargo.loading_date', 'asc');
        $return['rows'] = $this->tb->countAllResults(false);
        $return['data'] = $this->tb->get($limit, $offset)->getResult();

        return $return;
    }

    public function listMyCargo($myID, $offset = 0, $limit = DEF_DB_LIMIT){
        if(@!$myID){return false;}

        $this->tb->select("
            cargo.id,
            cargo.loading_country,
            cargo.loading_date,
            cargo.loading_town,
            cargo.unloading_country,
            cargo.unloading_town,
            cargo.unloading_date,
            cargo.cargo_size,
            cargo.cargo_weight,
            cargo_package.package_type
        ");
        $this->tb->join('cargo_package', 'cargo_package.id = cargo.cargo_package');
        $this->tb->where('loading_date >=', date('Y-m-d', time()));
        $this->tb->where('owner', $myID);
        $this->tb->orderBy('cargo.loading_date', 'asc');
        //return $this->tb->get($limit, $offset)->getResult();
        $return['rows'] = $this->tb->countAllResults(false);
        $return['data'] = $this->tb->get($limit, $offset)->getResult();

        return $return;
    }

    public function deleteCargo($myID, $cargoID){
        if(!$myID || !$cargoID){return false;}
        $this->tb->where([
            'owner' => $myID,
            'id'    => $cargoID
        ]);
        return $this->tb->delete();
    }

    public function expandCargo($id){

        $this->tb->select("
        cargo.id as cid, 
        cargo.loading_date,
        cargo.loading_country,
        cargo.loading_town, 
        cargo.unloading_date,
        cargo.unloading_country,
        cargo.unloading_town,
        cargo.cargo_size,
        cargo.cargo_weight,
        cargo_type.cargo_type,
        cargo_package.package_type,
        users.id as uid,
        users.name,
        users.surname,
        users.phone,
        users.email,
        users.company,
        users.company_address
        ");

        $this->tb->join("users", "users.id = cargo.owner");
        $this->tb->join("cargo_package", "cargo.cargo_package = cargo_package.id");
        $this->tb->join("cargo_type", "cargo.cargo_type = cargo_type.id");

        $this->tb->where("cargo.id", $id);

        return $this->tb->get()->getResult()[0];
    }

    public function search($reqData, $offset = 0, $limit = DEF_DB_LIMIT){

        $searchQuery = [];
        $return = [];

        if(empty($reqData)){return false;}
        else{
            if(!empty($reqData['loading_country'])){ $searchQuery['loading_country'] = $reqData['loading_country']; }
            if(!empty($reqData['loading_town'])){ $searchQuery['loading_town'] = $reqData['loading_town']; }
            if(!empty($reqData['loading_date'])){ $searchQuery['loading_date'] = $reqData['loading_date']; }
            if(!empty($reqData['unloading_country'])){ $searchQuery['unloading_country'] = $reqData['unloading_country']; }
            if(!empty($reqData['unloading_town'])){ $searchQuery['unloading_town'] = $reqData['unloading_town']; }
            if(!empty($reqData['unloading_date'])){ $searchQuery['unloading_date'] = $reqData['unloading_date']; }
        }

        $this->tb->select("
        cargo.id as cid, 
        cargo.loading_date,
        cargo.loading_country,
        cargo.loading_town, 
        cargo.unloading_date,
        cargo.unloading_country,
        cargo.unloading_town,
        cargo.cargo_size,
        cargo.cargo_weight,
        cargo_type.cargo_type,
        cargo_package.package_type,
        users.id as uid,
        users.name,
        users.surname,
        users.phone,
        users.company,
        users.company_address
        ");

        $this->tb->join("users", "users.id = cargo.owner");
        $this->tb->join("cargo_package", "cargo.cargo_package = cargo_package.id");
        $this->tb->join("cargo_type", "cargo.cargo_type = cargo_type.id");

        $this->tb->where($searchQuery);
        $this->tb->where('loading_date >=', date('Y-m-d', time()));
        
        $return['rows'] = $this->tb->countAllResults(false);
        $return['data'] = $this->tb->get($limit, $offset)->getResult();

        return $return;
    }

    public function smartSearch($reqData, $offset = 0, $limit = DEF_DB_LIMIT){
        if(empty($reqData)){ return false; }
        else{

            $this->tb->select("
            cargo.id as cid, 
            cargo.loading_date,
            cargo.loading_country,
            cargo.loading_town, 
            cargo.unloading_date,
            cargo.unloading_country,
            cargo.unloading_town,
            cargo.cargo_size,
            cargo.cargo_weight,
            cargo_type.cargo_type,
            cargo_package.package_type,
            users.id as uid,
            users.name,
            users.surname,
            users.phone,
            users.company,
            users.company_address
            ");
    
            $this->tb->join("users", "users.id = cargo.owner");
            $this->tb->join("cargo_package", "cargo.cargo_package = cargo_package.id");
            $this->tb->join("cargo_type", "cargo.cargo_type = cargo_type.id");

            $this->tb->where("(cargo.loading_country = '".$reqData[1]."' OR cargo.loading_town='".$reqData[1]."') AND ( cargo.unloading_country = '".$reqData[2]."' OR cargo.unloading_town = '".$reqData[2]."' )");
            $this->tb->where('loading_date >=', date('Y-m-d', time()));

            $return['rows'] = $this->tb->countAllResults(false);
            $return['data'] = $this->tb->get($limit, $offset)->getResult();

            return $return;

        }
    }

    private function cargoSearchSession($searchData, $searchType){
        $session = session();
        $session->set('bhCargoSearch', $searchData);
        $session->set('bhCargoSearchType', $searchType);
    }

}