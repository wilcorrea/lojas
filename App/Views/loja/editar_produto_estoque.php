			<div class="col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo $produto;?></div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form name="produto" autocomplete="off">
									<div style="padding: 0px; margin-bottom: 15px;">
										<label>Quantidade em estoque</label>
										<input type="text" name="estoque" class="form-control" placeholder="exemplo: 1">
									</div>
									<span class="produto" id="<?php echo $id;?>"></span>
									<input type="submit" name="editar_estoque" class="btn btn-outline btn-primary" value="Atualizar"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>