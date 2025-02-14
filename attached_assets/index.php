<?php
require_once('_config.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<title>Sistema de Gestão Ultragaz 24 Horas</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
    	<link src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></link>
    	<link src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></link>
    	<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="author" content="Camilo" />
	<!-- Favicon icon -->
	<link rel="icon" href="<?php echo $domain;?>assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="<?php echo $domain;?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo $domain;?>assets/css/layout-dark.css">

	<!-- data tables css -->
	<link rel="stylesheet" href="<?php echo $domain;?>assets/css/plugins/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo $domain;?>assets/css/plugins/select.bootstrap4.min.css">

	<link rel="stylesheet" href="<?php echo $domain;?>assets/css/plugins/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo $domain;?>assets/css/plugins/jquery.plupload.queue.css">

	<?php 
		switch ($modulePage) {
			case 'administracao-historico':
				//echo '<link rel="stylesheet" src="'.$domain.'assets/css/plugins/select2.min.css">'."\n";
				echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />';
				break;
			case 'analises-motoristas':
				echo '<link rel="stylesheet" href="'.$domain.'assets/css/plugins/morris.css">';
				echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />';
				break;
			case 'analises-preco-anterior':
				echo '<link rel="stylesheet" href="'.$domain.'assets/css/p/analises-preco-anterior.scss">';
				echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />';		
				break;
			case 'funcionarios-cadastros':
				echo '<link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css" />';
				break;				
			case 'funcionarios-folgas':
				echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />';
				break;				
			case 'funcionarios-horas':
				echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />';
				echo '<link rel="stylesheet" href="'.$domain.'assets/css/plugins/dropzone.min.css">';
				break;				
			case 'atendimento-clientes':
			case 'atendimento-pedidos':
			case 'financeiro-vales':
			case 'financeiro-despesas':
			case 'funcionarios-motoristas':
				//echo '<link rel="stylesheet" src="'.$domain.'assets/css/plugins/select2.min.css">'."\n";
				echo '<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />';
				break;					
		}
    $isFile = Util::searchFile($_SERVER['DOCUMENT_ROOT'].'/assets/css/p/',$a.'-'.$b.'.css');
    if($isFile){ ?>
	<link rel="stylesheet" href="<?php echo $domain;?>assets/css/p/<?php echo $a.'-'.$b;?>.css">
	<?php } ?>
</head>

<body class="">
	<div id="modalSis">
		<div id="btnCloseModalSis"><i class="feather icon-x"></i></div>
		<div id="map"></div>
	</div>
	<div id="modalSisLock"><div id="msgModalLock"></div></div>
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar navbar-dark <?php echo ($toggleMenu)?'navbar-collapsed':'';?>">
		<div class="navbar-wrapper">
			<div class="navbar-content scroll-div ">
				<div class="">
					<div class="main-menu-header">
						<?php if($idUser!=''){
							$FA = new FuncionariosAvatar();
							$FA->idFuncionario = $idUser;
							$F = new Funcionarios();
							$F->id = $idUser;
							$df = $F->getById();
							$d = $FA->getByIdUser();
							$color = ($df['data']['color'])?'style="border: '.$df['data']['color'].' solid 3px"':'';
							
							if($d['total']){
								$d['data']['avatar'];
								$avatar = $domain.'uploads/docs/'.$idUser.'/'.$d['data']['avatar'];
							} else {
								$avatar = $domain.'assets/images/user/avatar-2.jpg';
							}

						?>
						<img class="img-radius imgProfile" src="<?php echo $avatar;?>" alt="<?php echo $loginNome;?>"
							<?php echo $color?>>
						<div class="user-details">
							<div id="more-details">
								<?php echo $loginNome;?><i class="fa fa-caret-down"></i>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-inline">
							<li class="list-inline-item"><a href="/users/profile" data-toggle="tooltip"
									title="Perfil"><i class="feather icon-user"></i></a></li>
							<li class="list-inline-item"><a href="email_inbox.html"><i class="feather icon-mail"
										data-toggle="tooltip" title="Messages"></i><small
										class="badge badge-pill badge-primary">5</small></a></li>
							<li class="list-inline-item"><a href="/logout" data-toggle="tooltip" title="Logout"
									class="text-danger"><i class="feather icon-power"></i></a></li>
						</ul>
					</div>
				</div>
				<?php require_once('includes/menu.php'); ?>
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">

		<div class="m-header">
			<a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
			<a href="/" class="b-brand">
				<!-- ========   change your logo hear   ============ -->
				<img src="<?php echo $domain;?>/assets/images/auth/auth-logo.png" alt="" class="logo"
					style="height: 41px;">
			</a>
			<a href="#" class="mob-toggler">
				<i class="feather icon-more-vertical"></i>
			</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
					<div class="search-bar">
						<input type="text" class="form-control border-0 shadow-none" placeholder="Procurar"
							id="globalSearch">
						<button type="button" class="close" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<li>
					<div class="dropdown">
						<a class="dark-toggle"><i class="icon feather icon-moon"></i></a>
						<a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
								class="icon feather icon-bell"></i></a>
						<div class="dropdown-menu dropdown-menu-right notification">
							<div class="noti-head">
								<h6 class="d-inline-block m-b-0">Notifications</h6>
								<div class="float-right">
									<a href="#!" class="m-r-10">mark as read</a>
									<a href="#!">clear all</a>
								</div>
							</div>
							<ul class="noti-body">
								<li class="n-title">
									<p class="m-b-0">NEW</p>
								</li>
								<li class="notification">
									<div class="media">
										<img class="img-radius imgProfile"
											src="<?php echo $domain;?>assets/images/user/avatar-1.jpg"
											alt="Generic placeholder image">
										<div class="media-body">
											<p><strong>John Doe</strong><span class="n-time text-muted"><i
														class="icon feather icon-clock m-r-10"></i>5 min</span></p>
											<p>New ticket Added</p>
										</div>
									</div>
								</li>
								<li class="n-title">
									<p class="m-b-0">EARLIER</p>
								</li>
								<li class="notification">
									<div class="media">
										<img class="img-radius"
											src="<?php echo $domain;?>assets/images/user/avatar-2.jpg"
											alt="Generic placeholder image">
										<div class="media-body">
											<p><strong>Joseph William</strong><span class="n-time text-muted"><i
														class="icon feather icon-clock m-r-10"></i>10 min</span></p>
											<p>Prchace New Theme and make payment</p>
										</div>
									</div>
								</li>
								<li class="notification">
									<div class="media">
										<img class="img-radius"
											src="<?php echo $domain;?>assets/images/user/avatar-1.jpg"
											alt="Generic placeholder image">
										<div class="media-body">
											<p><strong>Sara Soudein</strong><span class="n-time text-muted"><i
														class="icon feather icon-clock m-r-10"></i>12 min</span></p>
											<p>currently login</p>
										</div>
									</div>
								</li>
								<li class="notification">
									<div class="media">
										<img class="img-radius"
											src="<?php echo $domain;?>assets/images/user/avatar-2.jpg"
											alt="Generic placeholder image">
										<div class="media-body">
											<p><strong>Joseph William</strong><span class="n-time text-muted"><i
														class="icon feather icon-clock m-r-10"></i>30 min</span></p>
											<p>Prchace New Theme and make payment</p>
										</div>
									</div>
								</li>
							</ul>
							<div class="noti-footer">
								<a href="#!">show all</a>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="dropdown drp-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="feather icon-user"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right profile-notification">
							<div class="pro-head">
								<?php if($loginNome!=""){ ?>
								<img src="<?php echo $avatar;?>" class="img-radius imgProfile"
									alt="<?php echo $loginNome;?>">
								<span>
									<?php echo $loginNome;?>
								</span>
								<a href="/logout" class="dud-logout" title="Logout">
									<i class="feather icon-log-out"></i>
								</a>
								<?php }?>
							</div>
							<ul class="pro-body">
								<li><a href="/users/profile" class="dropdown-item"><i class="feather icon-user"></i>
										Perfil</a></li>
								<li><a href="email_inbox.html" class="dropdown-item"><i class="feather icon-mail"></i>
										My Messages</a></li>
								<li><a href="auth-signin.html" class="dropdown-item"><i class="feather icon-lock"></i>
										Lock Screen</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</header>
	<!-- [ Header ] end -->
	<!-- [ Main Content ] start -->
	<div class="pcoded-main-container">
		<div class="pcoded-content">
			<!-- [ breadcrumb ] start -->
			<div class="page-header">
				<div class="page-block">
					<div class="row align-items-center">
						<div class="col-md-12">
							<div class="page-header-title">
								<h5 class="m-b-10">
									<?php echo ucfirst(basename($_SERVER['REQUEST_URI']));?>
								</h5>
							</div>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
								<?php if($a) {
                                echo "<li class=\"breadcrumb-item\"><a href=\"#!\">".ucfirst($_REQUEST['a'])."</a></li>";
                                if($b){
                                    echo "<li class=\"breadcrumb-item\"><a href=\"/".$_REQUEST['a']."/".$_REQUEST['b']."\">".ucfirst($_REQUEST['b'])."</a></li>";
                                }
                                if($c){
                                    echo "<li class=\"breadcrumb-item\"><a href=\"/".$_REQUEST['a']."/".$_REQUEST['b']."/".$_REQUEST['c']."\">".ucfirst($_REQUEST['c'])."</a></li>";
                                }
                            }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- [ breadcrumb ] end -->
			<?php 
            if(!is_null($b)){
				$Paginas = new Paginas();
				$Paginas->section = $a;
				$Paginas->page = $b;
				$dataPaginas = $Paginas->getBySectionPage();

				if($dataPaginas['error']){
					echo $dataPaginas['msg'];
				} else{
					$idsMenuPermission = explode(',',$idsMenu);
					$idMenu = isset($dataPaginas['data']['idMenu']) ? $dataPaginas['data']['idMenu'] : '';
					if(in_array($idMenu,$idsMenuPermission)){
						$fileInclude = $dataPaginas['data']['fileName'];
						$isFile = Util::searchFile($_SERVER['DOCUMENT_ROOT'].'/p/',$fileInclude.'.php');
						if($isFile){
							require_once($_SERVER['DOCUMENT_ROOT'].'/p/'.$fileInclude.'.php');
						 } else{
							require_once($_SERVER['DOCUMENT_ROOT'].'/p/page-construction.php');
						 }
					} else {
						echo "<div>oh no!</div>";
					}

				}
            } else {
                require_once($_SERVER['DOCUMENT_ROOT'].'/p/default.php');
            }
        ?>
		
	</div>
	<!-- [ Main Content ] end -->
	<!-- Warning Section start -->
	<!-- Older IE warning message -->
	<!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
	<!-- Warning Section Ends -->

	<!-- Required Js -->
	<script src="<?php echo $domain;?>assets/js/vendor-all.min.js"></script>
	<script src="<?php echo $domain;?>assets/js/plugins/bootstrap.min.js"></script>
	<script src="<?php echo $domain;?>assets/js/ripple.js"></script>
	<script src="<?php echo $domain;?>assets/js/pcoded.js"></script>
	<script src="<?php echo $domain;?>assets/js/plugins/jquery.twbsPagination.js"></script>
	<script src="<?php echo $domain;?>assets/js/p/global.js"></script>

	<?php 
		switch ($modulePage) {
			case 'analises-motoristas':
				echo '<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>';
				echo '<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>';
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				break;
			case 'analises-preco-anterior':
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				echo '<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>';
				echo '<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/black-tie/jquery-ui.css" />';
				echo '<script src="'.$domain.'assets/js/plugins/apexcharts.min.js"></script>';
				break;				
			case 'atendimento-clientes':
			case 'atendimento-pedidos':
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				echo '<script type="text/javascript" src="https://maps.google.com/maps/api/js?key='.$googleApiKey.'"></script>';
				echo '<script src="'.$domain.'assets/js/plugins/jquery.maskMoney.min.js"></script>';
				break;
			case 'automoveis-automoveis':
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>';
				break;
			case 'administracao-historico':
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				break;
			case 'administracao-parametros':
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>';
				break;
			case 'funcionarios-cadastros':
				echo '<script src="https://unpkg.com/cropperjs"></script>';
				echo '<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>';
				break;
			case 'sistema-menu':
				echo '<script src="'.$domain.'assets/js/plugins/bootstrap-treeview.js"></script>';
				break;
			case 'financeiro-vales':
			case 'financeiro-despesas':
				echo '<script src="'.$domain.'assets/js/plugins/apexcharts.min.js"></script>';
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				//echo '<script src="'.$domain.'assets/js/plugins/select2-tab-fix.min.js"></script>';
				echo '<script src="'.$domain.'assets/js/plugins/jquery.maskMoney.min.js"></script>';
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>';
				break;
			case 'funcionarios-cargos':
				echo '<script src="'.$domain.'assets/js/plugins/jquery.maskMoney.min.js"></script>';
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/TableDnD/0.9.1/jquery.tablednd.js" integrity="sha256-d3rtug+Hg1GZPB7Y/yTcRixO/wlI78+2m08tosoRn7A=" crossorigin="anonymous"></script>';
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>';
				break;
			case 'funcionarios-folgas':
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>';
				break;
			case 'funcionarios-holerites':
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				echo '<script src="'.$domain.'assets/js/plugins/jquery.maskMoney.min.js"></script>';
				break;
			case 'funcionarios-horas':
				echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>';
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				echo '<script src="'.$domain.'assets/js/plugins/dropzone-funcionarios-horas.js"></script>';
				echo '<script src="'.$domain.'assets/js/p/funcionarios-horas-manual.js"></script>';
				break;
			case 'funcionarios-inss':
				echo '<script src="'.$domain.'assets/js/plugins/jquery.maskMoney.min.js"></script>';
				break;
			case 'funcionarios-motoristas':				
				echo '<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>';
				break;
			case 'users-profile':
				break;
			case '-':
				echo '<script src="'.$domain.'assets/js/p/index.js"></script>';
				break;
			default:
				break;
		}		
	$isFile = Util::searchFile($_SERVER['DOCUMENT_ROOT'].'/assets/js/p/',$a.'-'.$b.'.js');
	//echo "qqtaacontecendo?:".'/var/www/html/adm/assets/js/p/'.$a.'-'.$b.'.js';
    if($isFile){ $c = ($c) ? $c : '' ; ?> <script>var c = '<?php echo $c;?>'; </script>
	<script src="<?php echo $domain;?>assets/js/p/<?php echo $a.'-'.$b;?>.js"></script>
	<?php } ?>
	<!-- notification Js -->
	<script src="<?php echo $domain;?>assets/js/plugins/sweetalert.min.js"></script>
	<script src="<?php echo $domain;?>assets/js/plugins/bootstrap-notify.min.js"></script>

	<!-- datepicker js -->
	<script src="<?php echo $domain;?>assets/js/plugins/moment.min.js"></script>
	<script src="<?php echo $domain;?>assets/js/plugins/daterangepicker-pt-br.js"></script>
	<script src="<?php echo $domain;?>assets/js/plugins/daterangepicker.js"></script>

	<script src="<?php echo $domain;?>assets/js/plugins/plupload.full.min.js"></script>
	<script src="<?php echo $domain;?>assets/js/plugins/jquery.plupload.queue.min.js"></script>
	<script src="<?php echo $domain;?>assets/js/plugins/plupload_pt_BR.js"></script>
	<script src="<?php echo $domain;?>assets/js/plugins/jquery.mask.min.js"></script>

</body>

</html>