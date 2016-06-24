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
		        },
		        messages: {
		        	tarjeta1: {required: "Campo obligatorio"},
		        	tarjeta2: {required: "Campo obligatorio", tarjetaigual: "La tarjeta no coincide"},
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

      $("#activacion").validate(rules_form);

      $("#guardar").click(function (){ 
  				if($('#activacion').valid()) {
  					$.blockUI({message: 'Procesando por favor espere...'});
  				    $.ajax({
  				    	type: 'POST',
  				        url: $('#activacion').attr("action"),
  				        data: $('#activacion').serialize(),
  				        success: function (data) {
  				            if(data == 'ok') {
  				            	$.unblockUI();
  				             	swal({
  				             		title: 'Listo',
		                          	  text: '¡Tu tarjeta fue activada correctamente!',
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
  				            } else if(data == 'nocoincide') {
  				            	$.unblockUI();
  				            	$('#myModalNoCoincide').modal('show'); //open modal
  				            } else {
  				            	$.unblockUI();
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

	<div class="modal fade" tabindex="-1" role="dialog" id="myModalNoCoincide">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" style="text-align: center;">No se puede realizar la activaci&oacute;n</h4>
				</div>
				<div class="modal-body">
					<form id="attributeFormModalSinRegistro">
						<div class="form-group" style="text-align: justify;">
							Te informamos que la tarjeta no puede ser activada, debido a que presenta una inconsistencia. <br/><br/>
	                   		Acude a Lucas Alam&aacute;n #45, Col. Obrera (cerca del Metro Doctores), 9:00 a 17:00 hrs. para subsanar tu expediente.  
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

<div class="register-container container">
	<div class="row">                
    	<div class="register">
        	<form role="form" class="form-horizontal" id="activacion" name="activacion" action="<?= base_url() ?>activacion/actualizar" method="post" autocomplete="off">
        		<div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                	<img  src="resources/formulario/img/logo_gdf_fidegar.png" class="img-responsive left-block" style="padding-top:10px; vertical-align:top;"/>&nbsp;</a>                        	
                </div>
                <div id="datos_beneficiario" style="text-align:center; padding-top:10px;">
                	<?php if(isset($beneficiario)) { ?>
                	<div style="text-align:center !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px; font-size: 180%;">Bienvenid@</label></div>	
		            <div style="text-align:justify;">
				  		Para activar tu tarjeta sigue los siguientes pasos:<br/>
				  		<ol>
				  			<li>Verifica que los datos mostrados sean correctos, de lo contrario comun&iacute;cate al tel&eacute;fono 1102 1750 de L a V de 9:00 a 18:00 hrs para que puedan asesorarte.</li>
				  			<li>Si tus datos son correctos, ingresa los 16 d&iacute;gitos de tu tarjeta (en los campos de Tarjeta y Confirmar tarjeta).</li><br/>
				  		<!-- <li>Ingresa la vigencia de tu tarjeta (mes y a&ntilde;o) y da click en el bot&oacute;n "Continuar".</li><br/>-->
				  		</ol>
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
      					<input type="hidden" id="archivo" name="archivo" value="<?=  isset($beneficiario['id_archivo']) ? $beneficiario['id_archivo'] : ' ' ?>">
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-offset-1 col-sm-1" style="text-align: left; color:#e6007e;" for="curp">CURP: </label>
      					<label class="control-label col-sm-offset-1 col-sm-9" style="text-align: left;" for="curp"><?=  isset($beneficiario['curp']) ? $beneficiario['curp'] : ' ' ?></label>
  					</div>
  					<div class="form-group">
    					<label class="control-label col-sm-offset-1 col-sm-1" style="text-align: left; color:#e6007e;" for="tarjeta1">Tarjeta: </label>
      					<div class="col-sm-4">
      						<input class="form-control" id="tarjeta1" name="tarjeta1" maxlength="16" type="text" placeholder="Introduzca su n&uacute;mero de tarjeta" autofocus/>
    					</div>
      					<label class="control-label col-sm-2" style="color:#e6007e;" for="tarjeta2">Confirmar tarjeta: </label>
      					<div class="col-sm-4">
      						<input class="form-control" id="tarjeta2" name="tarjeta2" maxlength="16" type="text" placeholder="Confirme su n&uacute;mero de tarjeta"/>
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