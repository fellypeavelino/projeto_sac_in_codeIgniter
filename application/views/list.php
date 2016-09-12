<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link href="<?= base_url('css/bootstrap.min.css');?>" rel="stylesheet">
		<script type="text/javascript" src="<?= base_url('js/jquery.min.js');?>"></script>
		<script type="text/javascript" src="<?= base_url('js/bootstrap.min.js');?>"></script>
		<script type="text/javascript" src="<?= base_url('js/typeahead.bundle.js');?>"></script>
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
	        .custab{
	            border: 1px solid #ccc;
	            padding: 5px;
	            margin: 5% 0;
	            box-shadow: 3px 3px 2px #ccc;
	            transition: 0.5s;
	        }
	        .custab:hover{
	            box-shadow: 3px 3px 0px transparent;
	            transition: 0.5s;
	        }   
	        .typeahead li {
	            width: 500px;
	        }       
	    </style>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<h1>Lista Chamados</h1>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php if($chamados): ?>
				      <div class="table-responsive">
				        <table class="table table-striped">
				        <div class="input-group">
	                      <input type="text" class="form-control typeahead" placeholder="emails" value="" aria-describedby="basic-addon2">
	                      <span style="cursor:pointer;" class="input-group-addon" id="search">
	                          <i class="glyphicon glyphicon-search"></i>
	                      </span>
	                    </div>
				          <thead>
				            <th>E-mail</th>
				            <th>Pedido</th>
				          </thead>
				          <tbody>
				            <?php foreach($chamados as $chamado): ?>
				            <tr>
				              <td><?=$chamado->email?></td>
				              <td><?=$chamado->numero?></td>
				            </tr>
				          <?php endforeach; ?>
				          </tbody>
				        </table>
				      </div>
						<?php echo $pagination; ?>
		    		<?php endif; ?>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
	    var array = [<? foreach ($listChamados as $chamado) {echo "'".$chamado->email."',";}?>];
	    $(function(){
	        if (typeof array != "undefined") {
	            doTypeHeader(array);
	        } 
	        $("#search").click(function(){
	        	var url = window.location.href
	            window.location.href = url+"/?email="+$(".typeahead").val();
	        });        
	    });
	    function doTypeHeader(array){
	        $('.typeahead').typeahead({ source:array })
	    } 
	</script>
</html>