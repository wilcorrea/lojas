			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Produtos sem estoque</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Preço</th>
									<th>Estoque</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
<?php foreach($registros as $registro): ?>
								<tr class="odd gradeX">
									<td><?php echo $registro['nome'];?></td>
									<td><?php echo $registro['preco'];?></td>
									<td><?php echo $registro['estoque'];?></td>
									<td align="center">
										<a href="<?php echo $root;?>/admin/estoque/produto/<?php echo $registro['id'];?>"><p class="icone"><i class="fa fa-edit" aria-hidden="true"></i></a>
									</td>
								</tr>
<?php endforeach;?>
							</tbody>
						</table>
						<nav aria-label="Page navigation"><?php echo $links;?></nav>
					</div>
				</div>
			</div>