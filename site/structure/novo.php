<div class="new_computer">
	<div class="dialog"><p>Novo Registro:</p><p class="error_dialog">Preencha corretamente os campos abaixo.</p></div>
	<form id="new">
		<div id="form" method="post">
			<span> IP: </span>
			<div class="field_container ip">
				<input type="text" id="ip" name="ip" class="find"/>
				<a href="#find">
					<img src="site/images/find.png">
				</a>
			</div>
			<span> MAC: </span>
			<div class="field_container mac">
				<input type="text" id="mac" name="mac" class="find" />
				<a href="#find">
					<img src="site/images/find.png">
				</a>
			</div>
			<span> Usuário: </span>
			<div class="field_container user">
				<input type="text" id="user" name="user"/>
			</div>
		</div>
		<div id="form" class="right">
			<span> Comentários: </span><br />
			<textarea id="comments" name="comments"></textarea><br />
			<input type="submit" value="ENVIAR" />
		</div>
	</form>
</div>