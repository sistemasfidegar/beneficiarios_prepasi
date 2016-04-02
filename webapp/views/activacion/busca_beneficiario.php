        <script type="text/javascript">
        jQuery(document).ready(function(){
    		$("#guardar").click(function () {
    			if($("#matricula_asignada").val() != "") { 
    				$.blockUI({message: 'Procesando por favor espere...'});
    	        	jQuery.ajax({
    		            type: 'POST',
    		            url: 'activacion/getBeneficiario',
    		            data: {matricula: $("#matricula_asignada").val()},
    		            success: function (data) {
        		            if(data == 'sinregistro') {
        		            	$.unblockUI();
        		            	$('#myModalSinRegistro').modal('show'); //open modal                 
        		            } else if(data == 'ok'){
        		            	irA('activacion/buscaBeneficiario/'+$("#matricula_asignada").val());
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
    		            url: 'activacion/getBeneficiarioUnam',
    		            data: {matricula_escuela: $("#matricula_escuela").val()},
    		            success: function (data) {
        		            if(data != "bad") {
	    		            	irA('activacion/buscaBeneficiario/'+data);	               
        		            } else {
            		            alert('No se encontr\xf3 al beneficiario');
            		            irA('activacion');
            		        }
    		            }   
    		        });
    			}
    		});

        });//ready
        function irA(uri) {
        	window.location.href = '<?= base_url(); ?>' + uri;
        }	
        </script>
        
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalRechazo">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" align="center">Expediente con inconsistencias</h4>
				</div>
				<div class="modal-body">
					<form id="attributeForm" role="form">
						<div class="form-group">
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
				<div class="modal-footer">
					<center>
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
					</center>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalRevision">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" align="center">Expediente en revisi&oacute;n</h4>
				</div>
				<div class="modal-body">
					<form id="attributeForm" role="form">
						<div class="form-group">
							A&uacute;n no es posible que realices la activaci&oacute;n de la tarjeta, debido a que tu expediente se encuentra en proceso de revisi&oacute;n. <br />
							Recuerda que debes intentarlo 2 semanas despu&eacute;s de haber conclu&iacute;do la recepci&oacute;n de documentos en tu plantel.<br />	
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<center>
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
					</center>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade" tabindex="-1" role="dialog" id="myModalSinRegistro">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" align="center">Beneficiario Inexistente</h4>
				</div>
				<div class="modal-body">
					<form id="attributeForm" role="form">
						<div class="form-group">
							Recuerda que la activaci&oacute;n de tarjeta &uacute;nicamente la puedes llevar a cabo si realizaste tu registro electr&oacute;nico para el ciclo 2016-2017, si entregaste tus documentos y
	                        si estos fueron aceptados. <br /><br />
	                        
	                        1. Verifica que el dato que proporcionaste para ingresar al sistema es correcto (CURP, PS o No. de cuenta), ya que puede ser un error al teclear.<br /><br />
	                        
	                        Si los datos proporcionados son correctos, comun&iacute;cate al tel&eacute;fono 1102 1750 (L a V de 9 a 18 hrs) para que puedan brindarte mayor informaci&oacute;n.<br /><br />  
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<center>
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
					</center>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" tabindex="-1" role="dialog" id="myModalActiva">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" align="center">Tarjeta Activa</h4>
				</div>
				<div class="modal-body">
					<form id="attributeForm" role="form">
						<div class="form-group">
							Beneficiario con tarjeta activa<br /><br />Ya no es necesario volver a activar
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<center>
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
					</center>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
     
         <div class="-container container">
            <div class="row">                
                <div class="register">
                    <form role="form" id="registra_beneficiario" name="registra_beneficiario" action="activacion/buscaBeneficiario" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        <a href="http://www.prepasi.df.gob.mx/">	<img  src="resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;</a>                       	
                        </div>
                        <br>
                        <div style="text-align:CENTER !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;"> ACTIVACI&Oacute;N DE TARJETAS </label></div>	
					    
					    <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
							 <tr>
							   <td bgcolor="">
							    
							      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
							       
							        <tr>
							          <td colspan="2" align="center" class="">Elige un m&eacute;todo de b&uacute;squeda:</td>
							          </tr>      
							        
							       
							        <tr>
							          <td colspan="2">&nbsp;</td>
							        </tr>
							        <tr>
							          
							          <td colspan="2"><input type="text" id="matricula_asignada" name="matricula_asignada" value="" placeholder="                 Ingresa tu matr&iacute;cula PS o CURP" style="width:80%; text-transform:uppercase;"/></td>
							        </tr>
							         <tr>
							          <td colspan="2">&nbsp;</td>
							        </tr>
							        <tr>
							          
							          <td colspan="2"><input type="text" id="matricula_escuela" name="matricula_escuela" value="" placeholder="                    Ingresa matr&iacute;cula (unam)" style="width:80%; text-transform:uppercase;"/></td>
							        </tr>
							        <tr>
							          
							          <td colspan ="2""center">
							          <div class="box-footer" style="text-align: center;" >
						     				<button style="width:50%;" id="guardar" name="guardar" type="button" class="btn">Consultar</button>
						     		   </div>
							          </td>
							        </tr>
							        <tr>
							          <td>&nbsp;</td>
							          <td>&nbsp;</td>
							        </tr>
							        <tr>
							        	<td>&nbsp;</td>
									  	<td><div style="display:inline-block;" id="results"></div></td>
									    <td>&nbsp;</td>
							        </tr>
							      </table>
							   
							    </td>
							  </tr>
							</table>  
					
					
					</form>
				</div>
			</div>
		</div>
	