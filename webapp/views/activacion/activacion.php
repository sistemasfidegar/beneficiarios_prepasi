<script type="text/javascript">
      function muestraAviso() {        	        			        	 
          bootbox.dialog({
              title: '<span style=" font-weight:bold; font-size:29px; ">Aviso de Privacidad</span>',
    		  message: $("#aviso").html(),
    		  buttons: {
        		  success: {
    			  	label: "Cerrar",
    			 	className: "btn-info",
    			 	callback: function () {
        			 	}
			 		}
			 	}
    	     });    			                     
        }

      $('*').bind("cut copy paste",function(e) {
          e.preventDefault();
          });

      $(document).ready(function() {
      	var rules_form = {
		        rules: {
		        	tarjeta1: {required : true, minlength: 16},
		        	tarjeta2: {required: true, tarjetaigual: true, minlength: 16},
		        	mes: {required : true, checkmonthandyear: true},
		        	anio: {required : true, checkyear: true, checkyearandmonth: true},
		        },
		        messages: {
		        	tarjeta1: {required: "Campo obligatorio"},
		        	tarjeta2: {required: "Campo obligatorio", tarjetaigual: "La tarjeta no coincide"},
		        	mes: {required: "Campo obligatorio", checkmonthandyear: "El mes no está¡ vigente"},
		        	anio: {required: "Campo obligatorio", checkyear: "El año no está vigente", checkyearandmonth: "El año no está vigente"},		        
		        },
		        ignore: ":not(:visible)",
		        showErrors: function (map, list) {
		            // there's probably a way to simplify this
		            var focussed = document.activeElement;
		            
		            if (focussed && $(focussed).is("input, textarea")) {
		                $(this.currentForm).tooltip("close", {
		                    currentTarget: focussed
		                }, true);
		            }
		            //this.currentElements.removeAttr("title").removeClass("ui-state-error1");
		            this.currentElements.css(  {"border-style":"solid","border-color":"#A4A4A4","border-width":"1px"});
		            
		            $.each(list, function (index, error) {
		            	 //$(error.element).css( "border-color", "red","border-style:dashed" );
		            	 //$(error.element).attr("title", error.message).addClass("ui-state-error1");
		                $(error.element).attr("title", error.message).css( {"border-style":"dashed","border-color":"red", "border-width":"2px"} );
		            });
		            
		            if (focussed && $(focussed).is("input, textarea")) {
		                $(this.currentForm).tooltip("open", {
		                    target: focussed
		                });
		            }
		        }
		    };

      jQuery.validator.addMethod("tarjetaigual", function (value, element) {
  				var tarjeta1 = $('#tarjeta1').val().toString();
  				if (element.value != tarjeta1)
  					return false;
  				 else 
  				    return true;
  				}, "La tarjeta no coincide");
		
      jQuery.validator.addMethod("checkyear", function (value, element) {
			var $fecha = new Date();
			var $year = $fecha.getFullYear();
			var $month = $fecha.getMonth();
			
			if (element.value < ($year - 2000))
				return false;
			 else 
			    return true;
			}, "El año no está vigente");

      jQuery.validator.addMethod("checkyearandmonth", function (value, element) {
    	  var $mes = parseInt($('#mes').val());
    	  var $fecha = new Date();
		  var $year = $fecha.getFullYear();
		  var $month = $fecha.getMonth();
			
			if ((element.value <= ($year - 2000))&& ($mes < ($month + 1)))
				return false;
			 else 
			    return true;
			}, "El año no está vigente");
		
      jQuery.validator.addMethod("checkmonthandyear", function (value, element) {
    	  var $anio = parseInt($('#anio').val());
    	  var $fecha = new Date();
		  var $year = $fecha.getFullYear();
		  var $month = $fecha.getMonth();
			
			if ((element.value < ($month + 1)) && ($anio < ($year - 2000)))
				return false;
			 else 
			    return true;
			}, "El mes no está vigente");
		
      /*$('#anio').change(function() {
    	  var $anio = parseInt($(this).val());
    	  var $mes = parseInt($('#mes').val());
    	  var $fecha = new Date();
		  var $year = $fecha.getFullYear();
		  var $month = $fecha.getMonth();
		  
		  if (($mes < ($month + 1)) && ($anio >= ($year - 2000))){
				$('#mes').attr("title", "El mes no está vigente").css( {"border-style":"dashed","border-color":"red", "border-width":"2px"} );;
		  }  	     
  	});*/

      $("#activacion").validate(rules_form);

      $("#guardar").click(function (){ 
  				if($('#activacion').valid()) {
  					$.blockUI({message: 'Procesando por favor espere...'});
  				    $.ajax({
  				    	type: 'POST',
  				        url: $('#activacion').attr("action"),
  				        data: $('#activacion').serialize(),
  				        success: function (data) {
  	  				        alert(data);
  	  				    	$.unblockUI();
  				            if(data == 'ok') {
  				             	swal({
  				             		title: 'Listo',
		                          	  text: 'Â¡Registro exitoso!',
		                          	  type: "success",
		                          	  showCancelButton: false,
		                          	  confirmButtonColor: '#34AF00',
		                          	  confirmButtonText: 'Ok',
		                          	  closeOnConfirm: true,
		                          	  closeOnCancel: true
  				                },
  				                function(isConfirm){
  				                	if (isConfirm) {
  				                    	irA('activacion');
  				                    } 
  				                });
  				            } else {
  					            swal({
  					            	title: 'Error',
		                         	  text: 'Ocurri\xf3 un error, int\xe9ntelo m\xe1s tarde!!!',
		                         	  type: 'error',
		                         	  showCancelButton: false,
		                         	  confirmButtonColor: '#C9302C',
		                         	  confirmButtonText: 'Ok',
		                         	  closeOnConfirm: true,   
		                         	  closeOnCancel: true
  				                });
  				            }
  				        }
  				     });
  			     }
  			 });
  		 
  		 $("#tarjeta1").numeric(); 
  		 $("#tarjeta2").numeric();
      }); //fin ready
  		 
  		function irA(uri) {
	        window.location.href = '<?= base_url(); ?>' + uri;  
	    }  
