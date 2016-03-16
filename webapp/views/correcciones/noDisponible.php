<style>
.btn {
		  background: #e61e85;
		  background-image: -webkit-linear-gradient(top, #e61e85, #f2228e);
		  background-image: -moz-linear-gradient(top, #e61e85, #f2228e);
		  background-image: -ms-linear-gradient(top, #e61e85, #f2228e);
		  background-image: -o-linear-gradient(top, #e61e85, #f2228e);
		  background-image: linear-gradient(to bottom, #e61e85, #f2228e);
		  -webkit-border-radius: 2;
		  -moz-border-radius: 2;
		  border-radius: 2px;
		  text-shadow: 1px 1px 3px #ffffff;
		  -webkit-box-shadow: 0px 1px 3px #faf7fa;
		  -moz-box-shadow: 0px 1px 3px #faf7fa;
		  box-shadow: 0px 1px 3px #faf7fa;
		  font-family: Arial;
		  color: #ffffff;
		  font-size: 15px;
		  padding: 4px 43px 4px 43px;
		  border: solid #E3157D 1px;
		  text-decoration: none;
		}
		
		.btn:hover {
		  background: #f2228e;
		  background-image: -webkit-linear-gradient(top, #f2228e, #e61e85);
		  background-image: -moz-linear-gradient(top, #f2228e, #e61e85);
		  background-image: -ms-linear-gradient(top, #f2228e, #e61e85);
		  background-image: -o-linear-gradient(top, #f2228e, #e61e85);
		  background-image: linear-gradient(to bottom, #f2228e, #e61e85);
		  text-decoration: none;
		}
</style>

<div class="register-container container">
	<div class="row">                
		<div class="register">
			<form role="form" id="noDisponible" name="registra_beneficiario" action="" method="post">
				<div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                	<a href="http://www.prepasi.df.gob.mx/">	<img  src="resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;</a>
                       	<!-- <img src="../resources/formulario/img/tit_sistema.png" style="padding-top:10px;" align="top" />  -->                        	
                </div>
                <?php	if (isset($disponible) && $disponible==1){?>
				<div class="form-goup">
					<br>
					<table width="100%" border="0">		                        	
			        	<tr>
			        		<td>NO HAY CORRECCIONES EN ESTE MOMENTO</td>		                        		
			            </tr>
			            <tr><td>&nbsp;&nbsp;</td></tr>
			            <tr><td>&nbsp;&nbsp;</td></tr>
			            <tr>
				            <td>
					            <div style="text-align:rigth; padding-left:20px;  min-height:73px;" class="span4">
		                			<a href="http://www.prepasi.df.gob.mx/" class="btn">Terminar</a>                                         	
		                		</div>
		                	</td>
	                	</tr>
			        </table>       	
					</div>					
				<?php } ?>
				
				<!-- <div style="text-align:rigth; padding-left:20px;  min-height:73px;" class="span4">
                	<a href="reimpresion" class="btn">Terminar</a>                                         	
                </div> -->
			</form>
		</div>
	</div>
</div>