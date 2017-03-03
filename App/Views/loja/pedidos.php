			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Últimos pedidos</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<th>Preço</th>
									<th>Data</th>
									<th>Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
<?php foreach($registros as $registro): ?>
								<tr class="odd gradeX">
									<td><?php echo $registro['id'];?></td>
									<td><?php echo $registro['preco'];?></td>
									<td><?php echo date('d/m/Y', strtotime($registro['data']));?></td>
									<td>
<?php
switch($registro['status']){
	case 0:
		echo 'Pendente';
		break;
	case 1:
		echo 'Produto enviado';
		break;
	case 2:
		echo 'Produto entregue';
		break;
}
?>
									</td>
									<td align="center">
										<p class="icone"><a href="<?php echo $root;?>/admin/detalhes/pedido/<?php echo $registro['id'];?>"><i class="fa fa-check-square-o" aria-hidden="true"></i></a></p>
									</td>
								</tr>
<?php endforeach;?>
							</tbody>
						</table>
						<nav aria-label="Page navigation"><?php echo $links;?></nav>
					</div>
				</div>
			</div>