</script>

<div class="register-container container">
	<div class="row">                
    	<div class="register">
        	<form role="form" class="form-horizontal" id="activacion" name="activacion" action="<?= base_url() ?>activacion/actualizar" method="post" autocomplete="off">
        		<div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                	<img src="resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;                        	
                </div>
                <div id="datos_beneficiario" style="text-align:center; padding-top:10px;">
                	<?php if(isset($beneficiario)) { ?>
                	<div style="text-align:center !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Bienvenid@</label></div>	
		            <div style="text-align:justify;">
				  		Para activar tu tarjeta sigue los siguientes pasos:<br/>
				  		1. Verifica que los datos mostrados sean correctos, de lo contrario comun&iacute;cate al tel&eacute;fono 1102 1750 de L a V de 9:00 a 18:00 hrs para que puedan asesorarte.<br />
				  		2. Si tus datos son correctos, ingresa los 16 d&iacute;gitos de tu tarjeta (en los campos de Tarjeta y Confirmar tarjeta).<br/>
				  		3. Ingresa la vigencia de tu tarjeta (mes y a&ntilde;o) y da click en el bot&oacute;n "Continuar".<br/><br/>
				  	</div>
		            <div class="form-group">
    					<label class="control-label col-sm-offset-1 col-sm-1" style="text-align: left; color:#e6007e;" for="beneficiario">Beneficiari@: </label>
      					<label class="control-label col-sm-offset-1 col-sm-9" style="text-align: left;" for="beneficiario"><?=  (isset($beneficiario['nombre']) ? $beneficiario['nombre'] : ' ') . ' ' .  (isset($beneficiario['ap']) ?  $beneficiario['ap'] : ' ') . ' ' . (isset($beneficiario['am']) ? $beneficiario['am'] : ' ') ?></label>
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-offset-1 col-sm-1" style="text-align: left; color:#e6007e;" for="institucion">Instituci&oacute;n: </label>
      					<label class="control-label col-sm-offset-1 col-sm-9" style="text-align: left;" for="institucion"><?=  isset($beneficiario['institucion']) ? $beneficiario['institucion'] : ' ' ?></label>
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-offset-1 col-sm-1" style="text-align: left; color:#e6007e;" for="plantel">Plantel: </label>
      					<label class="control-label col-sm-offset-1 col-sm-9" style="text-align: left;" for="plantel"><?=  isset($beneficiario['plantel']) ? $beneficiario['plantel'] : ' ' ?></label>
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-offset-1 col-sm-1" style="text-align: left; color:#e6007e;" for="matricula">Matr&iacute;cula: </label>
      					<label class="control-label col-sm-offset-1 col-sm-9" style="text-align: left;" for="matricula"><?=  isset($beneficiario['matricula_asignada']) ? $beneficiario['matricula_asignada'] : ' ' ?></label>
      					<input type="hidden" id="matricula" name="matricula" value="<?=  isset($beneficiario['matricula_asignada']) ? $beneficiario['matricula_asignada'] : ' ' ?>">
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-offset-1 col-sm-1" style="text-align: left; color:#e6007e;" for="curp">CURP: </label>
      					<label class="control-label col-sm-offset-1 col-sm-9" style="text-align: left;" for="curp"><?=  isset($beneficiario['curp']) ? $beneficiario['curp'] : ' ' ?></label>
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-offset-1 col-sm-1" style="text-align: left; color:#e6007e;" for="tarjeta1">Tarjeta: </label>
      					<div class="col-sm-4">
      						<input class="form-control" id="tarjeta1" name="tarjeta1" maxlength="16" type="text" placeholder="Introduzca su n&uacute;mero de tarjeta"/>
    					</div>
      					<label class="control-label col-sm-2" style="color:#e6007e;" for="tarjeta2">Confirmar tarjeta: </label>
      					<div class="col-sm-4">
      						<input class="form-control" id="tarjeta2" name="tarjeta2" maxlength="16" type="text" placeholder="Confirme su n&uacute;mero de tarjeta"/>
    					</div>
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-offset-3 col-sm-1" style="text-align: left; color:#e6007e;" for="vigencia">Vigencia: </label>
    					<div class="col-sm-2">
      						<select class="form-control" id="mes" name="mes">
  								<option value="-1">MM</option>
  								<option value="1">01</option>
							    <option value="2">02</option>
							    <option value="3">03</option>
							    <option value="4">04</option>
							    <option value="5">05</option>
							    <option value="6">06</option>
							    <option value="7">07</option>
							    <option value="8">08</option>
							    <option value="9">09</option>
							    <option value="10">10</option>
							    <option value="11">11</option>
							    <option value="12">12</option>
							</select>
      					</div>
      					<div class="col-sm-2">
      						<select class="form-control" id="anio" name="anio">
							    <option value="-1">AA</option>
							    <option value="10">10</option>
							    <option value="11">11</option>
							    <option value="12">12</option>
							    <option value="13">13</option>
							    <option value="14">14</option>
							    <option value="15">15</option> 
							    <option value="16">16</option>
							    <option value="17">17</option>
							    <option value="18">18</option>
							    <option value="19">19</option>
							    <option value="20">20</option>
							    <option value="21">21</option>
							</select>
      					</div>
  					</div>
  					<div style="text-align:right; color:#E60380 !important; cursor:pointer; width:96%;"> 
			        	<i><a href="javascript:muestraAviso();">Consultar nuestro aviso de privacidad</a></i>
		            </div>
		            <div class="form-group"> 
    					<div class="col-sm-offset-5 col-sm-2">
							<button id="guardar" type="button" value="Continuar" class="btn btn-primary">Continuar</button>
    					</div>
  					</div>
		            <?php } else { ?>
					<?php } ?>
                </div>
            </form>
        </div>
    </div>
