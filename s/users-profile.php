<?php
switch ($action) {
    case 'getAllImages':
        $F = new FuncionariosAvatar();
        $F->idFuncionario = $idUser;
        echo json_encode($F->getAllByIdUser());
        break;
    case 'selectAvatar':
        $F = new FuncionariosAvatar();
        $F->id = (isset($_REQUEST['id'])) ? $_REQUEST['id'] : null;
        $F->idFuncionario = (isset($_REQUEST['idFuncionario'])) ? $_REQUEST['idFuncionario'] : null;;
        echo json_encode($F->selectAvatar());
        break;
    case 'removePicture':
        $F = new FuncionariosAvatar();
        $F->id = (isset($_REQUEST['idPicture'])) ? $_REQUEST['idPicture'] : null;
        echo json_encode($F->remove());
        break;
    default:
        echo "service Profile";
        break;
}