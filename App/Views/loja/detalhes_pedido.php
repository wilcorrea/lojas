			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Detalhes do pedido</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>ID</th>
											<th>Cliente</th>
										</tr>
									</thead>
									<tbody>
										<tr class="odd gradeX">
											<td><?php echo $id_cliente;?></td>
											<td><?php echo $cliente;?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-lg-6">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>ID</th>
											<th>Pre?o</th>
											<th>Data</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<tr class="odd gradeX">
											<td><?php echo $id_pedido;?></td>
											<td><?php echo $preco;?></td>
											<td><?php echo date('d/m/Y', strtotime($data));?></td>
											<td><?php echo $status;?></td>											
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Produto</th>
										</tr>
									</thead>
									<tbody>
										<tr class="odd gradeX">
											<td><?php echo $produto;?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-lg-6">
<?php if ($status == 'Produto entregue') { ?>
							<div class="alert alert-danger">O produto já foi entregue</div>
<?php } else { ?>
								<form>
									<div class="form-group">
										<div class="col-md-4" style="padding-left: 0px; margin-bottom: 15px;">
											<label>Status</label>
											<select id="seleciona_status" name="status" class="form-control">
												<option value="0" <?php echo ($status == 'Pendente' ? 'selected' : '')?>>Pendente</option>
												<option value="1" <?php echo ($status == 'Produto enviado' ? 'selected' : '')?>>Produto enviado</option>
												<option value="2" <?php echo ($status == 'Produto entregue' ? 'selected' : '')?>>Produto entregue</option>
											</select>
										</div>
									</div>
									<div id="status" name="<?php echo $id_pedido;?>"></div>
									<input type="button" class="btn btn-outline btn-primary" id="id_status" value="Atualizar" style="margin-top: 24px;" disabled />
									<input type="button" class="btn btn-outline btn-danger" id="cancelar" value="Cancelar" style="margin-top: 24px;"/>
								</form>
<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>