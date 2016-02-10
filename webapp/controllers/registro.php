<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

	public function __construct() {
		parent::__construct();
	
			
		$this->load->model('m_registro');
		$this->load->helper('my_date_helper');
	}
	
	
		
	public function index()
	{
		$ejecuta = true;
		if($_POST==null)
		{			
			$ejecuta = false;
		}
		
		
		
		$id_modulo=1;
		$hoy=new DateTime(fecha_actual());
		
		
		//Datos Beneficiario
		$datos['strNombre'] = $this->input->post('strNombre');
		$datos['strAp'] = $this->input->post('strAp');
		$datos['strAm'] = $this->input->post('strAm');

		
		//Modulo Activo
		$aux=$this->m_registro->getModuloActivo($id_modulo);
		$inicio=new DateTime($aux[0]['inicio']);
		$fin = new DateTime($aux[0]['fin']);
		
			
		if($hoy >= $inicio && $hoy <=$fin && $ejecuta== true)
		{

				//Institucion Activa
				$datos['selectInst'] = (int) $this->input->post('selectInst');
				$aux=$this->m_registro->getFechaInscripcion($datos['selectInst']);
				
				$inicio=new DateTime($aux[0]['inicio']);
				$fin = new DateTime($aux[0]['fin']);
				/*
				 print_r($hoy);
				 echo '<br>';
				 print_r($inicio);
				 */
				
				if($fin !=null && $inicio!=null && $hoy >= $inicio && $hoy <=$fin)
				{
									
					if($_POST!=null)
					{				
						//print_r($_POST);				
						$datos['fechaNac'] = $this->input->post('fechanac');
						$datos['strTramite'] = $this->input->post('tramite');
						$datos['id_archivo'] = (int) $this->input->post('id_archivo');
						$datos['matricula'] = $this->input->post('matricula');		
						$datos['strInstitucion'] = $this->input->post('strInstitucion');
						$datos['id_institucion'] = (int) $this->input->post('IdInstitucion');
						
						$datos['diaNac'] =  $this->input->post('strDia');
						$datos['mesNac'] =  $this->input->post('strMesNac');
						$datos['strMesNac'] = $this->input->post('strMes');
						$datos['anioNac'] = (int) $this->input->post('strAnio');
						$datos['idEntidad'] = (int) $this->input->post('idEntidad');
						$datos['strAcronimoEntidad'] = $this->input->post('strAcronimo');
						$datos['strEntidad'] = $this->input->post('strEntidad');
						$datos['edad'] = (int) $this->input->post('strEdad');
						$datos['strIdGenero'] = (int) $this->input->post('strIdGenero');
						$datos['strGenero'] = $this->input->post('strGenero');
						$datos['strCurp'] = $this->input->post('strCurp');
						
						$aux_tot = $this->m_registro->getBeneficiarioUnico($datos['strCurp']);
						$datos['total_benef'] = $aux_tot[0]['total'];
						
												
						//APLICAR LAS VALIDACIONES NECESARIAS
						
						//tal vez que provenga del formulario de curp, luego vemos que hacer con esta
						
						/*----------------------- CATALOGOS --------------*/    // 			$datos['']=$this->m_registro->get();
						$datos['grupo_etnico']=$this->m_registro->getGrupoEtnico();
						$datos['generacion']=$this->m_registro->getGeneracion();
						$aux=$this->m_registro->getInstitucion($datos['selectInst']);
						$datos['institucion']=$aux[0];
						$datos['plantel']=$this->m_registro->getPlantel($datos['selectInst']);
						$datos['carrera']=$this->m_registro->getCarreraBach();
						$datos['grado']=$this->m_registro->getGradoEscolar($datos['selectInst']);
						
						
						//Inscripcion
						if($datos['id_archivo']==1){
							
							$this->load->view('registro/form_registro', $datos, false);
						}
						
						//Reinscripcion
						if($datos['id_archivo']==2){
							
							//#pagos
							$aux=$this->m_registro->getNoPagosBach($datos['matricula']);
							if ($aux[0]['cuenta']>=30){ 
									
								$datos['sin_ins']=3;
								$this->load->view('registro/sin_inscripcion', $datos, false);
							}
							
							
							$aux=$this->m_registro->getNoPagosUni($datos['matricula']);
							
							if($aux[0]['cuenta']!=0){
								$datos['sin_ins']=4;
								$this->load->view('registro/sin_inscripcion', $datos, false);
							}
							
							if($datos['id_institucion']==$datos['selectInst']){//misma institucion 
								
								$aux=$this->m_registro->getDatosReinscripcion($datos['matricula']);
								$datos['dato']=$aux[0];
								$aux= $this->m_registro->getDelegacion($datos['dato']['id_colonia']);
								$datos['del']=$aux[0];
								$datos['colonias']=$this->m_registro->getColonias($datos['del']['id_delegacion']);
								
								$this->load->view('registro/form_registro_reinscripcion', $datos, false);
							}
							else 
							{
								$datos['sin_ins']=5;
								$this->load->view('registro/sin_inscripcion', $datos, false);
							}
						}
					}
					else
					{
						$datos['heading'] = "Sistema deshabilitado para esta operación";
						$ip_addr = $_SERVER['REMOTE_ADDR'];
						$msg = "&nbsp;&nbsp;&nbsp;  Estas intentando accesar directamente a la aplicación y no está permitido!!!<br /><br />&nbsp;&nbsp;&nbsp;";
						$msg .= "Se ha registrado la IP: <strong>$ip_addr</strong> <br /><br />&nbsp;&nbsp;&nbsp;";
						$msg .= '<a href="http://www.prepasi.df.gob.mx/Inscripcion">Sistema de Registro de Beneficiarios del Programa Prepa Sí</a><br /><br />';
						
						$datos['message'] = $msg;
						
						$this->load->view('errors/html/error_404', $datos, null);
					}
				}
				else
				{
					
					$datos['sin_ins']=1;
					$aux=$this->m_registro->getInstitucion($datos['selectInst']);
					$datos['institucion']=$aux[0];
					$this->load->view('registro/sin_inscripcion', $datos, false);
				}
			}
			else 
			{
				
				if($ejecuta==false)
				{
					$datos['heading'] = "Sistema deshabilitado para esta operación";
					$ip_addr = $_SERVER['REMOTE_ADDR'];
					$msg = "&nbsp;&nbsp;&nbsp;  Estas intentando accesar directamente a la aplicación y no está permitido!!!<br /><br />&nbsp;&nbsp;&nbsp;";
					$msg .= "Se ha registrado la IP: <strong>$ip_addr</strong> <br /><br />&nbsp;&nbsp;&nbsp;";
					$msg .= '<a href="http://www.prepasi.df.gob.mx/Inscripcion">Sistema de Registro de Beneficiarios del Programa Prepa Sí</a><br /><br />';
						
					$datos['message'] = $msg;
						
					$this->load->view('errors/html/error_404', $datos, false);
				}
				else
				{				
					$datos['sin_ins']=2;
					$this->load->view('registro/sin_inscripcion', $datos, false);
				}
			}
			
	}
	
	
	function guardaInscripcion(){
		
		$datos['id_archivo'] =1;
		$datos['id_programa'] =1;
		$datos['id_solicitud']=1;
		
						
		$datos['nombre'] =$this->input->post('nombre');
		$datos['ap_p'] =$this->input->post('ap_p');
		$datos['ap_m'] =$this->input->post('ap_m');
		$datos['curp'] =$this->input->post('curp');
		
		$datos['fecha_nac'] = misql($this->input->post('fecha_nac'));
		
		
		
		$datos['lugar_nac'] =$this->input->post('lugar_nac');
		$datos['edad'] =$this->input->post('edad');
		$datos['sexo'] =(int)$this->input->post('sexo');
		$datos['id_discapacidad'] =(int)$this->input->post('id_discapacidad');
		$datos['id_etnia'] =$this->input->post('id_etnia');
		$datos['id_estado_civil'] =$this->input->post('id_estado_civil');
		$datos['id_hijos'] =$this->input->post('id_hijos');
		$datos['id_ocupacion'] =$this->input->post('id_ocupacion');
		$datos['email'] =$this->input->post('email1');
		
		$datos['id_colonia'] =$this->input->post('id_colonia');
		$datos['cp'] =$this->input->post('id_cp');
		$datos['calle'] =$this->input->post('calle');
		$datos['noext'] =$this->input->post('noext');
		$datos['noint'] =$this->input->post('noint');
		$datos['id_tiempo_residencia'] =$this->input->post('id_residencia');
		$datos['ycalle'] =$this->input->post('ycalle');
		$datos['ecalle'] =$this->input->post('ecalle');
		$datos['edificio'] =$this->input->post('edificio');
		$datos['departamento'] =$this->input->post('departamento');
		$datos['manzana'] =$this->input->post('manzana');
		$datos['lote'] =$this->input->post('lote');
		$datos['rampa'] =$this->input->post('rampa');
		$datos['andador'] =$this->input->post('andador');
		$datos['pasillo'] =$this->input->post('pasillo');
		$datos['villa'] =$this->input->post('villa');
		$datos['entrada'] =$this->input->post('entrada');
		$datos['telefono'] =(int)$this->input->post('telefono');
		$datos['celular'] =(int)$this->input->post('celular');
		
		$aux=$this->m_registro->getUT($datos['id_colonia'],$datos['cp']);
		
		if($aux!=null){
			$datos['id_uts']=$aux[0]['id_ut'];
		}
		else
		{ 
			$datos['id_uts']=0;
		}
		
		$datos['apellidoPadreP'] =$this->input->post('apellidoPadreP');
		$datos['apellidoPadreM'] =$this->input->post('apellidoPadreM');
		$datos['nombrePadre'] 	 =$this->input->post('nombrePadre');
		$datos['apellidoMadreP'] =$this->input->post('apellidoMadreP');
		$datos['apellidoMadreM'] =$this->input->post('apellidoMadreM');
		$datos['nombreMadre'] 	 =$this->input->post('nombreMadre');
	
		$datos['id_institucion'] =$this->input->post('id_institucion');
		$datos['id_plantel'] =$this->input->post('id_plantel');
		$datos['id_carrera'] =$this->input->post('id_carrera');
		$datos['id_generacion'] =$this->input->post('id_ciclo');
		$datos['id_sistema'] =$this->input->post('id_sistema');
		$datos['id_turno'] =$this->input->post('id_turno');
		$datos['promedio'] =$this->input->post('promedio');
		$datos['materias'] =$this->input->post('materias');
		$datos['matricula_escuela'] =$this->input->post('matricula');
		$datos['id_grado'] =$this->input->post('id_grado');
		$aux=$this->input->post('finado_madre');
		
		if($aux=='on'){
			$datos['finado_madre']=1;
		}else{ 
			$datos['finado_madre']=0;
		}
		
		$aux=$this->input->post('finado_padre');
		if($aux=='on'){
			$datos['finado_padre']=1;
		}else{ 
			$datos['finado_padre']=0;
		}
		
		$aux= $this->input->post('es_etnia');
		if($aux=='on'){
			$datos['petnica']=1;
		}else{
			$datos['petnica']=0;
		}
		
		
		
		$in  = str_pad($datos['id_institucion'], 3,0, STR_PAD_LEFT);
		$pla = str_pad($datos['id_plantel'], 3,0, STR_PAD_LEFT);
		$datos['escolar']=$datos['sexo'].$in.$pla;
		
		$datos['inserta']=$this->m_registro->InsertaInscripcion($datos);
	
 		echo trim($datos['inserta']);
		//echo "1";
		                                      
	}
	
	
	
	function guardaReinscripcion(){
		$datos['id_archivo'] =2;
		$datos['id_programa'] =1;
		$datos['id_solicitud']=1;
		
		$datos['nombre'] =$this->input->post('nombre');
		$datos['ap_p'] =$this->input->post('ap_p');
		$datos['ap_m'] =$this->input->post('ap_m');
		$datos['curp'] =$this->input->post('curp');
		$datos['fecha_nac'] =$this->input->post('fecha_nac');
		$datos['lugar_nac'] =$this->input->post('lugar_nac');
		$datos['edad'] =$this->input->post('edad');
		$datos['sexo'] =(int)$this->input->post('sexo');
		$datos['id_discapacidad'] =(int)$this->input->post('id_discapacidad');
		$datos['id_etnia'] =$this->input->post('id_etnia');
		$datos['id_estado_civil'] =$this->input->post('id_estado_civil');
		$datos['id_hijos'] =$this->input->post('id_hijos');
		$datos['id_ocupacion'] =$this->input->post('id_ocupacion');
		$datos['email'] =$this->input->post('email1');
		
		$datos['id_colonia'] =$this->input->post('id_colonia');
		$datos['cp'] =$this->input->post('id_cp');
		$datos['calle'] =$this->input->post('calle');
		$datos['noext'] =(int)$this->input->post('noext');
		$datos['noint'] =$this->input->post('noint');
		$datos['id_tiempo_residencia'] =$this->input->post('id_residencia');
		$datos['ycalle'] =($this->input->post('ycalle'));
		$datos['ecalle'] =($this->input->post('ecalle'));
		$datos['edificio'] =$this->input->post('edificio');
		$datos['departamento'] =$this->input->post('departamento');
		$datos['manzana'] =$this->input->post('manzana');
		$datos['lote'] =$this->input->post('lote');
		$datos['rampa'] =$this->input->post('rampa');
		$datos['andador'] =$this->input->post('andador');
		$datos['pasillo'] =$this->input->post('pasillo');
		$datos['villa'] =$this->input->post('villa');
		$datos['entrada'] =$this->input->post('entrada');
		$datos['celular'] =$this->input->post('celular');
		$datos['telefono'] =$this->input->post('telefono');
		
		$aux=$this->m_registro->getUT($datos['id_colonia'],$datos['cp']);
		if($aux!=null){
			$datos['id_uts']=$aux[0]['id_ut'];
		}
		else 
			$datos['id_uts']=0;
		
		
		$datos['apellidoPadreP'] =($this->input->post('apellidoPadreP'));
		$datos['apellidoPadreM'] =($this->input->post('apellidoPadreM'));
		$datos['nombrePadre'] 	 =($this->input->post('nombrePadre'));
		$datos['apellidoMadreP'] =($this->input->post('apellidoMadreP'));
		$datos['apellidoMadreM'] =($this->input->post('apellidoMadreM'));
		$datos['nombreMadre']  	 =($this->input->post('nombreMadre'));
		
		$datos['id_institucion'] =$this->input->post('id_institucion');
		$datos['id_plantel'] =$this->input->post('id_plantel');
		$datos['id_carrera'] =$this->input->post('id_carrera');
		$datos['id_generacion'] =$this->input->post('id_ciclo');
		$datos['id_sistema'] =$this->input->post('id_sistema');
		$datos['id_turno'] =$this->input->post('id_turno');
		$datos['promedio'] =$this->input->post('promedio');
		$datos['materias'] =$this->input->post('materias');
		$datos['matricula_escuela'] =$this->input->post('matricula');
		$datos['id_grado'] =$this->input->post('id_grado');
		$aux=$this->input->post('finado_madre');
		if($aux=='on'){
			$datos['finado_madre']=1;
		}else
			$datos['finado_madre']=0;
		$aux==$this->input->post('finado_padre');
		if($aux=='on'){
			$datos['finado_padre']=1;
		}else
			$datos['finado_padre']=0;
		$aux= $this->input->post('es_etnia');
		if($aux=='on'){
			$datos['petnica']=1;
		}else
			$datos['petnica']=0;
		$datos['matricula_ps']=$this->input->post('matricula_ps');
		$datos['inserta']=$this->m_registro->UpdateInscripcion($datos);
		echo $datos['inserta'];
		
	}
	function ajaxGetColonias($id_delegacion){
		
		$aux=$this->m_registro->getColonias($id_delegacion);
		$existente=array();
		echo '<option value="0">[Seleccionar]</option>';
		
		foreach ($aux as $colonia){
				$cp = $colonia['cp'];
				$col = $this->limpia_cadena($colonia['colonia']);
				$cad =$cp."|".$col;
				if(!in_array($cad,$existente))
				{
					
					$existente[] = $cad;
					
					echo "<option value='".$colonia['id_colonia']."'>[".$colonia['cp']."] - ".$colonia['colonia']."</option>";
				}
// 				else
// 				{
					
// 					echo '<option value="-1">- no valido -</option>';
					
// 				}
				
				
			}
			
		
		echo '</select>';
		
		
	}
	function limpia_cadena($string)
	{
		$string = trim($string);
	
		$string = str_replace(
				array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
				array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
				$string
		);
	
		$string = str_replace(
				array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
				array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
				$string
		);
	
		$string = str_replace(
				array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
				array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
				$string
		);
	
		$string = str_replace(
				array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
				array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
				$string
		);
	
		$string = str_replace(
				array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
				array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
				$string
		);
	
		$string = str_replace(
				array('ñ', 'Ñ', 'ç', 'Ç'),
				array('n', 'N', 'c', 'C',),
				$string
		);
	
		return $string;
	}
}


?>