</div>

 <div id="aviso" style="display:none;">        	
			
			<div  style="text-align:justify; font-family:verdana; width:100%; font-size:12px; height:100%;">
			Los datos personales recabados serán protegidos, incorporados y tratados en el Sistema de Datos 
			
			Personales denominado "Sistema de datos personales del programa Prepa Sí", el cual tiene su 
			
			fundamento en la Clausula quinta del Contrato del Fideicomiso Educación Garantizada No. 2152-6 
			
			del 21 de junio de 2007, Clausula segunda del Primer Convenio Modificatorio al Contrato de 
			
			Fideicomiso aprobado el 21 de diciembre de 2007 y funciones 1, 2, 3 y 4 vinculadas al objetivo 2 de 
			
			la Coordinación Ejecutiva del PREBU contempladas en el Manual Administrativo del Fideicomiso 
			
			Educación Garantizada del Distrito Federal, cuya finalidad es verificar que se cumplan con los 
			
			requisitos establecidos en las Reglas de Operación del programa vigentes y de esta manera 
			
			integrar la base de datos de los beneficiarios del Programa de Estímulos para el Bachillerato 
			
			Universal, Prepa Sí, para otorgarles el estímulo económico y podrán ser transmitidos a Banco 
			
			Mercantil del Norte, S.A. Institución de Banca Múltiple, Grupo Financiero Banorte para otorgar el 
			
			estímulo económico, a órganos de control para la realización de auditorías o desarrollo de 
			
			investigaciones por presuntas faltas administrativas, a la Auditoría Superior de la Ciudad de 
			
			México para el ejercicio de sus funciones de fiscalización, a los órganos jurisdiccionales para la 
			
			sustanciación de los procesos jurisdiccionales tramitados ante ellos, a la Comisión de Derechos 
			
			Humanos del Distrito Federal para la investigación de presuntas violaciones a los derechos 
			
			humanos, al Instituto de Acceso a la Información Pública y Protección de Datos Personales del 
			
			Distrito Federal para la sustanciación del recurso de revisión y el Consejo de Evaluación del 
			
			Desarrollo Social para la evaluación de programas sociales, además de otras transmisiones 
			
			previstas en la Ley de Protección de Datos Personales para el Distrito Federal.<br /><br />
						
			Los datos marcados con un asterisco (*) son obligatorios y sin ellos no podrá acceder al servicio o 
			
			completar el trámite de inscripción o reinscripción al programa "Prepa Sí".<br /><br />
			
			Asimismo, se le informa que sus datos no podrán ser difundidos sin su consentimiento expreso,
			salvo las excepciones previstas en la Ley.<br /><br />
			
			El responsable del Sistema de Datos Personales es el Lic. Alfredo Domínguez Marrufo, Coordinador 
			
			Ejecutivo del PREBU y la dirección donde podrá ejercer los derechos de acceso, rectificación, 
			
			cancelación y oposición, así como la revocación del consentimiento es en la Oficina de Información 
			
			Pública del Fideicomiso Educación Garantizada del Distrito Federal, ubicada en Ejército Nacional 
			
			359, 3er piso, Col. Granada en la Delegación Miguel Hidalgo, C.P. 11520. Tel. 11021730 ext. 4120.<br /><br />
			
			El interesado podrá dirigirse al instituto de Acceso a la Información Pública y Protección de Datos Personales del Distrito Federal, 
			donde recibirá asesoría sobre los derechos que tutela la Ley de Protección de Datos Personales para el Distrito Federal al teléfono: 5636-4636; 
			correo electrónico: <a href="mailto:datos.personales@infodf.org.mx">datos.personales@infodf.org.mx</a> o <a href="http://www.infodf.org.mx" target="_blank">www.infodf.org.mx</a>
			</div>
        </div>