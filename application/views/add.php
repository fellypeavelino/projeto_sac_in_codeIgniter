<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link href="<?= base_url('css/bootstrap.min.css');?>" rel="stylesheet">
		<script type="text/javascript" src="<?= base_url('js/jquery.min.js');?>"></script>
		<script type="text/javascript" src="<?= base_url('js/bootstrap.min.js');?>"></script>
		<style type="text/css">
			.red{
		    	color:red;
		    }
			.form-area
			{
			    background-color: #FAFAFA;
				padding: 10px 40px 60px;
				margin: 10px 0px 60px;
				border: 1px solid GREY;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="col-md-5">
			    <div class="form-area">
			        <?= form_open("/MainController/",["role"=>"form"]);?>
			        <br style="clear:both">
			                    <h3 style="margin-bottom: 25px; text-align: center;">Contact Form</h3>
			    				<div class="form-group">
			    					<?
			    						$nome = [
			    							"class"=>"form-control", "id"=>"nome", 
			    							"name"=>"nome", "placeholder"=>"Nome", 
			    							"required"=>"true"
			    						];
			    						echo form_input($nome);
			    					?>
								</div>
								<div class="form-group">
									<?
			    						$mail = [
			    							"class"=>"form-control", "id"=>"email", 
			    							"name"=>"email", "placeholder"=>"E-mail", 
			    							"required"=>"true", "type" => "email"
			    						];
			    						echo form_input($mail);
			    					?>
								</div>
								<div class="form-group">
									<?
			    						$numero = [
			    							"class"=>"form-control", "id"=>"numero", 
			    							"name"=>"numero", "placeholder"=>"Número do Pedido", 
			    							"required"=>"true", "type" => "number", "step" => 1
			    						];
			    						echo form_input($numero);
			    					?>
								</div>
								<div class="form-group">
			    					<?
			    						$titulo = [
			    							"class"=>"form-control", "id"=>"titulo", 
			    							"name"=>"titulo", "placeholder"=>"Título", 
			    							"required"=>"true"
			    						];
			    						echo form_input($titulo);
			    					?>
								</div>
			                    <div class="form-group">
			                    <?
			                    	$attributs = [
			                    		"class"=>"form-control", "id"=>"observacao", 
			                    		"placeholder"=>"Message", "maxlength"=>"140", "rows"=>"7"
			                    	];
			                    	echo form_textarea('observacao', 'Observação', $attributs);
			                    ?>                 
			                    </div>
			            
			        <button type="submit" id="submit" class="btn btn-primary pull-right">Cadastar</button>
			         <?= form_close();?>
			    </div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
	    $(function(){
	            $("#numero").keyup(function(){
	                $.ajax({
	                    url:"<?= base_url('/MainController/validNumero/?numero=');?>"+$("#numero").val(),
	                    type:"GET",
	                    dataType:"JSON",
	                    success:function(data){
	                        if(data.success){
	                            $(".error").remove();
	                            $("#submit").attr("disabled",false);
	                        }else{
	                            if($(".error").length == 0){
	                                var error = "<label class='error'>número do pedido não foi encontrado</label>";
	                                $("form div").eq(2).append(error);
	                                 $("#submit").attr("disabled",true);
	                            }
	                        }
	                    }
	                });
	            });
	            $("#email").blur(function(){
	                $.ajax({
	                    url:"<?= base_url('MainController/validEmail/?email=');?>"+$("#email").val(),
	                    type:"GET",
	                    dataType:"JSON",
	                    success:function(data){
	                        if(!data.success){
	                            $(".error").remove();
	                            $("#submit").attr("disabled",false);
	                        }else{
	                            if($(".error").length == 0){
	                                var error = "<label class='error'>E-mail já foi cadastrado</label>";
	                                $("form div").eq(1).append(error);
	                                $("#submit").attr("disabled",true);
	                            }
	                        }
	                    }
	                })                
	            });        
	    })
	</script>
</html>