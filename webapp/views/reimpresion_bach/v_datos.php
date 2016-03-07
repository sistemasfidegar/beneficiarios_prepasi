<!DOCTYPE html>
<html lang="es">
<head>

   <meta charset="utf-8">
   <title>Reimpresión de Documentos</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   
   <!-- CSS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
        
    <link rel="stylesheet" href="../../../resources/bootstrap-3.3.6/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../../resources/formulario/css/jquery-ui.css">
    <link rel="stylesheet" href="../../../resources/formulario/css/style.css">       
    <link rel="stylesheet" href="../../../resources/formulario/numeric/jquery-numeric.css">
    
     
        <script type="text/javascript" src="../../../resources/js/jquery-1.12.0.min.js" charset="UTF-8"></script>
        
        
        <link rel="stylesheet" href="..../../resources/sweetalert/sweetalert.css">                            
        <script type="text/javascript" src="../../../resources/sweetalert/sweetalert.min.js"></script>  
        <script type="text/javascript" src="../../../resources/js/jquery.blockUI.js"></script>
        <script type="text/javascript" src="../../../resources/formulario/js/bootbox.min.js"></script>
        <script type="text/javascript" src="../../../resources/formulario/js/jquery-ui.js"></script>
        <script type="text/javascript" src="../../../resources/formulario/js/jquery-validate.js"></script>
        <script type="text/javascript" src="../../../resources/formulario/numeric/jquery-numeric.js"></script>
        <!--<script type="text/javascript" src="../../resources/formulario/qtip/jquery.qtip.js"></script>
          -->
		<script type="text/javascript" src="../../../resources/bootstrap-3.3.6/js/bootstrap.min.js"></script>
				
		<link href="../../../resources/formulario/css/bootstrap-toggle.min.css" rel="stylesheet">
		<script type="text/javascript" src="../../../resources/formulario/js/bootstrap-toggle.min.js"></script>
          
   <style type="text/css">
	.btn {
		  background: #e61e85;
		  background-image: -webkit-linear-gradient(top, #e61e85, #f2228e);
		  background-image: -moz-linear-gradient(top, #e61e85, #f2228e);
		  background-image: -ms-linear-gradient(top, #e61e85, #f2228e);
		  background-image: -o-linear-gradient(top, #e61e85, #f2228e);
		  background-image: linear-gradient(to bottom, #e61e85, #f2228e);
		  -webkit-border-radius: 2;
		  -moz-border-radius: 2;
		  border-radius: 2px;
		  text-shadow: 1px 1px 3px #ffffff;
		  -webkit-box-shadow: 0px 1px 3px #faf7fa;
		  -moz-box-shadow: 0px 1px 3px #faf7fa;
		  box-shadow: 0px 1px 3px #faf7fa;
		  font-family: Arial;
		  color: #ffffff;
		  font-size: 15px;
		  padding: 4px 43px 4px 43px;
		  border: solid #E3157D 1px;
		  text-decoration: none;
		}
		
		.btn:hover {
		  background: #f2228e;
		  background-image: -webkit-linear-gradient(top, #f2228e, #e61e85);
		  background-image: -moz-linear-gradient(top, #f2228e, #e61e85);
		  background-image: -ms-linear-gradient(top, #f2228e, #e61e85);
		  background-image: -o-linear-gradient(top, #f2228e, #e61e85);
		  background-image: linear-gradient(to bottom, #f2228e, #e61e85);
		  text-decoration: none;
		}
        
  </style>               
        
  <script type="text/javascript">
        function irA(uri) {
            window.location.href = '<?php echo base_url(); ?>' + uri;
        }
  </script>
  </head>
	
  <body>
    
    <?php 
   
  
    ?>
       
        <div class="register-container container">
            <div class="row">
               
                <div class="register">
                    <form id="registra" action="../pdf" method="post">
                    	<!-- <input type="hidden" id="matricula" name="matricula" value="<?php  echo $matricula; ?>" /> -->
                    	
                    	<input type="hidden" id="id_archivo" name="id_archivo" value="<?php echo $identificacion['id_archivo']; ?>" />
                    	<input type="hidden" id="fecha_carga" name="fecha_carga" value="<?php echo $identificacion['fecha']; ?>" />
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        	<a href="index.php/reimpresion/index"><img src="../../../resources/img/logo_gdf_cgdf.png" style="padding-top:0px;" align="top" /></a>&nbsp;                                               	
                        </div>
                        
                        <div style="text-align:center; padding-top:20px;">
                        	                        	                       
	                        <div id="dotos_personales">
	                        	
		                        <label class="leyenda" style="color:#E6007E; text-align:left; padding-left:20px;">1. Identificación</label>	<br>	                        
		                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $identificacion['nombre']; ?>" title="Nombre" style="width:30%;" readonly >		                        		                        
	                        	<input type="text" id="paterno" name="paterno" placeholder="A. Paterno" value="<?php echo $identificacion['ap']; ?>" title="Apellido Paterno" style="width:30%;" readonly >		                       		                        		                        
		                        <input type="text" id="materno" name="materno" placeholder="A. Materno" value="<?php echo $identificacion['am']; ?>" title="Apellido Materno" style="width:30%;" readonly >
		                        <br />
		                        <input type="hidden" id="sexo" name="sexo" placeholder="sexo" value="<?php if ($identificacion['id_sexo']==1)echo'HOMBRE';else echo 'MUJER'; ?>" title="sexo" style="width:8%;" readonly >
		                        <input type="hidden" id="e_civil" name="e_civil" placeholder="estado civil" value="<?php if ($identificacion['id_estado_civil']==1)echo'Soltero(a)';elseif ($identificacion['id_estado_civil']==2)echo 'Casado(a)';
		                        	elseif ($identificacion['id_estado_civil']==3) echo 'Divorciado(a)';elseif ($identificacion['id_estado_civil']==4) echo 'Viudo(a)';
		                        	//elseif ($identificacion['id_estado_civil']==5) echo 'Union libre'; ?>" title="estado civil" style="width:8%;" readonly >
		                        <input type="hidden" id="fecha_nac" name="fecha_nac" placeholder="fecha nacimiento" value="<?php echo $identificacion['fecha_nacimiento']; ?>" title="fecha nacimiento" style="width:30%;" readonly > 
		                        
		                        <input type="hidden" id="correo" name="correo" placeholder="Correo electrónico" value="<?php echo $identificacion['email']; ?>" title="Correo Electrónico" style="width:30%;" readonly > 
		                        <input type="hidden" id="tel" name="tel" placeholder="Teléfono" value="<?php echo $identificacion['telefono']; ?>" title="Teléfono" style="width:30%;" readonly >
		                        <input type="hidden" id="cel" name="cel" placeholder="Celular" value="<?php echo $identificacion['celular']; ?>" title="Celular" style="width:30%;" readonly >
		                        <input type="hidden" id="padre" name="padre" placeholder="padre" value="<?php echo $identificacion['nombre_p'].' '.$identificacion['ap_p'].' '.$identificacion['am_p']; ?>" title="padre" style="width:30%;" readonly >
		                        <input type="hidden" id="madre" name="madre" placeholder="madre" value="<?php echo $identificacion['nombre_m'].' '.$identificacion['ap_m'].' '.$identificacion['am_m']; ?>" title="madre" style="width:30%;" readonly >
		                        
		                         <br />
		                        <input type="text" id="curp" name="curp" placeholder="curp" value="<?php echo $identificacion['curp']; ?>" title="curp" style="width:46%;" readonly >
		                        <input type="text" id="matricula" name="matricula" placeholder="matricula" value="<?php echo $matricula; ?>" title="matricula" style="width:46%;" readonly >
	                        </div>
	                        
	                        
	         	            <br />
	         	            <div id="dotos_domicilio">           
	                        	<label class="leyenda" style="color:#E6007E;  text-align:left; padding-left:20px;">2. Domicilio</label><br>
	                        	<input type="text" id="calle" name="calle" placeholder="Calle" value="<?php echo $direccion['calle']; ?>" style="width:35%;" title="Calle" readonly >
	                        	<input type="text" id="noext" name="noext" placeholder="No. Exterior" value="<?php echo $direccion['noext']; ?>" style="width:10%;" title="No. Exterior" readonly >
	                        	<input type="text" id="noint" name="noint" placeholder="No. Interior" value="<?php echo $direccion['noint']; ?>" style="width:10%;" title="No. Interior" readonly >
	                        	<input type="text" id="manzana" name="manzana" placeholder="Manzana" value="<?php echo $direccion['manzana']; ?>" style="width:10%;" title="Manzana" readonly >
	                        	<input type="text" id="lote" name="lote" placeholder="Lote" value="<?php echo $direccion['lote']; ?>" style="width:10%;" title="Lote" readonly >
	                        	<input type="text" id="noedif" name="noedif" placeholder="No. Edificio" value="<?php echo $direccion['edificio']; ?>" title="No. Edificio" style="width:10%;" readonly >
	                        	<br />	                        	
	                        	<input type="text" id="nodpto" name="nodpto" placeholder="No. Dpto" value="<?php echo $direccion['departamento']; ?>" title="Departamento" style="width:10%;" readonly >
	                        	<input type="text" id="andador" name="andador" placeholder="Andador" value="<?php echo $direccion['andador']; ?>" title="Andador" style="width:10%;" readonly >
	                        	<input type="text" id="rampa" name="rampa" placeholder="Rampa" value="<?php echo $direccion['rampa']; ?>" title="Rampa" style="width:10%;" readonly >
	                        	<input type="text" id="pasillo" name="pasillo" placeholder="Pasillo" value="<?php echo $direccion['pasillo']; ?>" title="Pasillo" style="width:10%;" readonly >
	                        	<input type="text" id="villa" name="villa" placeholder="Villa" value="<?php echo $direccion['villa']; ?>" title="Villa" style="width:11%;" readonly >
	                        	<input type="text" id="entrada" name="entrada" placeholder="Entrada" value="<?php echo $direccion['entrada']; ?>" title="Entrada" style="width:10%;" readonly >
	                        	<input type="text" id="colonia" name="colonia" placeholder="Colonia" value="<?php echo strtoupper($direccion['colonia']); ?>" title="Colonia" style="width:22%;" readonly >
	                        	<br />
	                        	<input type="text" id="delegacion" name="delegacion" placeholder="Delegación" value="<?php echo $direccion['delegacion']; ?>" title="Delegación" style="width:80%;" readonly >	                        	
	                        	<input type="text" id="cp" name="cp" placeholder="C.P." value="<?php echo $direccion['cp']; ?>" title="Código Postal" style="width:11%;" readonly >
	                        
	                        </div>
	                        
	                        <br />
	                        <div id="dotos_escolares">
	                        
	                        <?php 
	                        if($identificacion['id_archivo']!=3)
	                        {
	                        	$institucion = $escolar['institucion'];
	                        	$plantel = $escolar['plantel'];
	                        	$grado = $escolar['grado'];
	                        	$turno = $escolar['turno'];
	                        	$modalidad = $escolar['sistema'];
	                        	$promedio = $escolar['promedio'];
	                        	      
	                         }
// 	                        else 
// 	                        {
// 	                        	$institucion = $escolar['institucion_uni'];
// 	                        	$plantel = $escolar['plantel_uni'];
// 	                        	$grado = $escolar['grado_uni'];
// 	                        	$turno = $escolar['turno_uni'];
// 	                        	$modalidad = $escolar['sistema'];
// 	                        	$promedio = $escolar['promedio_uni'];
	                        	
	                        	
// 	                        }
	                        if($promedio=='1')
	                        	$promedio='6.00 - 6.50';
	                        if($promedio=='2')
	                        	$promedio='6.51 - 7.00';
	                        if($promedio=='3')
	                        	$promedio='7.01 - 7.50';
	                        if($promedio=='4')
	                        	$promedio='7.51 - 8.00';
	                        if($promedio=='5')
	                        	$promedio='8.01 - 8.50';
	                        if($promedio=='6')
	                        	$promedio='8.51 - 9.00';
	                        if($promedio=='7')
	                        	$promedio='9.01 - 9.50';
	                        if($promedio=='8')
	                        	$promedio='9.51 - 10';
	                       
	                        ?>
		                        <label class="leyenda" style="color:#E6007E;  text-align:left; padding-left:20px;">3. Datos escolares</label><br>
		                        <input type="text" id="institucion" name="institucion" placeholder="Institución" value="<?php echo $institucion; ?>" title="Institución" style="width:36%;" readonly >
	                        	<input type="text" id="plantel" name="plantel" placeholder="Plantel" value="<?php echo $plantel; ?>" title="Plantel" style="width:35%;" readonly >
	                        	<br>
	                        	<input type="text" id="sistema" name="sistema" placeholder="Grado" value="<?php echo $modalidad; ?>" title="sistema" style="width:25%;" readonly > 
	                        	<input type="text" id="promedio" name="promedio" placeholder="promedio" value="<?php echo $promedio; ?>" title="promedio" style="width:10%;" readonly >          	
	                        	<input type="text" id="grado" name="grado" placeholder="Grado" value="<?php echo $grado; ?>" title="Grado" style="width:10%;" readonly >
	                        	<input type="text" id="turno" name="turno" placeholder="Turno" value="<?php echo strtoupper($turno); ?>" title="Turno" style="width:10%;" readonly >
	                        	
	                       	</div>    	                       
	                        
	                      
						    

                       </div>
                           <br>
                        	<div style="text-align:center; padding-left:20px;  min-height:73px;" class="span10">
				                <!--   <a href="index.php/reimpresion/pdf/?matricula="<?php echo $matricula;?> class="btn">Imprimir</a>-->
				               <button class="btn" id="guardar" type="submit" style="font-weight:bold;">IMPRIMIR</button>                                          	
				            </div>
                        	
                        	                                      
                    </form>
                   
                </div>
            </div>
        </div>
        
        
        <!-- Javascript -->
        <script src="../../../resources/js/jquery.backstretch.min.js"></script>
        <script src="../../../resources/js/scripts.js"></script>
       
      
             
    </body>

</html>

