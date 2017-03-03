			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Produtos</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Preço</th>
									<th>Estoque</th>
									<th></th>
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
										<p class="icone"><a href="<?php echo $root;?>/admin/editar/produto/<?php echo $registro['id'];?>"><i class="fa fa-edit" aria-hidden="true"></i></a></p>
									</td>
									<td align="center">
										<p class="icone"><a class="excluir_produto" id="<?php echo $registro['id'];?>"><i class="fa fa-times" aria-hidden="true"></i></a></p>
									</td>
								</tr>
<?php endforeach;?>
							</tbody>
						</table>
						<nav aria-label="Page navigation"><?php echo $links;?></nav>
					</div>
				</div>
			</div>