<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UmProgramador</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<div class="col-md-12 col-md-offset-2">
			<h3>Conversor Moarando</h3>
			<p class="lead">
			O objetivo desse conversor é ajudar aquele pessoal que mexe com "pedra". Ele pega os dados em "txt" gerado pelo equipamento IPR12 e organizar esses dados em uma planilha.
			</p>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<form method="POST" action="php/download.php" enctype="multipart/form-data">
						<div class="form-group">
							<div class="input-group input-file" name="arquivo">
								<span class="input-group-btn">
									<button class="btn btn-default btn-info" type="button">Arquivo</button>
								</span>
								<input type="text" class="form-control" name="arquivo" placeholder='Adicione seu arquivo .txt' />
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-submit btn-primary pull-right">Converter</button>
							<button type="submit" style="display: none;" class="btn-submit">Submit</button>
							<button type="reset" class="btn btn-danger">Limpar</button>
						</div>
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>

			<p class="lead">
			O conversor foi desenvolvido para uma cunhada chata, mas você também pode usar. Afinal, compartilhar conhecimento é ajudar com a evolução.
			</p>

			<blockquote class="blockquote">
			<p class="mb-0">Alguma sugestão? Pode falar com a gente: <a href="https://umprogramador.com.br" target="_blanc">UmProgramador</a>.</p>
			<footer class="blockquote-footer">Nenhuma ideia é pequena demais.</footer>
			</blockquote>
		</div>
	</div>

	<script>
		function bs_input_file() {
			$(".input-file").before(
				function() {
					if ( ! $(this).prev().hasClass('input-ghost') ) {
						var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
						element.attr("name",$(this).attr("name"));
						element.change(function(){
							element.next(element).find('input').val((element.val()).split('\\').pop());
						});
						$(this).find("button.btn-info").click(function(){
							element.click();
						});
						$(this).find("button.btn-reset").click(function(){
							element.val(null);
							$(this).parents(".input-file").find('input').val('');
						});
						$(this).find('input').css("cursor","pointer");
						$(this).find('input').mousedown(function() {
							$(this).parents('.input-file').prev().click();
							return false;
						});
						return element;
					}
				}
			);
		}
		
		$('.btn-submit').click(function(){
			let form = $(this).closest('form');
			let action = form.attr('action');

			let tamanho = $('.form-control').val();

			if(!tamanho || tamanho === '' || tamanho === undefined){
				$('.alert').show();
				alert('É preciso enviar um arquivo para converter!');

				return false;
			}else{	

				$('btn-submit').click();
				// var dados = new FormData($(form).get(0));

				// $.ajax({
				// 	url: action,
				// 	data: dados,
				// 	type: 'post',
				// 	dataType : 'json',
				// 	success: function(resposta){
				// 		console.log(resposta);
				// 	},
				// 	error: function(resposta){
				// 		console.log(resposta);
				// 	},
				// 	processData: false,
				// 	cache: false,
				// 	contentType: false
				// });
			}
		});

		$(function() {
			bs_input_file();
		});
	</script>
</body>
</html>