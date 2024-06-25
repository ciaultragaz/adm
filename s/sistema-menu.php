<?php
    function searchParent($arr,$id,$key){
        foreach ($arr as $k => $v) {
            if($v[$key]==$id){
                return true;
            }
        }
        return false;
    }
switch ($action) {
    case 'json':
          $data = array();
          $Menu = new Menu();
          $Menu->access = (isset($_REQUEST['access'])) ? $_REQUEST['access'] : null;
          $menu = $Menu->getAll();

          $countCaption = 0;
          foreach ($menu['data'] as $key => $value) {
            if($value['caption']){
                $idCaption = $value['id'];
                $caption[$countCaption] = array('text'=>'<span class="itemText">'.$value['label'].'</span>','idMenu'=>$idCaption);
                $countHead = 0 ;
                foreach ($menu['data'] as $k => $v) {
                    if($v['idCaption']==$idCaption){
                        $head = (!$countHead)?array():$head;
                        $idHead = $v['id'];
                        $head[$countHead] = array('text'=>'<span class="iconHead"><i class="'.$v['icon'].' text-info"></i></span> <span class="itemText">'.$v['label'].'</span>','idMenu'=>$idHead,'parent'=>$idCaption);
                        if(searchParent($menu['data'],$idHead,'idHead')){
                            $i=0;
                            foreach ($menu['data'] as $x => $z) {
                                if($z['idHead']==$idHead){
                                    $sub = (!$i)?array():$sub;
                                    $sub[$i] = array('text'=>'<span class="itemText">'.$z['label'].'</span>','idMenu'=>$z['id'],'parent'=>$idHead);
                                    $head[$countHead]['nodes'] = $sub;
                                    $caption[$countCaption]['nodes'] = $head;
                                $i++;
                                }
                            }
                        } else {
                            $caption[$countCaption]['nodes'] = $head;
                        }
                    $countHead++;
                    }             
                } 
            $countCaption++;
            }
        }
        echo json_encode($caption);
        break;
    case 'add':
    case 'set':
        $M = new Menu();
        $M->label = (isset($_REQUEST['label'])) ? $_REQUEST['label'] : null;
        $M->caption = (isset($_REQUEST['caption'])) ? $_REQUEST['caption'] : null;
        $M->head = (isset($_REQUEST['head'])) ? $_REQUEST['head'] : null;
        $M->href = (isset($_REQUEST['href'])) ? $_REQUEST['href'] : null;
        $M->icon = (isset($_REQUEST['icon'])) ? $_REQUEST['icon'] : null;
        $M->idCaption = (isset($_REQUEST['idCaption'])) ? $_REQUEST['idCaption'] : null;
        $M->idHead = (isset($_REQUEST['idHead'])) ? $_REQUEST['idHead'] : null;
        $M->idCaption = ($M->idHead !="" && $M->caption == "0" && $M->head == "0") ?0:$M->idCaption;
        if($action=='add'){
            echo json_encode($M->add());
        } else {
            $M->id = (isset($_REQUEST['idItem'])) ? $_REQUEST['idItem'] : null;
            echo json_encode($M->set());
        }        
        break;
    case 'addAcess':
        $i = 0;
        foreach ($_REQUEST['form'] as $key => $value) {
            $idMenu[$i] = $value['value'];
            $i++;
        }
        //Util::pre($idsMenu);
        $idMenu = implode(',',$idMenu);
        $A = new AcessoMenu();
        $A->idUsuario = (isset($_REQUEST['idUsuario'])) ? $_REQUEST['idUsuario'] : null;
        $A->idsMenu = $idMenu;
        echo json_encode($A->add());
        break;
    case 'getAccessByIdUser':
        $A = new AcessoMenu();
        $A->idUsuario = (isset($_REQUEST['idUsuario'])) ? $_REQUEST['idUsuario'] : null;
        echo json_encode($A->getByIdUser());
        break;
    case 'delete':
        $M = new Menu();
        $M->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        $M->type = (isset($_REQUEST['type'])) ? $_REQUEST['type'] : null;
        echo json_encode($M->deleteItem());
        break;
    case 'getAllByType':
        $M = new Menu();
        $M->caption = (isset($_REQUEST['caption'])) ? $_REQUEST['caption'] : null;
        $M->head = (isset($_REQUEST['head'])) ? $_REQUEST['head'] : null;
        $M->idCaption = (isset($_REQUEST['idCaption'])) ? $_REQUEST['idCaption'] : null;
        echo json_encode($M->getAllByType());
        break;
    case 'getById':
        $M = new Menu();
        $M->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        echo json_encode($M->getById());     
        break;
    default:
        echo "service Sistema Menu";
        break;
}