   <style>
        
	        .error {
			    background: url("resources/formulario/css/images/ui-bg_glass_95_fef1ec_1x400.png") repeat-x scroll 50% 50% #fef1ec !important;
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
                    <form role="form" id="registra_beneficiario" name="registra_beneficiario" action="registro/guardaBeneficiario" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        <a href="http://www.prepasi.df.gob.mx/">	<img  src="resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;</a>
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
		                    	<td colspan="5" height="41px" align="center" valign="top" style="font-size:24px; font-weight:bold; color:#e6007e;"><?php echo $strNombre." ".$strAp." ".$strAm;?></td>		                        		
		                    </tr>
		                   <tr>
		                   		<td><h1><?php echo $institucion['institucion'];?></h1></td>		                        		
		                   </tr>
		                   <tr>
		                   		<td><h3> NO ESTA EN PERIODO DE INSCRIPCION</h3></td>		                        		
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
		                    	<td colspan="5" height="41px" align="center" valign="top" style="font-size:24px; font-weight:bold; color:#e6007e;"><?php echo $strNombre." ".$strAp." ".$strAm;?></td>		                        		
		                    </tr>
		                   <tr>
		                   		<td>AÚN NO ES PERIODO DE INSCRIPCION</td>		                        		
		                   </tr>
		                </table>        	
					</div>					
					
					<?php }else if (isset($sin_ins) && $sin_ins==3){ 
						 
					?>
					
					<div class="form-goup">
					<br>
						<table width="100%" border="0">		                        	
		                    <tr>		                        			
		                    	<td colspan="5" height="41px" align="center" valign="top" style="font-size:24px; font-weight:bold; color:#e6007e;"><?php echo $strNombre." ".$strAp." ".$strAm;?></td>		                        		
		                    </tr>
		                   <tr>
		                   		<td><?php echo $matricula;?></td>		                        		
		                   </tr>
		                   <tr>
		                   		<td><h3>Tiene  pagos limite como beneficiario Bachillerato.</h3></td>		                        		
		                   </tr>
		                   <tr>
		                   		<td><a href="#">link universitario</a></td>		                        		
		                   </tr>
		                </table>            	
					</div>					
					
					<?php }else if (isset($sin_ins) && $sin_ins==4){ 
						 
					?>
					
					<div class="form-goup">
					<br>
						<table width="100%" border="0">		                        	
		                    <tr>		                        			
		                    	<td colspan="5" height="41px" align="center" valign="top" style="font-size:24px; font-weight:bold; color:#e6007e;"><?php echo $strNombre." ".$strAp." ".$strAm;?></td>		                        		
		                    </tr>
		                   <tr>
		                   		<td><?php echo $matricula;?></td>		                        		
		                   </tr>
		                   <tr>
		                   		<td><h3>Tiene  pagos como universitario.</h3></td>		                        		
		                   </tr>
		                   <tr>
		                   		<td></td>		                        		
		                   </tr>
		                </table>        	
					</div>					
					
					<?php }else if (isset($sin_ins) && $sin_ins==5){ 
						 
					?>
					
					<div class="form-goup">
					<br>
						<table width="100%" border="0">		                        	
		                    <tr>		                        			
		                    	<td colspan="5" height="41px" align="center" valign="top" style="font-size:24px; font-weight:bold; color:#e6007e;"><?php echo $strNombre." ".$strAp." ".$strAm;?></td>		                        		
		                    </tr>
		                   <tr>
			            		<td align="center" class=""><br>LA INSTITUCION NO ES LA MISMA QUE CONTIENE TU REGISTRO. <br><br></td>
			            	</tr>
			            	</table>	
					</div>					
					
					<?php }?>
					
					
					</form>
				</div>
			</div>
		</div>
	