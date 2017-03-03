			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Produto</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="produto" autocomplete="off">
									<span class="produto" id="<?php echo $id;?>"></span>
									<div class="form-group">
										<label>Nome</label>
										<input type="text" name="nome" value="<?php echo $nome;?>" class="form-control">
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-top: 15px;">
											<label>Categoria</label>
											<select name="categoria" class="form-control">
												<option value="<?php echo $id_categoria;?>" selected="selected"><?php echo $categoria;?></option>
<?php foreach($registros as $registro): ?>
												<option value="<?php echo $registro['id'];?>"><?php echo $registro['categoria'];?></option>
<?php endforeach;?>
											</select>
										</div>
										<div class="col-md-6" style="padding: 0px; margin-top: 15px;">
											<label>Subcategoria</label>
											<select name="subcategoria" id="habilitado" class="form-control">
												<option value="<?php echo $id_subcategoria;?>" selected="selected"><?php echo $subcategoria;?></option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-top: 15px;">
											<label>Preço</label>
											<input type="text" name="preco" value="<?php echo $preco;?>" class="form-control" placeholder="exemplo: 300">
										</div>
										<div class="col-md-6" style="padding: 0px; margin-top: 15px;">
											<label>Quantidade em estoque</label>
											<input type="text" name="estoque" value="<?php echo $estoque;?>" class="form-control">
										</div>
									</div>
									<input type="submit" name="editar_produto" class="btn btn-outline btn-primary" style="margin-top: 15px;" value="Atualizar"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Fotos <span style="float: right;">Você pode cadastrar <strong><?php echo $falta;?></strong> de <strong>3</strong> fotos</span></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="foto" enctype="multipart/form-data" autocomplete="off">
									<span class="produto" id="<?php echo $id;?>:<?php echo $falta;?>"></span>
									<div class="form-group" style="margin-bottom: 0px;">
										<input type="file" name="foto" id="foto" accept="image/x-png, image/jpg, image/JPG, image/JPEG, image/jpeg" class="inputfile inputfile-2"/>
										<label for="foto"><span>Foto do produto&hellip;</span></label>
									</div>
									<input type="submit" name="cadastrar_foto" class="btn btn-outline btn-primary" value="Cadastrar" <?php echo ($falta == 0 ? 'disabled' : '')?>/>
								</form><br/>
								<div class="alert alert-info" style="<?php echo ($falta == 3 ? 'display: none;' : 'display: block;')?>">Já cadastradas &#8628;</div>
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