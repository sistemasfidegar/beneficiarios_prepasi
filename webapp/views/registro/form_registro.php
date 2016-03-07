
         <style>
        
	        .error {
			    background: url("../resources/formulario/css/images/ui-bg_glass_95_fef1ec_1x400.png") repeat-x scroll 50% 50% #fef1ec !important;
			    border: 1px solid #cd0a0a !important;
			    color: #cd0a0a;
			}
			        
	        .leyenda
	        {
	        	font-size:25px !important;
	        	font-weight: bold;        
	        }
        	.ui-tooltip, .arrow:after {
		        background: white;
		        border: 2px solid #cd0a0a;
		    }
		    .ui-tooltip {
		        padding: 5px 20px;
		        color: #cd0a0a;
		        border-radius: 10px;
		        font: bold 12px "Helvetica Neue", Sans-Serif;
		        box-shadow: 0 0 4px #cd0a0a;
		    }
		    .arrow {
		        width: 70px;
		        height: 16px;
		        overflow: hidden;
		        position: absolute;
		        left: 50%;
		        margin-left: -35px;
		        bottom: -16px;
		    }
		    .arrow.top {
		        top: -16px;
		        bottom: auto;
		    }
		    .arrow.left{
		        left: 20%;
		    }
		    .arrow:after {
		        content: "";
		        position: absolute;
		        left: 20px;
		        top: -20px;
		        width: 25px;
		        height: 25px;
		        box-shadow: 6px 5px 9px -9px black;
		        -webkit-transform: rotate(45deg);
		        -ms-transform: rotate(45deg);
		        transform: rotate(45deg);
		    }
		    .arrow.top:after {
		        bottom: -20px;
		        top: auto;
		    }
		    
			hr { 
				  background-color: #C5C5C5;
				  height: 2px; 
				}
        </style>
        
 <script type="text/javascript">
      function muestraAviso()
        {        	        			        	 
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
        
        
     
       $().ready(function() {
			  
		  
		    $('#es_discapacitado').change(function() {
        	      
      	      if ($(this).prop('checked')==true) {
       	        	
      	        	 $("#cmpo_disc").show('slow');
      	        }
      	        else
      	        {
      	        	 $("#cmpo_disc").hide('slow');
      	        }
      	      
      	 	 });


		    $('#es_etnia').change(function() {
      	      
	      	      if ($(this).prop('checked')==true) {
	       	        	
	      	        	 $("#cmpo_etnia").show('slow');
	      	        }
	      	        else
	      	        {
	      	        	 $("#cmpo_etnia").hide('slow');
	      	        }	      	     
	      	});
		    $('.grupo').tooltip({

		    			    
			      position: {
			        my: "right bottom-10",
			        at: "right top",
			        using: function( position, feedback ) {
			          $( this ).css( position );
			          $( "<div>" )
			            .addClass( "arrow" )
			            .addClass( feedback.vertical )
			            .addClass( feedback.horizontal )
			            .appendTo( this );
			        }
			      }
			    });


		   var rules_form = {
			        rules: {
			        	email1: {required : true, estructuraemail: true},
			        	email2: {required: true, emailigual: true},
			        	calle: "required",
			            noext: "required",
			            
			            matricula: "required",
			            materias: "required",
			            telefono:  "required",
			            apellidoMadreP:"required",
			            apellidoMadreM: "required",
			            apellidoPadreM:"required",
			            apellidoPadreP:"required",
			            nombreMadre:"required",
			            nombrePadre:"required",
			        	id_estado_civil: "selectNone",
			        	id_hijos: "selectNone",
			        	id_ocupacion: "selectNone",
			        	id_delegacion: "selectNone",
			        	id_colonia: "selectNone",
			        	
			        	id_residencia: "selectNone",
			        	id_plantel: "selectNone",
			        	id_carrera: "selectNone",
			        	id_ciclo: "selectNone",
			        	id_sistema: "selectNone",
			        	promedio: "selectNone",
						id_grado: "selectNone",
				        id_turno: "selectNone"	
				        		           
			        	
			        },
			        messages: {
			        	email1: {required: "Campo obligatorio", estructuraemail: "Introduce un email valido"},
			        	email2: {required: "Campo obligatorio", emailigual:"El email no coincide"},
			        	calle: {required: "Campo obligatorio"},
			            noext: {required: "Campo obligatorio"},
			            
			            matricula: {required: "Campo obligatorio"},
			            materias: {required: "Campo obligatorio"},
			            telefono:  {required: "Campo obligatorio"}
				        
			        
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
			            this.currentElements.css(  {"border-style":"solid","border-color":"#A4A4A4", "border-width":"1px"});
			            
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

		  
	
		 jQuery.validator.addMethod("selectNone",function (value, element)
		{
						if (element.value == "-1")
							return false;
				        else
				            return true;
				     },"Debe seleccionar una opción"
				 );
		 jQuery.validator.addMethod("emailigual",function (value, element)
					{
							var email2=$('#email1').val().toString();
							if (element.value != email2)
									return false;
					        else 
						            return true;
										     },"El email no coincide"
						);
						
		 jQuery.validator.addMethod("estructuraemail",function (value, element)
			{
			 //console.log(value);
			 var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
				
				if (patron.test(element.value)){
					
						return true;
				}
				else{
						return false;
				}
			},"Introduce un email valido"
			);
			
		 $("#registra_beneficiario").validate(rules_form);

		$("#id_delegacion").change(function () {
			var delegacion = $("#id_delegacion option:selected").val();

	        
	        	$("#id_colonia").html('<option value="0">Cargando...</option>');
	        	jQuery.ajax({
		            type: 'post',
		            dataType: 'html',
		            url: 'registro/ajaxGetColonias/'+delegacion,
		            data: {operacion: 'ajax'},
		            success: function (data) {
		                $("#id_colonia").html(data);	               
		            }
		        });
		        

			
		});
		$("#id_colonia").change(function (){
			//var idCp= document.form_dat.selectCp.value;
			var combo = document.getElementById('id_colonia');

			if(combo.value!='-1')
			{
				var selected = combo.options[combo.selectedIndex].text;
						
				var res = selected.substring(1, 6);
				document.getElementById("id_cp").value=res;
			}
			else
			{
				document.form_dat.id_cp.value="";
			}
			
		});
		 
		 $("#guardar").click(function ()
					{ 
						
				 	 if($('#registra_beneficiario').valid()) 
					     {
					 
							 $.blockUI({message: 'Procesando por favor espere...'});
				             $.ajax({
				                 type: 'POST',
				                 url: $('#registra_beneficiario').attr("action"),
				                 data: $('#registra_beneficiario').serialize(),
				                 success: function (data) {
									//console.log(data);
				                     $.unblockUI();
				                     if(data == 'ok')
				                     {
				                    	 swal({
				                          	  title: "¡Registro exitoso!",
				                          	  text: "",
				                          	  type: "success",
				                          	  showCancelButton: false,
				                          	  confirmButtonColor: "#34AF00",
				                          	  confirmButtonText: "Ok",
				                          	  //cancelButtonText: "No, cancel plx!",
				                          	  closeOnConfirm: false
				                          	  //closeOnCancel: false
				                          	},
				                          	function(isConfirm){
// 				                          	  if (isConfirm) {
// 				                          		irA('index.php/registro/registrado');
// 				                          	  } 
				                          	});
				                     }
				                     else
				                     {
				                    	 swal({
				                         	  title: "Ocurrio un error, intentelo más tarde!!!",
				                         	  text: "",
				                         	  type: "error",
				                         	  showCancelButton: false,
				                         	  confirmButtonColor: "#C9302C",
				                         	  confirmButtonText: "Ok",
				                         	  //cancelButtonText: "No, cancel plx!",
				                         	  closeOnConfirm: false
				                         	  //closeOnCancel: false
				                         	},
				                         	function(isConfirm){
// 				                         	  if (isConfirm) {
// 				                         		 irA('index.php/registro/registrado');
// 				                         	  } 
				                         	});
				                     }
				                 }
				             });
			         }
	         

				     });
	     
		 $("#telefono").numeric();
		 $("#celular").numeric();
		 $("#materias").numeric();
		// $("#").numeric();
				    
		}); //fin ready
		 
		function irA(uri) {
	        window.location.href = '<?php echo base_url(); ?>' + uri;
	        
	    }  
		   
      
	   </script>
		
       <div class="register-container container">
            <div class="row">                
                <div class="register">
                    <form role="form" id="registra_beneficiario" name="registra_beneficiario" action="registro/guardaInscripcion" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        	<img src="resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;
                        	<!-- <img src="../resources/formulario/img/tit_sistema.png" style="padding-top:10px;" align="top" />  -->                        	
                        </div>
                        
                                                	                        	                       
	                    <div id="datos_beneficiario" style="text-align:center; padding-top:10px;">
	                    
		                        <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Datos Personales</label></div>	
		                        <div style="text-align:center !important;">
		                        
		                        <div class="form-group">
								    
		                        	<table width="100%" border="0">		                        	
		                        		<tr>		                        			
		                        			<td colspan="5" height="41px" align="center" valign="top" style="font-size:24px; font-weight:bold; color:#e6007e;">
		                        				<?php echo $strNombre." ".$strAp." ".$strAm;?>
		                        				<input type="hidden" id="nombre" name="nombre" value="<?php echo $strNombre;?>">
		                        				<input type="hidden" id="ap_p" name="ap_p" value="<?php echo $strAp;?>">
		                        				<input type="hidden" id="ap_m" name="ap_m" value="<?php echo $strAm;?>">
		                        				
		                        			</td>		                        		
		                        		</tr>
		                        		
		                        		<tr>
		                        			<td align="center"><label>CURP</label></td>
		                        			
		                        			<td align="center"><label>Fecha de Nacimiento</label></td>
		                        			
		                        			<td align="center"><label>Lugar de Nacimiento</label></td>
		                        			
		                        			<td align="center"><label>Edad</label></td>
		                        			
		                        			<td align="center"><label>Genero</label></td>
		                        			
		                        		</tr>
		                        	
		                        		<tr>		                        			
		                        			<td width="20%" align="center"><?php echo $strCurp;?><input type="hidden" id="curp" name="curp" value="<?php echo $strCurp;?>"></td>
		                        			
		                        			<td width="20%" align="center"> <?php echo $diaNac."/".$mesNac."/".$anioNac;?><input type="hidden" id="fecha_nac" name="fecha_nac" value="<?php echo $diaNac."/".$mesNac."/".$anioNac;?>"></td>
		                        			
		                        			<td width="20%" align="center"><?php echo $strEntidad;?><input type="hidden" id="lugar_nac" name="lugar_nac" value="<?php echo $idEntidad;?>"></td>
		                        			
		                        			<td width="20%" align="center"><?php echo $edad;?><input type="hidden" id="edad" name="edad" value="<?php echo $edad;?>"></td>
		                        			
		                        			<td width="20%" align="center"> <?php echo $strGenero;?><input type="hidden" id="sexo" name="sexo" value="<?php echo $strIdGenero;?>"></td>
		                        			
		                        		</tr>
		                        	</table>
		                        	
		                        			                        	
		                        	<br />
		                        	<table width="100%" border="0">
		                        	<tr>
		                        		<td width="5%"></td>
		                        		<td align="center">
			                        		<table width="100%" border="0">	
				                        		<tr>
				                        			<td width="50%" align="center" valign="top"><label>¿Padeces alguna discapacidad?</label></td>
				                        			
				                        			<td width="" align="left">
				                        				<input type="checkbox" id="es_discapacitado" name="es_discapacitado" data-toggle="toggle" data-on="SI" data-off="NO" data-size="mini" data-onstyle="danger" data-width="80">                       			
				                        			</td>		                        					                        		              					                        					                        		
				                        		</tr>	                        			                        				                        				                        		
				                        	</table>
				                        	
				                        	<div id="cmpo_disc" style="display:none;">
					                        	<br />
					                        	<table width="100%" border="0">	
					                        		<tr>
					                        			<td width="30%" align="center" valign="top" ><label>Discapacidad:</label></td>	
					                        					                        					                        			
					                        			<td width="" align="left">
					                        				<select id="id_discapacidad" name="id_discapacidad" class="form-control" style="width: 50%;">
					                        					<option value="0">SIN DISCAPACIDAD</option>
					                        					<option value="1">AUDITIVA</option>
																<option value="2">MOTRIZ</option>
																<option value="3">INTELECTUAL</option>
																<option value="4">VISUAL</option>
															</select>
					                        			</td>		                        					                        					                        			
					                        		</tr>	                        			                        				                        				                        		
					                        	</table>
				                        	</div>
			                        	</td>
		                        	   <td align="center">
			                        	<table width="100%" border="0">	
			                        		<tr>
			                        			<td width="50%" align="center" valign="top"><label>¿Perteneces a alguna etnia?</label></td>
			                        			
			                        			<td width="" align="left">
			                        				<input type="checkbox" id="es_etnia" name="es_etnia" data-toggle="toggle" data-on="SI" data-off="NO" data-size="mini" data-onstyle="danger" data-width="80">                       			
			                        			</td>		                        					                        		              					                        					                        		
			                        		</tr>	                        			                        				                        				                        		
			                        	</table>
			                        	
			                        	
			                        	<div id="cmpo_etnia" style="display:none;">
				                        	<br />
				                        	<table width="100%" border="0">	
				                        		<tr>
				                        			<td width="23%" align="center" valign="top"><label>Etnia:</label></td>	
				                        					                        					                        			
				                        			<td width="" align="left">
				                        				<select id="id_etnia" name="id_etnia" class="form-control" style="width: 50%;">
				                        					<option value="0">[Seleccionar]</option>
				                        					<?php foreach ($grupo_etnico as $value){?>
				                        					<option value="<?php echo $value['id_grupo_etnico'];?>"><?php echo $value['grupo_etnico'];?></option>
				                        					<?php }?>		                        					
				                        				</select>
				                        			</td>		                        					                        					                        			
				                        		</tr>	                        			                        				                        				                        		
				                        	</table>
			                        	</div>
		                        	</td>
		                        </tr>
		                     </table>
		                        	<br /><br />
		                        <div class="grupo">
		                        	<table width="100%" border="0">	
		                        		<tr>
		                        			<td width="33%" align="center">
		                        				<select id="id_estado_civil" name="id_estado_civil" class="form-control" style="width: 50%;">
		                        					
		                        					<option value="1">Soltero(a)</option>
													<option value="2">Casado(a)</option>
													<option value="3">Divorciado(a)</option>
													<option value="4">Viudo(a)</option>
													<option value="5">Union libre</option>
													<option value="99">No sabe/sin respuesta</option>
		                        					
		                        				</select>
		                        			</td>
		                        			
		                        			<td width="33%" align="center">
		                        				<select id="id_hijos" name="id_hijos" class="form-control" style="width: 50%;">
		                        					<option value="0"> Sin hijos </option>
		                        					<option value="1">Uno</option>
													<option value="2">Dos</option>
													<option value="3">Tres</option>
													<option value="4">Cuatro</option>
													<option value="5">Cinco</option>
													<option value="6">Seis</option>
													<option value="7">Siete</option>
													<option value="8">Ocho</option>
													<option value="9">Nueve</option>
													<option value="10">Diez</option>
													
		                        				</select>
		                        			</td>
		                        			
		                        			<td width="33%" align="center">
		                        				<select id="id_ocupacion" name="id_ocupacion" class="form-control" style="width: 50%;">
		                        					<option value="2">Estudiante</option>
		                        					<option value="1">Tareas del hogar</option>
													
													<option value="3">Artesano(a), obrero(a), trabajador(a) en actividades industriales o manuales</option>
													<option value="4">Empleado(a) de oficina o trabajador(a) en actividades administrativas o de servicios</option>
													<option value="5">Comerciante o empleado(a) de comercio</option>
													<option value="6">Trabajador(a) en actividades agrícolas</option>
													<option value="7">Trabajador(a) en servicios domésticos</option>
													<option value="8">Vendedor(a) ambulante</option>
													<option value="9">Trabajador(a) por cuenta propia</option>
													<option value="10">Conductor(a) de medio de transporte</option>
													<option value="11">Trabajador(a) en servicios de seguridad y fuerzas armadas</option>
													<option value="12">Maestro(a) docente o trabajador(a) de la educación</option>
													<option value="13">Profesionista o técnico(a) independiente</option>
													<option value="14">Lider o directivo(a) del sector social o civil</option>
													<option value="15">Funcionario(a) del sector público</option>
													<option value="16">Empresario(a), gerente o directivo(a) de empresa</option>
													<option value="17">Jubilado(a)/pensionado(a)</option>
													<option value="18">Desempleado(a)/buscador(a) de trabajo</option>
													<option value="19">Otra ocupación no especificada</option>
													<option value="99">No sabe/sin respuesta</option>
		                        				</select>
		                        			</td>
		                        		</tr>	                        			                        				                        		
		                        		<tr>
		                        			<td align="center" valign="top"><label>Estado Civil</label></td>
		                        			
		                        			<td align="center" valign="top"><label>Número de hijos</label></td>
		                        			
		                        			<td align="center" valign="top"><label>Ocupación</label></td>
		                        		</tr>
		                        	</table>
		                        </div>
		                        <br />
		                        
		                        	<table width="100%" border="0">	
		                        		<tr>
		                        			<td  width="50%" align="center">
		                        				<div class="grupo">
		                        					<input type="text" style="text-transform:uppercase;"  id="email1" name="email1" placeholder="Correo electrónico" value="" title="flower" class="form-control"><!-- placeholder="Correo electrónico" -->
		                        				</div>
		                        			</td>
		                        			
		                        			<td  width="50%" align="center">
		                        				<div class="grupo">
		                        					<input type="text" style="text-transform:uppercase;" id="email2" name="email2"  placeholder="Confirma tu correo electrónico" value="" class="form-control"><!-- placeholder="Confirma tu correo electrónico" -->
		                        				</div>
		                        			</td>		                        					                        					                        			
		                        		</tr>	                        			                        				                        		
		                        		<tr>
		                        			<td align="center" style="color:red;" valign="top"><label>*Correo electrónico</label></td>
		                        			
		                        			<td align="center" style="color:red;" valign="top"><label>*Confirma tu correo electrónico</label></td>		                        					                        					                        			
		                        		</tr>
		                        	</table>
		                        		
	                        </div>
	                        
	                        <hr/>	                        
	                        
	                        <div id="dotos_domicilio">
		                       <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Domicilio</label></div>
		                       <div class="grupo"> 
			                       <table width="100%" border="0">	
			                        <tr>
			                        	<td align="center" style="color:red;"><label>*Delegación</label></td>
			                        	<td align="center" style="color:red;"><label>*Colonia</label></td>
			                        	<td align="center" style="color:red;"><label>*Código Postal</label></td>
			                        	
			                        </tr>
			                        <tr>
			                       		
			                        	<td align="center"  width="30%">
				                        	<select id="id_delegacion" name="id_delegacion" class="form-control" style="width: 80%;">
				                        		<option value="-1">[Seleccionar]</option>
				                        		<option value="10">Álvaro Obregón</option>
												<option value="2">Azcapotzalco</option>
												<option value="14">Benito Juárez</option>
												<option value="3">Coyoacán</option>
												<option value="4">Cuajimalpa de Morelos</option>
												<option value="15">Cuauhtémoc</option>
												<option value="5">Gustavo A. Madero</option>
												<option value="6">Iztacalco</option>
												<option value="7">Iztapalapa</option>
												<option value="8">La Magdalena Contreras</option>
												<option value="16">Miguel Hidalgo</option>
												<option value="9">Milpa Alta</option>
												<option value="11">Tlahuac</option>
												<option value="12">Tlalpan</option>
												<option value="17">Venustiano Carranza</option>
												<option value="13">Xochimilco</option>
				                        	</select>
				                        </td>
				                        
			                        	<td align="center" width="30%">
				                        	<select id="id_colonia" name="id_colonia" class="form-control" width="80%" style="width: 80%;">
				                        		<option value="-1">[Seleccionar]</option>
					                        	
					                        </select>
			                        	</td>
			                        	
			                        	<td align="center" width="15%"><input type="text" id="id_cp" name="id_cp" placeholder="     código postal" value="" style="width: 80%;" readonly></td>
			                        	
			                        	
			                        </tr>
			                     </table>
		                       </div>
		                       <br>			                        		                      	         	                      
		                     
		                        <table width="100%" border="0">	
			                         <tr>
			                         	<td rowspan="2" width="1%"></td>
			                        	<td colspan="2" align="center" valign="top" style="color:red;"><label>*Calle</label></td>
			                        	<td align="center" style="color:red;" ><label>*No.Exterior</label></td>
			                        	<td ></td>
			                        	<td align="center"><label>No. Interior</label></td>
			                        	<td align="center"><label>Tiempo de Residencia</label></td>
			                        	
			                        	
			                        	
			                        </tr>
			                        <tr>
			                       		
			                        	<td align="center"  width="30%"><div class="grupo"><input type="text" style="text-transform:uppercase;" id="calle" name="calle" placeholder="Calle" value="" style="width: 100%;" ></div></td>
			                        	<td rowspan="2" width="1%"></td>
			                        	<td width="5%"><input type="text" id="noext" name="noext"  style="width: 90%;" value=""></td>
			                        	<td width="1%"></td>
			                        	<td width="5%"><input type="text" id="noint" name="noint"  style="width: 90%;" value=""></td>
				                        <td align="center" width="20%">
				                        	<div class="grupo">
				                        	<select id="id_residencia" name="id_residencia" class="form-control" style="width: 80%;">
					                        	<option value="99">No sabe/sin respuesta</option>
					                        	<option value="1">Menos de 6 meses</option>
												<option value="2">6 meses a 1 año</option>
												<option value="3">1 a 3 años</option>
												<option value="4">3 a 5 años</option>
												<option value="5">5 a 8 años</option>
												<option value="6">8 a 12 años</option>
												<option value="7">12 a 20 años</option>
												<option value="8">20 años o mas</option>
												
					                        </select>
					                        </div>
			                        	</td>
			                        	
			                        </tr>
			                    </table>
			                    </div>
		                      
		                      <br>
		                    <div class="grupo">
		                    	<table width="100%" border="0">	
		                       		<tr>
			                        	<td align="center" ><label>Entre la Calle</label></td>
			                        	<td align="center" ><label>y la Calle</label></td>
			                        </tr>
			                        <tr>
		                        		<td  width="50%" align="center"><input type="text" style="text-transform:uppercase;" id="ecalle" name="ecalle"  value=""></td>
		                        		<td  width="50%" align="center"><input type="text" style="text-transform:uppercase;" id="ycalle" name="ycalle"  value=""></td>		                        					                        					                        			
		                        	</tr>
		                       	
		                       	</table>
		                   </div>
		                   <br>
		                   <div class="grupo">
		                   	<table width="100%" border="0">	
			                   	<tr>
			                   		<td align="center"><label>No. Edificio</label></td>
				                    <td align="center"><label>No. Depto.</label></td>
				                    <td align="center"><label>Manzana</label></td>
				                    <td align="center"><label>Lote</label></td>
				                    <td align="center"><label>Rampa</label></td>
				                    
			                   	</tr>
			                   	<tr>
			                        <td width="3%"><input type="text" id="edificio" name="edificio"  style="width: 90%;" value=""></td>
			                        <td width="3%"><input type="text" id="departamento" name="departamento"  style="width: 90%;" value=""></td>
			                        <td width="3%"><input type="text" id="manzana" name="manzana"  style="width: 90%;" value=""></td>
			                        <td width="3%"><input type="text" id="lote" name="lote"  style="width: 90%;" value=""></td>
			                        <td width="3%"><input type="text" id="rampa" name="rampa"  style="width: 90%;" value=""></td>
			                        
			                   	</tr>
			                   	</table>
			                   	<br>
			                   	<table width="100%" border="0">	
			                   	<tr>
			                   		<td align="center"><label>Pasillo</label></td>
				                    <td align="center"><label>Villa</label></td>
				                    <td align="center"><label>Entrada</label></td>
				                   	<td align="center"><label>Andador</label></td>
				                    <td align="center" style="color:red;"><label>*Telefono</label></td>
			                   		<td align="center" ><label>Celular</label></td>
				                   
			                   	</tr>
			                   	<tr>
			                   		
			                   		
			                        <td width="3%"><input type="text" id="pasillo" name="pasillo"  style="width: 90%;" value=""></td>
			                        <td width="3%"><input type="text" id="villa" name="villa"  style="width: 90%;" value=""></td>
			                        <td width="3%"><input type="text" id="entrada" name="entrada"  style="width: 90%;" value=""></td>
			                        <td width="3%"><input type="text" id="andador" name="andador"  style="width: 90%;" value=""></td>
			                        <td width="3%"><input type="text" id="telefono" name="telefono"  maxlength="8" style="width: 70%;" value=""></td>
			                        <td width="3%">044-55<input type="text" id="celular" name="celular"  maxlength="8" style="width: 70%;" value=""></td>
			                   	</tr>
			                  
		                   	</table>
		                   </div>
		                   
		                   <hr/>
	                       
	                        <div id="dotos_familiares">
		                       <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Datos Familiares</label></div>			                        		                      	         	                      
		                       <div class="grupo">
		                       		<table width="100%" border="0">
		                       			<tr>
		                       				<td rowspan="5" width="1%"></td>
		                       				<td align="left" colspan="3" style="color:red;"><label>*Datos del Padre</label></td>
		                       				<td rowspan="2" width="2%" valign="bottom"><h6><b>Finado</b></h6><input type="checkbox" id="finado_padre" name="finado_padre" data-toggle="toggle" data-on="SI" data-off="NO" data-size="mini" data-onstyle="warning" data-width="33"></td>
		                       				
					                   	</tr>
		                       			<tr>
		                       				
		                       				<td  width="15%" align="center"><input type="text" style="text-transform:uppercase;" id="apellidoPadreP" name="apellidoPadreP"  placeholder="Apellido Paterno" value=""></td>
		                        			<td  width="15%" align="center"><input type="text" style="text-transform:uppercase;" id="apellidoPadreM" name="apellidoPadreM"  placeholder="Apellido Materno" value=""></td>
		                        			<td  width="15%" align="center" ><input type="text" style="text-transform:uppercase;" id="nombrePadre" name="nombrePadre"  placeholder="Nombre" value=""></td>
		                        				
		                        		
		                       			</tr>
		                       			<tr><td> &nbsp; </td></tr>
		                       			<tr>
		                       				
		                       				<td align="left" colspan="3" style="color:red;"><label>*Datos de la Madre</label></td>
		                       				<td rowspan="2" width="2%" valign="top"><h6><b>Finado</b></h6><input type="checkbox" id="finado_madre" name="finado_madre" data-toggle="toggle" data-on="SI" data-off="NO" data-size="mini" data-onstyle="warning" data-width="33"></td>
						                </tr>
		                       			<tr>
		                       			
		                       				<td  width="15%" align="center"><input type="text" style="text-transform:uppercase;" id="apellidoMadreP" name="apellidoMadreP"  placeholder="Apellido Paterno" value=""></td>
		                        			<td  width="15%" align="center"><input type="text" style="text-transform:uppercase;" id="apellidoMadreM" name="apellidoMadreM"  placeholder="Apellido Materno" value=""></td>
		                        			<td  width="15%" align="center"><input type="text" style="text-transform:uppercase;" id="nombreMadre" name="nombreMadre"  placeholder="Nombre" value=""></td>
		                       			</tr>
		                       		
		                       		
		                       		</table>
		                       </div>
		                      </div>
	                        </div>
	                        <br />
	                        <hr/>
	                        
	                        <div id="dotos_escolares">
		                       <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Datos Escolares</label></div>	<br />		                        		                      	         	                      
		                       <div class="grupo">
		                       		<table width="100%" border="0">
		                       			<tr>
		                       				<td rowspan="7" width="2%"></td>
		                       				<td align="left" width="7%" ><label>Institución</label></td>
		                       				<td colspan="4">
		                       					<input type="text" id="institucion" name="institucion"   style="width: 100%;" value="<?php echo '  '.$institucion['institucion'];?>" readonly>
		                       					<input type="hidden" id="id_institucion" name="id_institucion" value="<?php echo $selectInst;?>">
		                       				</td>
		                       				
					                   	</tr>
					                   	<tr><td> &nbsp; </td></tr>
		                       			<tr>
		                       				<td align="left" width="7%" style="color:red;"><label>*Plantel</label></td>
		                       				<td colspan="5">
			                       				<select id="id_plantel" name="id_plantel" class="form-control"  style="width: 70%;">
						                        	<option value="-1">[Seleccionar]</option>
						                        	<?php foreach ($plantel as $value){	?>
						                        	<option value="<?php echo $value['id_plantel']?>"><?php echo $value['plantel']?></option>
						                        	<?php }?>
						                        </select>
						                    </td>
		                        				
		                        		
		                       			</tr>
		                       			<tr><td colspan="5"> &nbsp; </td></tr>
		                       			<tr>
		                       				
		                       				<td align="left" colspan="2" width="20%">
		                       					<label>Carrera(en caso de que aplique)</label>
		                       					<select id="id_carrera" name="id_carrera" class="form-control"  style="width: 90%;">
						                        	<option value="0">[Seleccionar]</option>
						                        	<?php foreach ($carrera as $value){	?>
						                        	<option value="<?php echo $value['id_carrera']?>"><?php echo $value['carrera']?></option>
						                        	<?php }?>
						                        </select>
		                       				</td>
		                       				<td style="color:red;" align="center" width="20%">
		                       					<label>*Ciclo de ingreso al Bachillerato</label>
		                       					<select id="id_ciclo" name="id_ciclo" class="form-control"  style="width: 90%;">
						                        	<option value="-1">[Seleccionar]</option>
						                        	<?php foreach ($generacion as $value){	?>
						                        	<option value="<?php echo $value['id_generacion'];?>"><?php echo $value['generacion'];?></option>
						                        	<?php }?>
						                        </select>
		                       				</td>
		                       				<td align="center" style="color:red;" width="20%">
			                       				<label>*Modalidad</label>
			                       				<select id="id_sistema" name="id_sistema" class="form-control"  style="width: 90%;">
							                        <option value="-1">[Seleccionar]</option>
							                        <option value="1">Sistema Escolarizado</option>
													<option value="2">Sistema Abierto</option>
													<option value="3">Sistema Mixto</option>
							                        
						                        </select>
		                       				</td>
		                       				<td align="center" width="20%" style="color:red;">
		                       					<label>*Promedio (ciclo inmediato anterior)</label>
		                       					<select id="promedio" name="promedio" class="form-control"  style="width: 90%;">
									           		 <option value="-1">- Selecciona -</option>
									                 <option value="1" >6.00 - 6.50 </option>
									                 <option value="2" >6.51 - 7.00 </option>
									                 <option value="3" >7.01 - 7.50</option>
									                 <option value="4" >7.51 - 8.00 </option>
									                 <option value="5" >8.01 - 8.50 </option>
									                 <option value="6" >8.51 - 9.00 </option>
									                 <option value="7" >9.01 - 9.50 </option>
									                 <option value="8" >9.51 - 10.00 </option>
		   										</select>
		                       				</td>
						                    
		                        		</tr>
		                       			<tr><td colspan="5"> &nbsp; </td></tr>
		                       			<tr>
		                       				
		                       				<td align="center" style="color:red;" colspan="2" width="20%">
		                       					<label>*Matricula</label>
		                       					<input type="text" id="matricula" name="matricula"   style="width: 100%;"value="">
		                       					
		                       				</td>
		                       				<td style="color:red;" align="center" style="color:red;" width="20%">
		                       					<label>*Grado o Semestre</label>
		                       					<select id="id_grado" name="id_grado" class="form-control"  style="width: 80%;">
						                        	<option value="-1">[Seleccionar]</option>
						                        	<?php foreach ($grado as $value){	?>
						                        	<option value="<?php echo $value['id_grado']?>"><?php echo $value['grado'].' - '.$value['periodicidad'];?></option>
						                        	<?php }?>
						                        </select>
		                       				</td>
		                       				<td style="color:red;" align="center" width="20%">
			                       				<label>*Turno</label>
			                       				<select id="id_turno" name="id_turno" class="form-control"  style="width: 90%;">
							                        <option value="-1">[Seleccionar]</option>
							                        <option value="1">Matutino</option>
													<option value="2">Vespertino</option>
													<option value="3">Nocturno</option>
													<option value="4">Sabatino</option>
													<option value="5">Sin Turno</option>
													<option value="6">Mixto</option>
						                        </select>
		                       				</td>
		                       				<td align="top" width="20%">
		                       					<label>Materias que adeuda</label><br>
		                       					<input  type="text" id="materias" name="materias"   style="width: 30%;"value="0">
		                       				</td>
						                    
		                        		</tr>
		                       		
		                       		</table>
	                        	</div>
	                      	</div>				    
	                      	                        	                                            	                        	                       	                        	                      	                       
	                       <br>
			                <div style="text-align:right; color:#E60380 !important; cursor:pointer; width:96%;"> 
			                 <i><a href="javascript:muestraAviso();">Consultar nuestro aviso de privacidad</a></i>
			                </div>

                       </div>
                                             
                        	<button id="guardar" type="button" style="font-weight:bold;">REGISTRARSE</button>
                                                                  
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
