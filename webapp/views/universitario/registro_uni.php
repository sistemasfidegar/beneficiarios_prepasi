<!DOCTYPE html>
<html lang="es">
    <head>
    	<base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <title>Registro de Beneficiarios del Programa Universitarios Sí</title>
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
        <!--  <link rel="stylesheet" href="../resources/formulario/qtip/jquery.qtip.css">-->
		
                 
         
        <script type="text/javascript" src="../resources/js/jquery-1.12.0.min.js" charset="UTF-8"></script>
        
        
        <link rel="stylesheet" href="../resources/sweetalert/sweetalert.css">                            
        <script type="text/javascript" src="../resources/sweetalert/sweetalert.min.js"></script>  
        <script type="text/javascript" src="../resources/js/jquery.blockUI.js"></script>
        <script type="text/javascript" src="../resources/formulario/js/bootbox.min.js"></script>
        <script type="text/javascript" src="../resources/formulario/js/jquery-ui.js"></script>
        <script type="text/javascript" src="../resources/formulario/js/jquery-validate.js"></script>
        <script type="text/javascript" src="../resources/formulario/numeric/jquery-numeric.js"></script>
        <!--<script type="text/javascript" src="../resources/formulario/qtip/jquery.qtip.js"></script>
          -->
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
			        
	       
			hr { 
				  background-color: #C5C5C5;
				  height: 2px; 
				}
				.leyenda
	        {
	        	font-size:25px !important;
	        	font-weight: bold;        
	        }
	        .btn-custom {
  background-color: hsl(312, 80%, 43%) !important;
  background-repeat: repeat-x;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=" #E6007E", endColorstr="#E6007E");
  background-image: -khtml-gradient(linear, left top, left bottom, from( #E6007E), to(#E6007E));
  background-image: -moz-linear-gradient(top, #E6007E, #E6007E);
  background-image: -ms-linear-gradient(top, #E6007E, #E6007E);
  background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%,  #E6007E), color-stop(100%, #E6007E));
  background-image: -webkit-linear-gradient(top,  #E6007E, #E6007E);
  background-image: -o-linear-gradient(top, #E6007E, #E6007E);
  background-image: linear-gradient(#E6007E, #E6007E);
  border-color: #E6007E #E6007E hsl(312, 80%, 40.5%);
  color: #fff !important;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.16);
  -webkit-font-smoothing: antialiased;
}
        </style>
        
      <body>
         <div class="register-container container">
            <div class="row">                
                <div class="register">
                    <form role="form" id="registra_beneficiario" name="registra_beneficiario" action="registro_uni/buscaUniversitario" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        <a href="http://www.prepasi.df.gob.mx/">	<img  src="../resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;</a>
                        	<!-- <img src="../resources/formulario/img/tit_sistema.png" style="padding-top:10px;" align="top" />  -->                        	
                        </div>
                        <br>
                         <div style="text-align:CENTER !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;"> PROGRAMA UNIVERSITARIOS SÍ</label></div>	
					    
					    <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
							 <tr>
							   <td bgcolor="">
							    
							      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="3">
							       
							        <tr>
							          <td colspan="2" align="center" class="">&nbsp;</td>
							          </tr>      
							        <tr>
							          <td width="43%">&nbsp;</td>
							          <td width="57%">&nbsp;</td>
							        </tr>
							        <tr>
							          <td><div align="right"><span class="">Introduce tu CURP:</span></div></td>
							          <td><label for="text"></label>
							            <span class="">
							            <input name="strCurp" type="text" id="strCurp" style="text-transform:uppercase;" size="25" maxlength="18" required/>
							          </span></td>
							        </tr>
							        <tr>
							          <td>&nbsp;</td>
							          <td>&nbsp;</td>
							        </tr>
							        <tr>
							          <td>&nbsp;</td>
							          <td align="center">
							          <div class="box-footer" style="text-align: right;" >
						     				<button id="guardar" name="guardar" type="submit" class="btn btn-small">Consultar</button>
						     		   </div>
							          </td>
							        </tr>
							        <tr>
							          <td>&nbsp;</td>
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
	</body>
</html>