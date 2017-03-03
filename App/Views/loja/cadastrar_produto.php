			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Passo 1/2: Produto</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="produto" autocomplete="off">
									<div class="form-group">
										<label>Nome</label>
										<input type="text" name="nome" autocorrect="off" autocapitalize="off" spellcheck="false" class="form-control">
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-bottom: 15px;">
											<label>Categoria</label>
											<select name="categoria" class="form-control">
												<option id="first">Selecione...</option>
<?php foreach($registros as $registro): ?>
												<option value="<?php echo $registro['id'];?>"><?php echo $registro['categoria'];?></option>
<?php endforeach;?>
											</select>
										</div>
										<div class="col-md-6" style="padding: 0px; margin-bottom: 15px;">
											<label>Subcategoria</label>
											<select name="subcategoria" id="habilitado" class="form-control" disabled>
												<option id="first">Selecione...</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6" style="padding-left: 0px; margin-bottom: 15px;">
											<label>Preço</label>
											<input type="text" name="preco" class="form-control">
										</div>
										<div class="col-md-6" style="padding: 0px; margin-bottom: 15px;">
											<label>Quantidade em estoque</label>
											<input type="text" name="estoque" class="form-control">
										</div>
									</div>
									<input type="submit" name="cadastrar_produto" class="btn btn-outline btn-primary" value="Próximo passo"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>