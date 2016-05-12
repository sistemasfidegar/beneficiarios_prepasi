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
	        
        </style>
     
         <div class="register-container container">
            <div class="row">                
                <div class="register">
                    <form role="form" id="registra_beneficiario" name="registra_beneficiario" action="reimpresion/buscaBeneficiario" method="post">
                    
                        <div style="text-align:left; padding-left:20px; border-bottom: 2px dotted #bbb; min-height:73px;">
                        <a href="http://www.prepasi.df.gob.mx/">	<img  src="../resources/formulario/img/logo_gdf_fidegar.png" style="padding-top:10px;" align="top" />&nbsp;</a>
                        	<!-- <img src="../resources/formulario/img/tit_sistema.png" style="padding-top:10px;" align="top" />  -->                        	
                        </div>
                        <br>
                         <div style="text-align:CENTER !important;"><label class="leyenda" style="color:#E6007E; padding-left:20px;"> REIMPRESIÓN DE DOCUMENTOS</label></div>	
					    
					    <table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
							 <tr>
							   <td bgcolor="">
							    
							      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="5">
							       
							        <tr>
							          <td colspan="2" align="center" class="">Elige un método de busqueda:</td>
							          </tr>      
							        <tr>
							          <td width="43%">&nbsp;</td>
							          <td width="57%">&nbsp;</td>
							        </tr>
							        <tr>
							          <td><div align="right"><span class="">CURP:</span></div></td>
							          <td><label for="text"></label>
							            <span class="">
							            <input name="strCurp" type="text" id="strCurp" style="text-transform:uppercase;" size="25" maxlength="18" />
							          </span></td>
							        </tr>
							        <tr>
							          <td colspan="2">&nbsp;</td>
							        </tr>
							        <tr>
							          <td><div align="right"><span class=""> MATRICULA PS:</span></div></td>
							          <td><input name="matricula_ps" type="text" id="matricula_ps" style="text-transform:uppercase;" size="25" maxlength="18" /></td>
							        </tr>
							         <tr>
							          <td colspan="2">&nbsp;</td>
							        </tr>
							        <tr>
							          <td><div align="right"><span class="">NO. CTA (UNAM):</span></div></td>
							          <td><input name="nocta" type="text" id="nocta" style="text-transform:uppercase;" size="25" maxlength="18" /></td>
							        </tr>
							        <tr>
							          
							          <td colspan ="2""center">
							          <div class="box-footer" style="text-align: right;" >
						     				<button id="guardar" name="guardar" type="submit" class="btn">Consultar</button>
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
