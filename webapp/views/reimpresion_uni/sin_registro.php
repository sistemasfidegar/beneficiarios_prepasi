
         <style>
        
	        .error {
			    background: url("../../../resources/formulario/css/images/ui-bg_glass_95_fef1ec_1x400.png") repeat-x scroll 50% 50% #fef1ec !important;
			    border: 1px solid #cd0a0a !important;
			    color: #cd0a0a;
			}
			        
	       
			hr { 
				  background-color: #C5C5C5;
				  height: 2px; 
				}
        </style>
 
         <div class="register-container container">
            <div class="row">                
                <div class="register">
                    <form role="form" id="registra_beneficiario" name="registra_beneficiario" action="" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        <a href="http://www.prepasi.df.gob.mx/">	<img  src="resources/img/logo_gdf_cgdf.png" style="padding-top:10px;" align="top" />&nbsp;</a>
                        	<!-- <img src="../resources/formulario/img/tit_sistema.png" style="padding-top:10px;" align="top" />  -->                        	
                        </div>
                        <?php
						//print_r($sin_ins);					 
						if (isset($sin_ins) && $sin_ins==1){ 
						 
					?>
					
					<div class="form-goup">
					<br>
						<table width="100%" border="0">		                        	
		                   
		                   <tr>
		                   		<td>NO HAS REALIZADO TRAMITES</td>		                        		
		                   </tr>
		                </table>       	
					</div>					
					<?php
											 
						}else if (isset($sin_ins) && $sin_ins==2){ 
						 
					?>
					
					<div class="form-goup">
					<br>
						<table width="100%" border="0">		                        	
		                    
		                   <tr>
		                   		<td>NO HAY SERVICIO DE REIMPRESIÓN</td>		                        		
		                   </tr>
		                </table>        	
					</div>					
					
					<?php }else if (isset($sin_ins) && $sin_ins==3){ ?>
					<div class="form-goup">
					<br>
						<table width="100%" border="0">		                        	
		                    
		                   <tr>
		                   		<td>LIGA PARA REIMPRESION BACHILLERATO.....</td>		                        		
		                   </tr>
		                </table>        	
					</div>	
					<?php }?>
					<div style="text-align:rigth; padding-left:20px;  min-height:73px;" class="span4">
                	<a href="reimpresion_uni" class="btn">Terminar</a>                                         	
                	</div>
					
					</form>
				</div>
			</div>
		</div>
	