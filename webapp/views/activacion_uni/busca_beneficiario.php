 <?php 
       $user_agent = $_SERVER['HTTP_USER_AGENT'];
       
       function getBrowser($user_agent){
       	if(strpos($user_agent, 'MSIE') !== FALSE)
       	return 'IE';
       	elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
       	return 'IE';
       	elseif(strpos($user_agent, 'Firefox') !== FALSE)
       	return 'Mozilla Firefox';
       	elseif(strpos($user_agent, 'Edge') !== FALSE)
       	return 'IE';
       	elseif(strpos($user_agent, 'Chrome') !== FALSE)
       	return 'Google Chrome';
       	elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
       	return "Opera Mini";
       	elseif(strpos($user_agent, 'Opera') !== FALSE)
       	return "Opera";
       	elseif(strpos($user_agent, 'Safari') !== FALSE)
       	return "Safari";
       	else
       		return 'OTROr';
              
       }
       
       $navegador =  getBrowser($user_agent);
       ?>

        <script type="text/javascript">
        jQuery(document).ready(function(){
    		$("#guardar").click(function () {
    			if($("#matricula_asignada").val() != "") { 
    				$.blockUI({message: 'Procesando por favor espere...'});
    	        	jQuery.ajax({
    		            type: 'POST',
    		            url: 'activacion_uni/getBeneficiario/',
    		            data: {matricula: $("#matricula_asignada").val()},
    		            success: function (data) {
        		            if(data == 'sinregistro') {
        		            	$.unblockUI();
        		            	$('#myModalSinRegistro').modal('show'); //open modal  
        		            	$("#matricula_asignada").val('');               
        		            } else if(data == 'ok'){
        		            	irA('activacion_uni/buscaBeneficiario/'+$("#matricula_asignada").val());
            		        } else if(data == 'revision'){
            		        	$.unblockUI();
								$('#myModalRevision').modal('show'); //open modal  
								$("#matricula_asignada").val('');	
            		        } else if(data == 'activa'){
            		        	$.unblockUI();
								$('#myModalActiva').modal('show'); //open modal  
								$("#matricula_asignada").val('');
            		        } else {
            		        	$.unblockUI();
								$('#myModalRechazo').modal('show'); //open modal  
								$('#motivo').html('Motivo: '+ data);
                		        $("#matricula_asignada").val('');
                		    }
    		            }     
    		        });
    	        } else if($("#matricula_escuela").val() != ""){
    				$.blockUI({message: 'Procesando por favor espere...'});
    	        	jQuery.ajax({
    		            type: 'post',
    		            dataType: 'html',
    		            url: 'activacion_uni/getBeneficiarioUnam/',
    		            data: {matricula_escuela: $("#matricula_escuela").val()},
    		            success: function (data) {
    		            	if(data == 'sinregistro') {
        		            	$.unblockUI();
        		            	$('#myModalSinRegistro').modal('show'); //open modal  
        		            	$("#matricula_escuela").val('');               
        		            } else if(data == 'ok'){
        		            	irA('activacion_uni/buscaBeneficiarioUnam/'+$("#matricula_escuela").val());
            		        } else if(data == 'revision'){
            		        	$.unblockUI();
								$('#myModalRevision').modal('show'); //open modal  
								$("#matricula_escuela").val('');	
            		        } else if(data == 'activa'){
            		        	$.unblockUI();
								$('#myModalActiva').modal('show'); //open modal  
								$("#matricula_escuela").val('');
            		        } else {
            		        	$.unblockUI();
								$('#myModalRechazo').modal('show'); //open modal  
								$('#motivo').html('Motivo: '+ data);
                		        $("#matricula_escuela").val('');
                		    }
    		            }   
    		        });
    			}
    		});

        });//ready
        function irA(uri) {
        	window.location.href = '<?= base_url() ?>' + uri;
        }	
        </script>
        
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalRechazo">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" style="text-align: center;">Expediente con inconsistencias</h4>
				</div>
				<div class="modal-body">
					<form id="attributeForm" role="form">
						<div class="form-group" style="text-align: justify;">
							<label for="motivo" class="control-label"><div id="motivo"></div></label><br/><br/>
							Te informamos que <strong>no podr&aacute;s realizar la activaci&oacute;n</strong> de tu tarjeta en tanto no <strong>regularices</strong> la 
							situaci&oacute;n que presenta el expediente que entregaste.<br /><br/>
							
							Para dar seguimiento a tu tr&aacute;mite, es indispensable que <strong>te presentes en las oficinas del 
							Programa</strong>, ubicadas en Lucas Alam&aacute;n #45 en la colonia Obrera, Delegaci&oacute;n Cuauht&eacute;moc 
							(Metro Doctores), de lunes a viernes de 9:00 a 17:00 hrs.<br/><br/>
							
							Te recomendamos que <strong>revises cu&aacute;les son los documentos aceptados y sus 
							caracter&iacute;sticas</strong> en el apartado V. Requisitos y Procedimientos de Acceso a las Reglas de 
							Operaci&oacute;n del Programa o en la Convocatoria 2016-2017, ambas publicadas en 
							www.prepasi.df.gob.mx y que <strong>acudas con toda la documentaci&oacute;n que entregaste</strong>, ya que tu
							expediente puede presentar varias inconsistencias adem&aacute;s de la se&ntilde;alada, esto con la finalidad
							de evitar que acudas en varias ocasiones.<br /><br />
							
							<strong>IMPORTANTE:</strong> Los(as) alumnos(as) recursadores(as), o que cumplieron el m&aacute;ximo n&uacute;mero de
							dep&oacute;sitos, o que no aprop&oacute; el 50% de materias <strong>no podr&aacute;n realizar la activaci&oacute;n</strong> de su tarjeta,
							ya que <strong>no cumplen con los requisitos establecidos</strong> en las Reglas de Operaci&oacute;n del Programa vigente,
							por lo que <strong>no podr&aacute;n formar parte del programa</strong> para el ciclo escolar 2016-2017.<br /><br />	
						</div>
					</form>
				</div>
				<div class="modal-footer" style="text-align: center;">
						Para mayor informaci&oacute;n visita:<br/>
						<a href="http://www.prepasi.df.gob.mx" target="_blank">www.prepasi.df.gob.mx</a><br/>
						<a href="https://www.facebook.com/pprepasi" target="_blank">
							<span class="fa-stack fa-lg">
                            	<i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a href="https://www.twitter.com/P_Prepa_Si" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                        <a href="https://www.instagram.com/actividadesps/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                        </a><br/>
						Atenci&oacute;n telef&oacute;nica Prepa S&iacute; 1102 1750 (L a V de 9 a 18 hrs)
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalRevision">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" style="text-align: center;">Expediente en revisi&oacute;n</h4>
				</div>
				<div class="modal-body">
					<form id="attributeForm" role="form">
						<div class="form-group" style="text-align: justify;">
							A&uacute;n no es posible que realices la activaci&oacute;n de la tarjeta, debido a que tu expediente se encuentra en proceso de revisi&oacute;n. <br /><br/>
							Recuerda que debes intentarlo 2 semanas despu&eacute;s de haber conclu&iacute;do la recepci&oacute;n de documentos en tu plantel.<br />	
						</div>
					</form>
				</div>
				<div class="modal-footer" style="text-align: center;">
						Para mayor informaci&oacute;n visita:<br/>
						<a href="http://www.prepasi.df.gob.mx" target="_blank">www.prepasi.df.gob.mx</a><br/>
						<a href="https://www.facebook.com/pprepasi" target="_blank">
							<span class="fa-stack fa-lg">
                            	<i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a href="https://www.twitter.com/P_Prepa_Si" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                        <a href="https://www.instagram.com/actividadesps/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                        </a><br/>
						Atenci&oacute;n telef&oacute;nica Prepa S&iacute; 1102 1750 (L a V de 9 a 18 hrs)
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalSinRegistro">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" style="text-align: center;">Beneficiario Inexistente</h4>
				</div>
				<div class="modal-body">
					<form id="attributeForm" role="form">
						<div class="form-group" style="text-align: justify;">
							Recuerda que la activaci&oacute;n de tarjeta &uacute;nicamente la puedes llevar a cabo si realizaste tu registro electr&oacute;nico para el ciclo 2016-2017, si entregaste tus documentos y
	                        si estos fueron aceptados. <br /><br />
	                        
	                        1. Verifica que el dato que proporcionaste para ingresar al sistema es correcto (CURP, PS o No. de cuenta), ya que puede ser un error al teclear.<br /><br />
	                        
	                        Si los datos proporcionados son correctos, comun&iacute;cate al tel&eacute;fono 1102 1750 (L a V de 9 a 18 hrs) para que puedan brindarte mayor informaci&oacute;n.<br /><br />  
						</div>
					</form>
				</div>
				<div class="modal-footer" style="text-align: center;">
						Para mayor informaci&oacute;n visita:<br/>
						<a href="http://www.prepasi.df.gob.mx" target="_blank">www.prepasi.df.gob.mx</a><br/>
						<a href="https://www.facebook.com/pprepasi" target="_blank">
							<span class="fa-stack fa-lg">
                            	<i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a href="https://www.twitter.com/P_Prepa_Si" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                        <a href="https://www.instagram.com/actividadesps/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                        </a><br/>
						Atenci&oacute;n telef&oacute;nica Prepa S&iacute; 1102 1750 (L a V de 9 a 18 hrs)
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" tabindex="-1" role="dialog" id="myModalActiva">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" style="text-align: center;">Tarjeta Activa</h4>
				</div>
				<div class="modal-body">
					<form id="attributeForm" role="form">
						<div class="form-group" style="text-align: justify;">
							Beneficiario con tarjeta activa<br /><br />Ya no es necesario volver a activar
						</div>
					</form>
				</div>
				<div class="modal-footer" style="text-align: center;">
						Para mayor informaci&oacute;n visita:<br/>
						<a href="http://www.prepasi.df.gob.mx" target="_blank">www.prepasi.df.gob.mx</a><br/>
						<a href="https://www.facebook.com/pprepasi" target="_blank">
							<span class="fa-stack fa-lg">
                            	<i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a href="https://www.twitter.com/P_Prepa_Si" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                        <a href="https://www.instagram.com/actividadesps/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                </span>
                        </a><br/>
						Atenci&oacute;n telef&oacute;nica Prepa S&iacute; 1102 1750 (L a V de 9 a 18 hrs)
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
     
         <div class="-container container">
            <div class="row">                
                <div class="register">
                    <form role="form" id="registra_beneficiario" name="registra_beneficiario" action="activacion_uni/buscaBeneficiario" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        <a href="http://www.prepasi.df.gob.mx/"><img  src="resources/formulario/img/logo_gdf_fidegar.png" alt="Logo" class="img-responsive center-block" style="padding-top:10px; vertical-align:top;" />&nbsp;</a>
                                               	
                        </div>
                          <?php	if (isset($disponible)){ 
                 			if($disponible == 1) { ?>
                 			<div class="form-goup">
						<br>
						<table style="width: 100%; border-style: 0;">		                        	
			        	<tr>
			        		<td>NO HAY ACTIVACIONES DE TARJETA UNIVERSITARIOS S&Iacute; EN ESTE MOMENTO</strong></td>		                        		
			            </tr>
			            <tr><td>&nbsp;&nbsp;</td></tr>
			            <tr><td>&nbsp;&nbsp;</td></tr>
			            <tr>
				            <td>
					            <div style="text-align:rigth; padding-left:20px;  min-height:73px;" class="span4">
		                			<a href="http://www.prepasi.df.gob.mx/" class="btn">Salir</a>                                         	
		                		</div>
		                	</td>
	                	</tr>
			        </table>       	
					</div>	
					<?php } ?>				
				<?php } else { ?>
                        <br>
                        <div style="text-align:CENTER !important;"><label class="leyenda" style="color:#E6007E; font-size: 180%;"> ACTIVACI&Oacute;N DE TARJETAS UNIVERSITARIOS S&Iacute;</label></div>	
					    <table  style="width:100%; text-align: center; float: center; border-spacing: 5; <?php if($navegador=='IE'){ echo 'display:none;'; }?>">
							 <tbody>
							  	<tr>
							      	<td colspan="3" style="padding: 0; text-align: center; font-size: 110%;">Elige un m&eacute;todo de b&uacute;squeda:</td>
							    </tr> 
					        	<tr>
					         		<td colspan="3" style="padding: 0;">&nbsp;</td>
						        </tr>
						        <tr style="text-align: center;">
						          	<td colspan="3" style="padding: 0;"><input type="text" id="matricula_asignada" name="matricula_asignada" value="" placeholder="Ingresa tu matr&iacute;cula PS o CURP" style="width:50%; text-transform:uppercase;"/></td>
					        	</tr>
						        <tr>
					            	<td colspan="3" style="padding: 0;">&nbsp;</td>
						        </tr>
						        <tr style="text-align: center;">
						          	<td colspan="3" style="padding: 0;"><input type="text" id="matricula_escuela" name="matricula_escuela" value="" placeholder="Ingresa matr&iacute;cula (unam)" style="width:50%; text-transform:uppercase;"/></td>
						        </tr>
				         	</tbody>
				         	<tfoot>
						        <tr>
					        	  	<td >&nbsp;</td>
					        	  	<td style="width: 100%;">
					     				<button style="width: 30%; float: center;" id="guardar" name="guardar" type="button" class="btn">Consultar</button>
					        	  	</td>
						        </tr>
					        </tfoot>
							      </table>
							   
					<table style="width: 100%; float: center; <?php if($navegador!='IE'){ echo 'display:none;'; } ?>" id="mensaje">
				      		<tbody>
                        		<tr>
                                	<td style="width: 50%; float: center; text-align: center; font-size: 19px;">  
                                		<div style="color: #4C4C4C;">                              	
	                                   		<span>
	                                    		Para evitar contratiempos en el funcionamiento del sistema es necesario utilizarlo con alguno de los siguientes navegadores.<br /><br />
	                                    		<a href="https://download.mozilla.org/?product=firefox-stub&os=win&lang=es-MX" style="color:#E6007E;"><img src="resources/img/firefox.png" style="vertical-align: middle;" alt="Mozilla Firefox" title="Mozilla Firefox"/></a>&nbsp;&nbsp; 
	                                    		<a href="https://www.google.com.mx/chrome/browser/desktop/#" style="color:#E6007E;" target="_blank"><img src="resources/img/chrome.png" style="vertical-align: middle;" alt="Google Chrome" title="Google Chrome"/></a> 
	                                    	</span>
                                    	</div>
                                	</td>	
                            	</tr>
                            </tbody>      
                        </table>
					<?php } ?>
					</form>
				</div>
			</div>
		</div>
	