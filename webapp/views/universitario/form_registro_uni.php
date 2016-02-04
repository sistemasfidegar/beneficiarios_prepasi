<!DOCTYPE html>
<html lang="es">
    <head>
    	<base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <title>Universitarios Sí</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        
        <link rel="stylesheet" href="../../resources/bootstrap-3.3.6/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="../../resources/formulario/css/jquery-ui.css">
        <link rel="stylesheet" href="../../resources/formulario/css/style.css">       
        <link rel="stylesheet" href="../../resources/formulario/numeric/jquery-numeric.css">   
        <!--  <link rel="stylesheet" href="../resources/formulario/qtip/jquery.qtip.css">-->
		
                 
         
        <script type="text/javascript" src="../../resources/js/jquery-1.12.0.min.js" charset="UTF-8"></script>
        
        
        <link rel="stylesheet" href="../../resources/sweetalert/sweetalert.css">                            
        <script type="text/javascript" src="../../resources/sweetalert/sweetalert.min.js"></script>  
        <script type="text/javascript" src="../../resources/js/jquery.blockUI.js"></script>
        <script type="text/javascript" src="../../resources/formulario/js/bootbox.min.js"></script>
        <script type="text/javascript" src="../../resources/formulario/js/jquery-ui.js"></script>
        <script type="text/javascript" src="../../resources/formulario/js/jquery-validate.js"></script>
        <script type="text/javascript" src="../../resources/formulario/numeric/jquery-numeric.js"></script>
        <!--<script type="text/javascript" src="../resources/formulario/qtip/jquery.qtip.js"></script>
          -->
		<script type="text/javascript" src="../../resources/bootstrap-3.3.6/js/bootstrap.min.js"></script>
				
		<link href="../../resources/formulario/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script type="text/javascript" src="../../resources/formulario/js/bootstrap-toggle.min.js"></script>
       
        
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
         <style>
        
	        .error {
			    background: url("../../resources/formulario/css/images/ui-bg_glass_95_fef1ec_1x400.png") repeat-x scroll 50% 50% #fef1ec !important;
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
  
     
       $().ready(function() {
			  
		
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
			        	
			        	selectInst: "selectNone"	
				        		           
			        	
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

		  
	
		 jQuery.validator.addMethod("selectNone",function (value, element)
		{
						if (element.value == "-1")
							return false;
				        else
				            return true;
				     },"Debe seleccionar una opción"
				 );
		 $("#beneficiario_universidad").validate(rules_form);

	
		 
		}); //fin ready
		 
		function irA(uri) {
	        window.location.href = '<?php echo base_url(); ?>' + uri;
	        
	    }  
		   
      
		</script>
        
        
    </head>

    <body>
       
        <div class="register-container container">
            <div class="row">                
                <div class="register">
                    <form role="form" id="beneficiario_universidad" name="registra_beneficiario" action="buscaInstitucion" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        	<img src="../../resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;
                        	<!-- <img src="../resources/formulario/img/tit_sistema.png" style="padding-top:10px;" align="top" />  -->                        	
                        </div>
                        
                                                	                        	                       
	                    <div id="datos_beneficiario" style="text-align:center; padding-top:10px;">
	                    
		                        <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Datos Personales</label></div>	
		                        <div style="text-align:center !important;">
		                        <div class="form-group">
		                        	<input type="hidden" id="matricula" name="matricula" value="<?php echo $matricula;?>">
		                        	
		                        </div>
		                        <div class="form-group">
								    
		                        	<table width="100%" border="0">		                        	
		                        		<tr>		                        			
		                        			<td colspan="5" height="41px" align="center" valign="top" style="font-size:24px; font-weight:bold; color:#e6007e;">
		                        				<?php echo $dato['nombre']." ".$dato['ap']." ".$dato['am'];?>
		                        				<input type="hidden" id="nombre" name="nombre" value="<?php echo $dato['nombre'];?>">
		                        				<input type="hidden" id="ap" name="ap" value="<?php echo $dato['ap'];?>">
		                        				<input type="hidden" id="am" name="am" value="<?php echo $dato['am'];?>">
		                        				
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
		                        			<td width="20%" align="center"><?php echo $dato['curp'];?><input type="hidden" id="curp" name="curp" value="<?php echo $dato['curp'];?>"></td>
		                        			
		                        			<td width="20%" align="center"> <?php echo $dato['fecha_nac'];?><input type="hidden" id="fecha_nac" name="fecha_nac" value="<?php echo $dato['fecha_nac'];?>"></td>
		                        			
		                        			<td width="20%" align="center"><?php echo $dato['estado'];?><input type="hidden" id="lugar_nac" name="lugar_nac" value="<?php echo $dato['estado'];?>">
		                        			<input type="hidden" id="id_entidad" name="id_entidad" value="<?php echo $dato['id_entidad'];?>"></td>
		                        			
		                        			<td width="20%" align="center"><?php echo $dato['edad'];?><input type="hidden" id="edad" name="edad" value="<?php echo $dato['edad'];?>"></td>
		                        			
		                        			<td width="20%" align="center"> <?php if($dato['id_sexo']==1){echo 'HOMBRE';}elseif($dato['id_sexo']==2){echo 'MUJER';}?><input type="hidden" id="sexo" name="sexo" value="<?php echo$dato['id_sexo'];?>"></td>
		                        			
		                        		</tr>
		                        	</table>
		                        	<br />
							</div>
							<div>
							<table width='500' border='0' align='center' cellpadding='0' cellspacing='3'>
			                    <tr>
			                        <td align='center' class='enrojo10n'>SELECCIONA TU INSTITUCION*:</td>
			                    </tr>
			                    <tr>
			                        <td><span id='spryselect1'>
			                                <select name='selectInst' class='ennegro9' id='selectInst'>
			                                   <option value='-1'>SELECCIONE UNA OPCI&Oacute;N</option>
			                                   <option value='28'>BENEMERITA ESCUELA NACIONAL DE MAESTROS</option>
			                                    <option value='20'>COLEGIO DE M&Eacute;XICO</option>
			                                    <option value='17'>DIRECCION GENERAL DE EDUCACION SUPERIOR TECNOLOGICA</option>
			                                    <option value='30'>ESCUELA DE ENFERMERIA DE LA SECRETARIA DE SALUD DEL DISTRITO FEDERAL</option>
			                                    <option value='31'>ESCUELA DE ENFERMERIA DEL SIGLO XXI</option>
			                                    <option value='24'>ESCUELA NACIONAL DE BIBLIOTECONOM&Iacute;A Y ARCHIVONOM&Iacute;A</option>
			                                    <option value='32'>ESCUELA NACIONAL DE ENTRENADORES DEPORTIVOS</option>
			                                    <option value='27'>ESCUELA NACIONAL PARA MAESTRAS DE JARDINES DE NI&Ntilde;OS</option>
			                                    <option value='29'>ESCUELA NORMAL DE ESPECIALIZACI&Oacute;N </option>
			                                    <option value='26'>ESCUELA NORMAL SUPERIOR DE M&Eacute;XICO</option>
			                                    <option value='25'>ESCUELA SUPERIOR DE EDUCACION F&Iacute;SICA</option>
			                                    <option value='33'>ESCUELA SUPERIOR DE REHABILITACI&Oacute;N</option>
			<!--                                    <option value='23'>INSTITUCION PRIVADA</option> -->
			                                    <option value='21'>INSTITUTO NACIONAL DE ANTROPOLOG&Iacute;A E HISTORIA</option>
			                                    <option value='12'>INSTITUTO NACIONAL DE LAS BELLAS ARTES</option>
			                                    <option value='3'>INSTITUTO POLITECNICO NACIONAL</option>
			                                    <option value='34'>UNIVERSIDAD ABIERTA Y A DISTANCIA DE M&Eacute;XICO</option>
			                                    <option value='19'>UNIVERSIDAD AUTONOMA DE LA CIUDAD DE M&Eacute;XICO</option>
			                                    <option value='16'>UNIVERSIDAD AUT&Oacute;NOMA METROPOLITANA</option>
			<!--                                    <option value='15'>UNIVERSIDAD NACIONAL AUT&Oacute;NOMA DE M&Eacute;XICO</option>-->
			                                </select>
			                                <span class='selectInvalidMsg'></span><span class='selectRequiredMsg'></span></span>
			                        </td>
			                    </tr>
			                    <tr>
			                    </tr>
			                    <tr>
			                    </tr>
			                </table>
							
							
							</div>				    
	                      	                        	                                            	                        	                       	                        	                      	                       
	                       <br>
			                
                       </div>
                                             
                        	<button id="guardar" type="submit" style="font-weight:bold;">REGISTRARSE</button>
                                                                  
                    </form>
                   
                </div>
            </div>
        </div>
    </body>

</html>
