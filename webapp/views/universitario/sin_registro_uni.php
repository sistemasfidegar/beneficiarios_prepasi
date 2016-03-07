
        
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
					<table bgcolor="" width="620" border="0" align="center" cellpadding="0" cellspacing="0">
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>
						<tr>
							<td align="center" class="enrojo12n" height="6">LA CURP: <?php echo $strCurp;?> NO SE ENCUENTRA REGISTRADA</td>
						</tr>
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>            
					</table>'  	
					</div>					
					<?php
											 
						}else if (isset($sin_ins) && $sin_ins==2){ 
						 
					?>
					
					<div class="form-goup">
					<br>
					<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
			          <tr>
			            <td bgcolor=""><br />
			              <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
			               
			                <tr>
			                  <td align="center" class="" style="color:#E3197F; font-size:21px;"><em><br />
			                    EL PERIODO DE INSCRIPCI&Oacute;N ES:<br />
								<br /> DEL <?php echo fecha_con_letra($fecha['inicio']).'    al    '.fecha_con_letra($fecha['fin']); ?>
			                  <br />
			                  </em></td>
			                </tr>
			                <tr>
			                  <td align="center" class="enverde10n" >
			                  	 
				                  <a href="http://www.prepasi.df.gob.mx/Inscripciones/Convocatoria_2015_2016.pdf" class="enverde10n" style="color:#000000; font-size:30px;" target="_blank"><br />
				                  <br />
				                  <b>C O N V O C A T O R &Iacute; A</a><br />
				                  <br />
				                  
			                  </td>
			                </tr>
			                <tr>
			                  <td align="center" class="enverde10n">&nbsp;</td>
			                </tr>
			                <tr></tr>
			              </table>
			            <br /></td>
			          </tr>
			        </table>        	
					</div>					
					
					<?php }else if (isset($sin_ins) && $sin_ins==3){ 
						 
					?>
					
					<div class="form-goup">
					<br>
						
					<table bgcolor="#FFFFFF" width="620" border="0" align="center" cellpadding="0" cellspacing="0">
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>
						<tr>
							<td align="center" class="enrojo12n" height="6">LA CURP: <?php $strCurp; ?> NO SE ENCUENTRA REGISTRADA</td>
						</tr>
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>            
					</table>	
					</div>					
					
					<?php }else if (isset($sin_ins) && $sin_ins==4){ 
						 
					?>
					
					<div class="form-goup">
					<br>
					<table bgcolor="#FFFFFF" width="620" border="0" align="center" cellpadding="0" cellspacing="0">
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>
						<tr>
							<td align="center" class="enrojo12n" height="6">LA MATRICULA: <?php echo $matricula_ben;?> <br>
							NO TIENE ASIGNADA NINGUNA TARJETA</td>
						</tr>
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>            
					</table>
							
					</div>					
					
					<?php }else if (isset($sin_ins) && $sin_ins==5){ 
						 
					?>
					
					<div class="form-goup">
					<br>
					<table bgcolor="#FFFFFF" width="620" border="0" align="center" cellpadding="0" cellspacing="0">
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>
						<tr>
							<td align="center" class="enrojo12n" height="6">YA NO PUEDES SER PARTE DEL PROGRAMA UNIVERSITARIOS SI</td>
						</tr>
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>            
					</table>	
					</div>					
					
				
					<?php }else if (isset($sin_ins) && $sin_ins==6){ 
						 
					?>
					
					<div class="form-goup">
					<br>
					<table bgcolor="#FFFFFF" width="620" border="0" align="center" cellpadding="0" cellspacing="0">
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>
						<tr>
							<td align="center" class="enrojo12n" height="6">BENEFICIARIO INSCRITO.... IMPRESION DOCUMENTOS</td>
						</tr>
				    	<tr>
			    	    	<td>&nbsp;</td>	
				        </tr>            
					</table>	
					</div>					
					
					<?php }?>
					
					</form>
				</div>
			</div>
		</div>
	