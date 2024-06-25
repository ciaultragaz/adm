<?php
class Db {
  public $db;
  public function __construct($dbSelect="") {

    switch ($dbSelect) {
        case 'appUltraleste':
            $this->database = $dbSelect;
            $this->server   = DB_SERVER;
            $this->port     = DB_PORT;
            $this->user     = DB_USER;
            $this->pass     = DB_PASSWORD;
            break;
        case 'sigma-gas24h':
            $this->database = $dbSelect;
            $this->server   = 's2.corp.net.br';
            $this->port     = DB_PORT;
            $this->user     = 'sigmagas24h';
            $this->pass     = 'mateus24h@2015';
            break;
        case 'sigma-gas24h':
            $this->database = $dbSelect;
            $this->server   = '165.227.91.84';
            $this->port     = DB_PORT;
            $this->user     = 'root';
            $this->pass     = 'A@UltraLeste';
            break;

        default:
            $this->database = DB_NAME;
            $this->server   = DB_SERVER;
            $this->port     = DB_PORT;
            $this->user     = DB_USER;
            $this->pass     = DB_PASSWORD;
            break;
    }

    #3. Make Connection
    $this->db = newADOConnection('mysqli');
    $this->db->Connect($this->server, $this->user, $this->pass, $this->database,$this->port);
    $this->db->setCharset('utf8');
    $this->db->SetFetchMode(ADODB_FETCH_ASSOC);
    return $this->db;
  }
  public function getInstance() {
    return new self;
  }
  public function get() {
    #1. Variables
    $custom   = (isset($this->custom))     ? $this->custom   : null;
    $table    = (isset($this->table))      ? $this->table    : null;
    $fields   = (isset($this->fields))     ? $this->fields   : '*';
    $bind     = (isset($this->bind))       ? $this->bind     : null;
    $where    = (isset($this->where))      ? $this->where    : null;
    $order    = (isset($this->order))      ? $this->order    : null;
    $param    = (isset($this->param))      ? $this->param    : null;
    $debug    = (isset($this->debug))      ? $this->debug    : false;
    $values   = (isset($this->values))     ? $this->values   : false;
    if(!empty($custom)){
      $SQL = $custom;
      //$stmt = $mysqli->prepare($SQL);
      //$stmt->bind_param("s", $param);
    } else {
      if(empty($table) || empty($where)){
        return array('error'=>true, 'msg'=>'Consulta Incompleta');
      }
      $SQL = "SELECT $fields FROM $table $where $order";
    }
    if($debug){
      return array('error'=>true, 'msg'=> $SQL, 'debug'=>true);
    }
    $data     = $this->db->getRow($SQL,$values);
    $dbError  = $this->db->errorMsg();

    if( $dbError ){
      return array('error'=>true, 'msg'=>$dbError, 'total'=>0);
    }

    if(empty($data)){
      return array('error'=>false, 'msg'=>'Nenhum Registro Encontrado', 'total'=>0);
    } else {
      return array('error'=>false, 'msg'=>'Registro Encontrado', 'data'=>$data, 'total'=>1);
    }

  }
  public function getAll(){
    
    $values   = (isset($this->values))  ? $this->values : null;
    $data     = (is_null($values))?$this->db->getAll($this->sql):$this->db->getAll($this->sql,$values);
    $dbError  = $this->db->errorMsg();
    if( $dbError ){
      return array('error'=>true, 'msg'=>$dbError, 'total'=>0);
    }
    if(empty($data)){
      return array('error'=>false, 'msg'=>'Nenhum Registro Encontrado', 'total'=>0);
    } else {
      return array('error'=>false, 'msg'=>'Registro Encontrado', 'data'=>$data,'total'=>count($data));
    }
  }
  public function pages(){
    $group = (isset($this->group))     ? $this->group   : null;
    //($sql, $showRows, $pagina = '', $sqlCount)
    $total_reg = $this->show;
    $page = (!$this->page) ? $pc = '1' : $pc = $this->page;
    $inicio = $pc - 1;
    $inicio = $inicio * $total_reg;
    $limite = $this->db->getAll("$this->sql LIMIT $inicio,$total_reg");
    $affectedRows = $this->db->affected_rows();
    //Util::pre($affectedRows);
    $dbError  = $this->db->errorMsg();

    if( $dbError ){
      return array('error'=>true, 'msg'=>$dbError, 'total'=>0);
    }
    
    $all = $this->db->getRow($this->sqlCount);
    if($group){
      $result = $this->db->Execute($this->sqlCount);
      $all['qtd'] = $result->recordCount();
    }    
    $totalRegisters = $all['qtd'];
    $tp = $totalRegisters / $total_reg;
        
    return array('error'=>false,'data'=>$limite,'total'=>$totalRegisters,'last'=>ceil($tp));
  }
  public function add(){
    $sql    = $this->sql;
    $values = $this->values;
    $content = $this->newContent;
    $this->db->execute($sql,$values);
      $lastId = $this->db->insert_Id();
      if($lastId){
        $this->idRegister = $lastId;
        $this->newContent = json_encode($content);
        $this->log();
        return array('error'=>false,'data'=>true,'lastId'=>$lastId);
      } else{
        return array('error'=>true,'data'=>false,'detail'=>$this->db->errorMsg());
      }    
  }
  public function bulk(){
    $sql    = $this->sql;
    $values = $this->values;
    //$content = $this->newContent;
    $this->db->execute($sql,$values);
    //$lastId = $this->db->insert_Id();
    /*
    if($lastId){
      $this->idRegister = $lastId;
      $this->newContent = json_encode($content);
      $this->log();
      return array('error'=>false,'data'=>true,'lastId'=>$lastId);
    } else{
      return array('error'=>true,'data'=>false,'detail'=>$this->db->errorMsg());
    }
    */
  }
  public function set(){
    $sql    = $this->sql;
    $values = $this->values;
    $idAction = (isset($this->idAction)) ? $this->idAction : null;
    $d = $this->db->execute($sql,$values);
    $e = $this->db->errorMsg();
    if(!$e){
      if($idAction==2 || $idAction==3){
        $i =0;
        $new = array();
        foreach ($this->content as $key => $value) {
          $new[$key] = $values[$i];
          $i++;
        }
        $this->content = json_encode($this->content);
        $this->newContent = json_encode($new);
        $this->log();
      }
      return array('error'=>false,'data'=>true);
    } else {
      return array('error'=>true,'data'=>false,'detail'=>$e);
    }
  }
  public function executeLog($sql){
    $this->db->execute($sql);
    $e = $this->db->errorMsg();
    //exit($e);
            if(!$e){
              return array('error'=>false,'data'=>true);
            } else {
              return array('error'=>true,'data'=>false,'detail'=>$e);
            }
  }
  public function log(){
    $L = new Log();
    $L->content    = (isset($this->content))?$this->content:null;
    $L->newContent = (isset($this->newContent))?$this->newContent:null;
    $L->idRegister = (isset($this->idRegister))?$this->idRegister:null;
    $L->idModule   = $this->idModule;
    $L->idAction   = $this->idAction;
    $L->log();
  }
}