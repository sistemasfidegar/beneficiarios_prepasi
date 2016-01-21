<!DOCTYPE html>
<html lang="es">
    <head>
    	<base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <title>Registro de Beneficiarios del Programa Prepa Sí</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        
        <link rel="stylesheet" href="../resources/bootstrap-3.3.6/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="../resources/formulario/css/jquery-ui.css">
        <link rel="stylesheet" href="../resources/formulario/css/style.css">       
        <link rel="stylesheet" href="../resources/formulario/numeric/jquery-numeric.css">   
        <link rel="stylesheet" href="../resources/formulario/qtip/jquery.qtip.css">

                 
         
        <script type="text/javascript" src="../resources/js/jquery-1.12.0.min.js" charset="UTF-8"></script>
        
        <script type="text/javascript" src="../resources/formulario/js/bootbox.min.js"></script>
        <script type="text/javascript" src="../resources/formulario/js/jquery-ui.js"></script>
        <script type="text/javascript" src="../resources/formulario/js/jquery-validate.js"></script>
        <script type="text/javascript" src="../resources/formulario/numeric/jquery-numeric.js"></script>
        <script type="text/javascript" src="../resources/formulario/qtip/jquery.qtip.js"></script>
        
		<script type="text/javascript" src="../resources/bootstrap-3.3.6/js/bootstrap.min.js"></script>
				
		<link href="../resources/formulario/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script type="text/javascript" src="../resources/formulario/js/bootstrap-toggle.min.js"></script>
       
          
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
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
        
        </style>
        
        <script type="text/javascript">
        
        $().ready(function() {
        	        	        	
        	
               
        });//ready
        
        
               
        
        
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



					    
		});
		  
		  
		   
      
		</script>
        
    </head>

    <body>
       
        <div class="register-container container">
            <div class="row">                
                <div class="register">
                    <form id="registra_beneficiario" action="" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        	<img src="../resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;
                        	<!-- <img src="../resources/formulario/img/tit_sistema.png" style="padding-top:10px;" align="top" />  -->                        	
                        </div>
                        
                                                	                        	                       
	                    <div id="datos_beneficiario" style="text-align:center; padding-top:10px;">
	                    
		                        <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Datos Personales</label></div>	
		                        <div style="text-align:center !important;">
		                        	<table width="100%" border="0">		                        	
		                        		<tr>		                        			
		                        			<td colspan="5" height="41px" align="center" valign="top" style="font-size:24px; font-weight:bold; color:#e6007e;"><?php echo $strNombre." ".$strAp." ".$strAm;?></td>		                        		
		                        		</tr>
		                        		
		                        		<tr>
		                        			<td align="center"><label>CURP</label></td>
		                        			
		                        			<td align="center"><label>Fecha de Nacimiento</label></td>
		                        			
		                        			<td align="center"><label>Lugar de Nacimiento</label></td>
		                        			
		                        			<td align="center"><label>Edad</label></td>
		                        			
		                        			<td align="center"><label>Genero</label></td>
		                        			
		                        		</tr>
		                        	
		                        		<tr>		                        			
		                        			<td width="20%" align="center"><?php echo $strCurp;?></td>
		                        			
		                        			<td width="20%" align="center"> <?php echo $diaNac."/".$mesNac."/".$anioNac;?></td>
		                        			
		                        			<td width="20%" align="center"><?php echo $strEntidad;?></td>
		                        			
		                        			<td width="20%" align="center"><?php echo $edad;?></td>
		                        			
		                        			<td width="20%" align="center"> <?php echo $strGenero;?></td>
		                        			
		                        		</tr>
		                        	</table>
		                        	
		                        			                        	
		                        	<br />
		                        	<table width="100%" border="0">	
		                        		<tr>
		                        			<td width="22%" align="center" valign="top"><label>¿Padeces alguna discapacidad?</label></td>
		                        			
		                        			<td width="" align="left">
		                        				<input type="checkbox" id="es_discapacitado" name="es_discapacitado" data-toggle="toggle" data-on="SI" data-off="NO" data-size="mini" data-onstyle="danger" data-width="80">                       			
		                        			</td>		                        					                        		              					                        					                        		
		                        		</tr>	                        			                        				                        				                        		
		                        	</table>
		                        	
		                        	<div id="cmpo_disc" style="display:none;">
			                        	<br />
			                        	<table width="100%" border="0">	
			                        		<tr>
			                        			<td width="11%" align="center" valign="top"><label>Discapacidad:</label></td>	
			                        					                        					                        			
			                        			<td width="" align="left">
			                        				<select id="id_discapacidad" name="id_discapacidad">
			                        					<option value="1">SIN DISCAPACIDAD</option>		                        					
			                        				</select>
			                        			</td>		                        					                        					                        			
			                        		</tr>	                        			                        				                        				                        		
			                        	</table>
		                        	</div>
		                        	
		                        	<br />
		                        	<table width="100%" border="0">	
		                        		<tr>
		                        			<td width="20%" align="center" valign="top"><label>¿Perteneces a alguna etnia?</label></td>
		                        			
		                        			<td width="" align="left">
		                        				<input type="checkbox" id="es_etnia" name="es_etnia" data-toggle="toggle" data-on="SI" data-off="NO" data-size="mini" data-onstyle="danger" data-width="80">                       			
		                        			</td>		                        					                        		              					                        					                        		
		                        		</tr>	                        			                        				                        				                        		
		                        	</table>
		                        	
		                        	
		                        	<div id="cmpo_etnia" style="display:none;">
			                        	<br />
			                        	<table width="100%" border="0">	
			                        		<tr>
			                        			<td width="11%" align="center" valign="top"><label>Etnia:</label></td>	
			                        					                        					                        			
			                        			<td width="" align="left">
			                        				<select id="id_etnia" name="id_etnia">
			                        					<option value="0">[Seleccionar]</option>		                        					
			                        				</select>
			                        			</td>		                        					                        					                        			
			                        		</tr>	                        			                        				                        				                        		
			                        	</table>
		                        	</div>
		                        	
		                        	
		                        	<br />
		                        	<table width="100%" border="0">	
		                        		<tr>
		                        			<td width="33%" align="center">
		                        				<select id="id_estado_civil" name="id_estado_civil">
		                        					<option value="1">SOLTERO</option>
		                        				</select>
		                        			</td>
		                        			
		                        			<td width="33%" align="center">
		                        				<select id="num_hijos" name="id_estado_civil">
		                        					<option value="1">CERO</option>
		                        				</select>
		                        			</td>
		                        			
		                        			<td width="33%" align="center">
		                        				<select id="id_ocupacion" name="id_ocupacion">
		                        					<option value="1">ESTUDIANTE</option>
		                        				</select>
		                        			</td>
		                        		</tr>	                        			                        				                        		
		                        		<tr>
		                        			<td align="center" valign="top"><label>Estado Civil</label></td>
		                        			
		                        			<td align="center" valign="top"><label>Número de hijos</label></td>
		                        			
		                        			<td align="center" valign="top"><label>Ocupación</label></td>
		                        		</tr>
		                        	</table>
		                        	
		                        	<br />
		                        	<table width="100%" border="0">	
		                        		<tr>
		                        			<td  width="50%" align="center"><input type="text" id="email1" name="email1" placeholder="Correo electrónico" value=""></td>
		                        			
		                        			<td  width="50%" align="center"><input type="text" id="email2" name="email2" placeholder="Confirma tu correo electrónico" value=""></td>		                        					                        					                        			
		                        		</tr>	                        			                        				                        		
		                        		<tr>
		                        			<td align="center" valign="top"><label>Correo electrónico</label></td>
		                        			
		                        			<td align="center" valign="top"><label>Confirma tu correo electrónico</label></td>		                        					                        					                        			
		                        		</tr>
		                        	</table>
		                        		
	                        </div>
	                        
	                        	                        
	                        
	                     	<br />
	                        <div id="dotos_domicilio">
		                       <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Domicilio</label></div>			                        		                      	         	                      
		                       <input type="text" id="nombre" name="nombre" placeholder="algun dato" value="">
	                        </div>
	                        
	                        <br />
	                        <div id="dotos_familiares">
		                       <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Datos Familiares</label></div>			                        		                      	         	                      
		                       
	                        </div>
	                        
	                        <br />
	                        <div id="dotos_escolares">
		                       <div style="text-align:left !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;">Datos Escolares</label></div>			                        		                      	         	                      
		                       
	                        </div>
	                      						    
	                      	                        	                                            	                        	                       	                        	                      	                       
	                      
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

       
               
    </body>

</html>