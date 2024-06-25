<div class="user-profile user-card mb-4">
	<div class="card-body py-0">
		<div class="user-about-block m-0">
			<div class="row">
				<div class="col-md-4 text-center mt-n5">
					<div class="change-profile text-center">
						<div class="dropdown w-auto d-inline-block">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<div class="profile-dp">
									<div class="position-relative d-inline-block">
									<?php
										$F = new Funcionarios();
										$F->id = $idUser;
										$d = $F->getById();
										$color = ($d['data']['color'])?'style="border: '.$d['data']['color'].' solid 3px"':'';
									?>
										<img class="img-radius img-fluid wid-100 imgProfile" src="<?php echo $avatar;?>" alt="<?php echo $loginNome;?>" <?php echo $color;?>>
										</div>
										<div class="overlay">
											<span>Mudar</span>
										</div>
									</div>
									<div class="certificated-badge">
										<i class="fas fa-certificate text-c-blue bg-icon"></i>
										<i class="fas fa-check front-icon text-white"></i>
									</div>
								</a>
								<div class="dropdown-menu" style="">
									<a class="dropdown-item" href="javascript:openModal(
										<?php echo $idUser;?>)">
										<i class="feather icon-upload-cloud mr-2"></i>Enviar Nova Imagem
									</a>
									<a class="dropdown-item" href="javascript:openModalImages(
										<?php echo $idUser;?>)">
										<i class="feather icon-image mr-2"></i>De Imagens
									</a>
									<a class="dropdown-item" href="#">
										<i class="feather icon-trash-2 mr-2"></i>remover
									</a>
								</div>
							</div>
						</div>
						<h5 class="mb-1">
							<?php echo $loginNome;?>
						</h5>
						<p class="mb-2 text-muted">
							<?php echo $userCargo;?>
						</p>
					</div>
					<div class="col-md-8 mt-md-4">
						<div class="row">
							<div class="col-md-6">
								<?php if($d['data']['email']){ ?>
								<a href="mailto:demo@domain.com" class="mb-1 text-muted d-flex align-items-end text-h-primary">
									<i class="feather icon-mail mr-2 f-18"></i><?php echo $d['data']['email'];?>
								</a>
								<div class="clearfix"></div>
								<?php } ?>
								<?php if($d['data']['celular']){ ?>
								<a href="#!" class="mb-1 text-muted d-flex align-items-end text-h-primary">
									<i class="feather icon-phone mr-2 f-18"></i><?php echo $d['data']['celular'];?>
								</a>
								<?php } ?>
							</div>
							<div class="col-md-6">
								<div class="media">
									<i class="feather icon-map-pin mr-2 mt-1 f-18"></i>
									<div class="media-body">
										<p class="mb-0 text-muted"><?php echo $d['data']['endereco'].', '.$d['data']['numero'];?></p>
										<p class="mb-0 text-muted"><?php echo $d['data']['bairro'].', '.$d['data']['cidade'].'-'.$d['data']['uf'];?>,</p>
										<p class="mb-0 text-muted">CEP: <?php echo $d['data']['cep'];?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="modalUploadPhoto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Mudar Foto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div id="uploadPhoto"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="modalChangePhoto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Mudar Foto</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<ul class="list-inline" id="listImages"></ul>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
			<div class="col-md-8 order-md-2">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
					</div>
					<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					</div>
					<div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
					</div>
				</div>
			</div>
			<div class="col-md-4 order-md-1">
			<div class="card latest-update-card" id="cardHistoryCargos">
             <div class="card-header">
                <h5>Histórico </h5>
             </div>
             <div class="card-body">
                <div class="latest-update-box">
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="text-center">
                            <div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate">
                            <ul id="pagination" class="pagination"></ul>
                            </div>
                    </div>
                </div>
             </div>
        	 </div>
			</div>
		</div>
