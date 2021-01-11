<?php namespace App\Models;
use CodeIgniter\Model;

class Transport extends Model{

    protected $db = false;
    protected $tb = false;

    public function __construct(){ $this->db = \Config\Database::connect(); $this->tb = $this->db->table('transport'); }
    public function getAll(){ return $this->tb->get()->getResult(); }

    public function saveTransport($reqData){
        if(empty($reqData)){return false;}
        else{
            $expectedData = [
                'vechicle_desc',
                'route_desc', 
                'loading_date', 
                'loading_town', 
                'loading_country',
                'unloading_date',
                'unloading_town',
                'unloading_country'
            ];

            foreach($expectedData as $data){
                if(!$reqData[$data] || empty($reqData[$data])){
                    if( $data == 'vechicle_desc' ){ $reqData['vechicle_desc'] = "nema"; continue; }
                    if( $data == 'route_desc' ){ $reqData['route_desc'] = "nema"; continue; }
                    return false;
                }
            }

            $session = session();
            $userData = $session->get('bhCargoData');


	    $reqData['loading_country'] = strtolower($reqData['loading_country']);
	    $reqData['unloading_country'] = strtolower($reqData['unloading_country']);

            $insertQuery = $reqData;
            $insertQuery['transport_owner'] = $userData->id;

            $this->cargoSearchSession($reqData, 't');

            return $this->tb->insert($insertQuery);

        }
    }

    public function listTransport($offset = 0, $limit = DEF_DB_LIMIT){
        $return = [];
        $return['rows'] = $this->tb->countAll();
        $this->tb->where('loading_date >=', date('Y-m-d', time()));
        $this->tb->orderBy('loading_date', 'asc');
        $return['rows'] = $this->tb->countAllResults(false);
        $return['data'] = $this->tb->get($limit, $offset)->getResult();
        return $return;
    }
    public function listMyTransport($myID, $offset = 0, $limit = DEF_DB_LIMIT){
        if(@!$myID){return false;}
        $this->tb->where('transport_owner', $myID);
        $this->tb->where('loading_date >', date('Y-m-d', time()));
        $this->tb->orderBy('loading_date', 'asc');
        //return $this->tb->get($limit, $offset)->getResult();
        $return['data'] = $this->tb->get()->getResult();
        $return['rows'] = $this->tb->countAllResults();

        return $return;
    }
    public function deleteTransport($myID, $transportID){
        if(@!$myID || @!$transportID){return false;}
        $this->tb->where([
            'transport_owner' => $myID,
            'id'              => $transportID
        ]);
        return $this->tb->delete();
    }


    public function expandTransport($id){
        
        $this->tb->select("
        transport.id as tid, 
        transport.vechicle_desc, 
        transport.route_desc, 
        transport.loading_date,
        transport.loading_country,
        transport.loading_town, 
        transport.unloading_date,
        transport.unloading_country,
        transport.unloading_town,
        users.id as uid,
        users.name,
        users.surname,
        users.phone,
        users.company,
        users.company_address,
        users.email,
        ");
        $this->tb->join('users', 'users.id = transport.transport_owner');
        $this->tb->where("transport.id", $id);
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
        transport.id as tid, 
        transport.vechicle_desc, 
        transport.route_desc, 
        transport.loading_date,
        transport.loading_country,
        transport.loading_town, 
        transport.unloading_date,
        transport.unloading_country,
        transport.unloading_town,
        users.id as uid,
        users.name,
        users.surname,
        users.phone,
        users.company,
        users.company_address
        ");

        $this->tb->join('users', 'users.id = transport.transport_owner');
        $this->tb->where($searchQuery);
        

        $return['rows'] = $this->tb->countAllResults(false);
        $return['data'] = $this->tb->get($limit, $offset)->getResult();

        return $return;
    }

    public function smartSearch($reqData, $offset = 0, $limit = DEF_DB_LIMIT){

        $searchQuery = [];
        $return = [];

        $this->tb->select("
        transport.id as tid, 
        transport.vechicle_desc, 
        transport.route_desc, 
        transport.loading_date,
        transport.loading_country,
        transport.loading_town, 
        transport.unloading_date,
        transport.unloading_country,
        transport.unloading_town,
        users.id as uid,
        users.name,
        users.surname,
        users.phone,
        users.company,
        users.company_address
        ");

        $this->tb->join('users', 'users.id = transport.transport_owner');
        

        $this->tb->where("(transport.loading_country = '".$reqData[1]."' OR transport.loading_town='".$reqData[1]."') AND ( transport.unloading_country = '".$reqData[2]."' OR transport.unloading_town = '".$reqData[2]."' )");
        $this->tb->where('loading_date >=', date('Y-m-d', time()));

        $return['rows'] = $this->tb->countAllResults(false);
        $return['data'] = $this->tb->get()->getResult();

        return $return;
        

        $return['rows'] = $this->tb->countAllResults(false);
        $return['data'] = $this->tb->get()->getResult();

        return $return;
    }


    private function cargoSearchSession($searchData, $searchType){
        $session = session();
        $session->set('bhCargoSearch', $searchData);
        $session->set('bhCargoSearchType', $searchType);
    }
}