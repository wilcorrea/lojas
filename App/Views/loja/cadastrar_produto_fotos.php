			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Passo 2/2: Fotos <span style="float: right;">Você pode cadastrar <strong><?php echo $falta;?></strong> de <strong>3</strong> fotos</span></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="foto" enctype="multipart/form-data" autocomplete="off">
									<span class="produto" id="<?php echo $id;?>:<?php echo $falta;?>"></span>
									<div class="form-group" style="margin-bottom: 0px;">
										<input type="file" name="foto" id="foto" accept="image/x-png, image/jpeg" class="inputfile inputfile-2"/>
										<label for="foto"><span>Foto do produto&hellip;</span></label>
									</div>
									<input type="submit" name="cadastrar_foto" class="btn btn-outline btn-primary" value="Cadastrar" <?php echo ($falta == 0 ? 'disabled' : '')?>/>
									<span>ou</span>
									<input type="submit" name="finalizar" class="btn btn-outline btn-primary" value="Finalizar cadastro" <?php echo ($falta == 3 ? 'disabled' : '')?>/>
								</form><br/>
								<div class="alert alert-info" style="<?php echo ($falta == 3 ? 'display: none;' : 'display: block;')?>">Fotos cadastradas &#8628;</div>
<?php foreach($fotos as $foto): ?>
								<div class="col-lg-4">
									<div class="panel panel-danger">
										<div class="panel-body foto">
											<img class="img-responsive" src="<?php echo $root;?>/public/produtos/<?php echo $foto['foto'];?>"/>
										</div>
										<div class="btn excluir_foto btn-danger btn-block" id="<?php echo $foto['id'];?>:<?php echo $foto['foto'];?>">Deletar</div>
									</div>
								</div>
<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
			</div>