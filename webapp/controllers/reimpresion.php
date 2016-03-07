<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reimpresion extends CI_Controller {

	public function __construct() {
		parent::__construct();
	
			
		$this->load->model('m_reimpresion');
		$this->load->helper('my_date_helper');
	}
	public function index()
	{
		$id_modulo=3;
		$datos['title']='Reimpresión de Documentos';
		$hoy=new DateTime(fecha_actual());
		$aux=$this->m_reimpresion->getModuloActivo($id_modulo);
		$inicio=new DateTime($aux[0]['inicio']);
		$fin = new DateTime($aux[0]['fin']);
		
			
		if ($hoy >= $inicio && $hoy <=$fin){
			$this->load->view('layout/header', $datos, false);
			$this->load->view('reimpresion_bach/busca_beneficiario', true, false);
			$this->load->view('layout/footer', false, false);
		}
		else{
			$datos['sin_ins']=2;
			$this->load->view('layout/header', $datos, false);
			$this->load->view('reimpresion_bach/sin_registro', $datos, false);
			$this->load->view('layout/footer', false, false);
		}
		
	}
	
	function ajax_beneficiario_matricula(){
		
		
		$matricula =  $this->input->post('matricula');
		
		
		$aux=$this->m_reimpresion->getMatricula($matricula);
		
		if($aux!=null)
		{
			echo $matricula = $aux[0]['matricula_asignada'];
		}
		else
		{
			echo 'bad';
		}
	}
	function ajax_beneficiario_unam(){
		
		$matricula =  $this->input->post('matricula_escuela');
		
		
		$aux=$this->m_reimpresion->getMatriculaUnam($matricula);
		
		if($aux!=null)
		{
			echo $matricula = $aux[0]['matricula_asignada'];
		}
		else
		{
			echo 'bad';
		}
	}
	function buscaBeneficiario($matricula){
		
		$aux = $this->m_reimpresion->getIdentificacion($matricula);
    	$data['identificacion'] = $aux[0];
    	$datos['title']='Reimpresión de Documentos';
    	
    	if($data['identificacion']['id_archivo']==2 || $data['identificacion']['id_archivo']==1){
    		
    		$data['direccion']=0;
    		$data['escolar']=0;
    		
    		
    		$aux = $this->m_reimpresion->getDireccion($matricula);
    		if($aux!=null){
	    		$data['direccion'] = $aux[0];
    		}
	    	$aux = $this->m_reimpresion->getEscolarBach($matricula);
	    	if($aux!= null){
	    		$data['escolar'] = $aux[0];
	    	}
	    	
	    	$data['matricula']=$matricula;
	    	$this->load->view('layout/header', $datos, false);
	    	$this->load->view('reimpresion_bach/v_datos', $data, false);
	    	$this->load->view('layout/footer', false, false);
	    }
	    else if($data['identificacion']['id_archivo']==3)
	    { 
	    	$datos['sin_ins']=3;
	    	$this->load->view('layout/header', $datos, false);
	    	$this->load->view('reimpresion_bach/sin_registro', $datos, false);
	    	$this->load->view('layout/footer', false, false);
	    }
	    else
	    {
	    	$datos['sin_ins']=1;
	    	$this->load->view('layout/header', $datos, false);
	    	$this->load->view('reimpresion_bach/sin_registro', $datos, false);
	    	$this->load->view('layout/footer', false, false);
	    }
	}
	
	
	function pdf(){
		$data['matricula']= $this->input->post('matricula');
		$data['nombre']= $this->input->post('nombre');
		$data['paterno']= $this->input->post('paterno');
		$data['materno']= $this->input->post('materno');
		$data['fecha_carga']= $this->input->post('fecha_carga');
		$data['id_archivo']= $this->input->post('id_archivo');
		$data['curp']= $this->input->post('curp');
		
		$data['correo']= $this->input->post('correo');
		$data['tel']= $this->input->post('tel');
		
		
		$data['institucion']= $this->input->post('institucion');
		$data['plantel']= $this->input->post('plantel');
		
		$data['grado']= $this->input->post('grado');
		$data['turno']= $this->input->post('turno');
		$data['promedio']= $this->input->post('promedio');
		$data['modalidad']= $this->input->post('sistema');
		
		$data['padre']= $this->input->post('padre');
		$data['madre']= $this->input->post('madre');
		$data['ecivil']= $this->input->post('e_civil');
		$data['sexo']= $this->input->post('sexo');
		$data['fecha_nac']= $this->input->post('fecha_nac');
		
		//$data['']= $this->input->post('');
		$data['cel']= $this->input->post('cel');
		if ($data['cel']=='')
			$data['cel']='----';
		$data['calle']= $this->input->post('calle');
		if ($data['calle']=='')
			$data['calle']='----';
		$data['noext']= $this->input->post('noext');
		if ($data['noext']=='')
			$data['noext']='----';
		$data['noint']= $this->input->post('noint');
		if ($data['noint']=='')
			$data['noint']='----';
		$data['manzana']= $this->input->post('manzana');
		if ($data['manzana']=='')
			$data['manzana']='----';
		$data['lote']= $this->input->post('lote');
		if ($data['lote']=='')
			$data['lote']='----';
		$data['noedif']= $this->input->post('noedif');
		if ($data['noedif']=='')
			$data['noedif']='----';
		$data['nodpto']= $this->input->post('nodpto');
		if ($data['nodpto']=='')
			$data['nodpto']='----';
		$data['andador']= $this->input->post('andador');
		if ($data['andador']=='')
			$data['andador']='----';
		$data['rampa']= $this->input->post('rampa');
		if ($data['rampa']=='')
			$data['rampa']='----';
		$data['pasillo']= $this->input->post('pasillo');
		if ($data['pasillo']=='')
			$data['pasillo']='----';
		$data['villa']= $this->input->post('villa');
		if ($data['villa']=='')
			$data['villa']='----';
		$data['entrada']= $this->input->post('entrada');
		if ($data['entrada']=='')
			$data['entrada']='----';
		$data['colonia']= $this->input->post('colonia');
		if ($data['colonia']=='')
			$data['colonia']='----';
		$data['delegacion']= $this->input->post('delegacion');
		if($data['delegacion']=='')
			$data['delegacion']='----';
		$data['cp']= $this->input->post('cp');
		if($data['cp']=='')
			$data['cp']='----';
		$this->load->library('Pdf');
		$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Cony Jaramillo');
		$pdf->SetTitle('Documentos Prepa Si');
		$pdf->SetSubject('Reimpresión de Documentos');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

		ob_start();
		//remove default header/footer
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		// set default header data
		
		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
				
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		///////////////////////////////////////////////////---------------///////////////////////////////////////////////////
		///////////////////////////////////////////////////FORMATO ENTREGA///////////////////////////////////////////////////
		///////////////////////////////////////////////////---------------///////////////////////////////////////////////////
		// establecer el modo de fuente por defecto
		$pdf->setFontSubsetting(true);
		
		// Establecer el tipo de letra
		
		$pdf->SetFont('helvetica', '', 10); //Normal
		$arriba = 6;
		$izq = 10;
		$der = 10;
		
		$pdf->AddPage('L','LETTER');

		$pdf->SetFont('pdfahelvetica', '', 10); //Normal
		//$pdf->SetFont('pdfahelveticai', '', 10); // S
		$pdf->SetTextColor(0,0,0);
		$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,20,5,10', 'phase' => 10, 'color' => array(255, 0, 0));
		$style2 = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style3 = array('width' => 0.2, 'cap' => 'round', 'join' => 'round', 'dash' => '2,10', 'color' => array(0, 0, 0));
		$style4 = array('L' => 0,
				'T' => array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '20,10', 'phase' => 10, 'color' => array(100, 100, 255)),
				'R' => array('width' => 0.50, 'cap' => 'round', 'join' => 'miter', 'dash' => 0, 'color' => array(50, 50, 127)),
				'B' => array('width' => 0.75, 'cap' => 'square', 'join' => 'miter', 'dash' => '30,10,5,10'));
		$style5 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 64, 128));
		$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,10', 'color' => array(0, 128, 0));
		$style7 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 128, 0));
		
		# Marco
		//$pdf->RoundedRect(5, 15-$arriba, 268, 200, 0, '1010', 'NULL');
		$pdf->RoundedRect(12, 15-$arriba, 120, 200, 0, '1000', 'NULL');
		$pdf->RoundedRect(23+125, 15-$arriba, 120, 200, 0, '1000', 'NULL');
		# Linea encabezado
		//$pdf->Line(15, 44, 264.4, 44, $style2);
		# Linea media punteada
		$pdf->Line(140, 5-$arriba, 140, 210+$arriba, $style3);
		
		# Logos de Encabezado
		$pdf->Image('resources/img/cdmx.png', 85-$izq, 20-$arriba, 50, 13, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		# Textos
		$pdf->Text(60-$izq, 10-$arriba, 'Formato para Prepa Sí');
		
		$pdf->SetFont('pdfahelveticab',	'', 9);	// Negrita
		$pdf->Text(35-$izq, 40-$arriba, 'Entrega – Recepción Documentos PREPA SÍ 2015-2016');
		
		$pdf->SetFont('pdfahelvetica',	'', 9);	// Normal
		$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		$pdf->RoundedRect(34-$izq, 39-$arriba, 87, 6, 3, '0000', 'NULL');
		
		$pdf->Text(44-$izq, 51-$arriba, 'Fecha de registro electrónico: ___________________');
		$pdf->Text(27-$izq, 62-$arriba, 'Nombre: ____________________________________________________');
		
		$pdf->Text(27-$izq, 72-$arriba, '1.- Solicitud de');
		$pdf->RoundedRect(126-$izq, 72-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(27-$izq, 80-$arriba, '2.- Comprobante de domicilio, expedido dentro de los 3 meses');
		$pdf->Text(33-$izq, 84-$arriba, 'anteriores al mes en el que se realice la entrega de los');
		$pdf->Text(33-$izq, 88-$arriba, 'documentos (copia y original para cotejo):.....................................');
		$pdf->RoundedRect(126-$izq, 88-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(27-$izq, 96-$arriba, '3.- Comprobante de Inscripcion (vigente), sellado por tu');
		$pdf->Text(32-$izq, 100-$arriba, ' institución educativa (copia y original para cotejo):........................');
		$pdf->RoundedRect(126-$izq, 100-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(27-$izq, 108-$arriba, '4.- Comprobante de calificaciones vigente y sellado');
		$pdf->Text(32-$izq, 112-$arriba, '(copia y original para cotejo):...........................................................');
		$pdf->RoundedRect(126-$izq, 112-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(27-$izq, 120-$arriba, '5.- Identificación con fotografia (copia y original para cotejo):..............');
		$pdf->RoundedRect(126-$izq, 121-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(48-$izq, 167-$arriba, 'Fecha de recepción de expediente: ___________________');
		$pdf->Text(115-$izq, 171-$arriba, 'día/mes/año');
		
		
		$pdf->SetFont('pdfahelveticab', '', 8); //Negrita
		$pdf->Rect(25-$izq, 161+15-$arriba, 115, 16, 'DF', null, array(192,192,192));
		
		$pdf->Text(25-$izq, 161+15-$arriba, 'Tus documentos y datos, seran revisados en oficinas centrales. Si se detecta alguna');
		$pdf->Text(25-$izq, 165+15-$arriba, 'inconsistencia no procederá tu tramite en tanto no regularices la situación. Te lo');
		$pdf->Text(25-$izq, 169+15-$arriba, 'notificaremos vía correo electrónico, por lo que consúltalo regularmente, ya que de');
		$pdf->Text(25-$izq, 173+15-$arriba, 'no regularizarlo no podremos incorporarte al programa.');
		
		$pdf->SetFont('pdfahelvetica',	'', 9);	// Normal
		
		$pdf->endLayer();
		
		
		//***********************************************************hoja 2**********************************************************//////////
		
		# Logos de Encabezado
		$pdf->Image('resources/img/cdmx.png', 117+85+$der, 20-$arriba, 50, 13, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		# Textos
		$pdf->Text(127+55+$der, 10-$arriba, 'Formato para el Beneficiario');
		$pdf->SetFont('pdfahelveticab',	'', 9);	// Negrita
		$pdf->Text(114+45+$der, 40-$arriba, 'Entrega – Recepción Documentos PREPA SÍ 2015-2016');
		$pdf->SetFont('pdfahelvetica',	'', 9);	// Normal
		$pdf->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		$pdf->RoundedRect(158+$der, 39-$arriba, 87, 6, 3, '0000', 'NULL');
		
		$pdf->Text(115+50+$der, 51-$arriba, 'Fecha de registro electrónico: ___________________');
		$pdf->Text(115+27+$der, 62-$arriba, 'Nombre: ____________________________________________________');
		
		$pdf->Text(115+27+$der, 72-$arriba, '1.- Solicitud de');
		$pdf->RoundedRect(105+136+$der, 72-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(115+27+$der, 80-$arriba, '2.- Comprobante de domicilio, expedido dentro de los 3 meses');
		$pdf->Text(115+33+$der, 84-$arriba, 'anteriores al mes en el que se realice la entrega de los');
		$pdf->Text(115+33+$der, 88-$arriba, 'documentos (copia y original para cotejo):.....................................');
		$pdf->RoundedRect(105+136+$der, 88-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(115+27+$der, 96-$arriba, '3.- Comprobante de Inscripcion (vigente), sellado por tu');
		$pdf->Text(115+32+$der, 100-$arriba, 'institución educativa (copia y original para cotejo):.........................');
		$pdf->RoundedRect(105+136+$der, 100-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(115+27+$der, 108-$arriba, '4.- Comprobante de calificaciones vigente y sellado');
		$pdf->Text(115+32+$der, 112-$arriba, '(copia y original para cotejo):...........................................................');
		$pdf->RoundedRect(105+136+$der, 112-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(115+27+$der, 120-$arriba, '5.- Identificación con fotografia (copia y original para cotejo):..............');
		$pdf->RoundedRect(105+136+$der, 121-$arriba, 8, 5, 3, '0000', 'NULL');
		
		$pdf->Text(110+55+$der, 167-$arriba, 'Fecha de recepción de expediente: ___________________');
		$pdf->Text(110+122+$der, 171-$arriba, 'día/mes/año');
		
		if($data['id_archivo']==1){
			$pdf->SetFont('pdfahelvetica', '', 9);
			//$pdf->Text(17, 148+16, 'Entregó expediente _____________________________      ____________');
			$pdf->Text(27-$izq, 128+17-$arriba, 'Entregó expediente _____________________________     ____________');
			$pdf->SetFont('pdfahelvetica', '', 8);
			$pdf->Text(78-$izq, 132+17-$arriba, 'Nombre');
			$pdf->Text(118-$izq, 132+17-$arriba, 'Firma');
			$pdf->SetFont('pdfahelvetica', '', 9);
			//$pdf->Text(17, 136+16, 'Recibió / Cotejó: _______________________________      ____________');
			$pdf->Text(27-$izq, 140+16-$arriba, 'Recibió / Cotejó: _______________________________     ____________');
			$pdf->SetFont('pdfahelvetica', '', 8);
			$pdf->Text(78-$izq, 146+14-$arriba, 'Nombre');
			$pdf->Text(118-$izq, 146+14-$arriba, 'Firma');
		
			$pdf->SetFont('pdfahelvetica', '', 9);
			//$pdf->Text(124+17, 148+16, 'Entregó expediente _____________________________      ____________');
			$pdf->Text(27+115+$der, 128+17-$arriba, 'Entregó expediente _____________________________     ____________');
			$pdf->SetFont('pdfahelvetica', '', 8);
			$pdf->Text(78+115+$der, 132+17-$arriba, 'Nombre');
			$pdf->Text(118+115+$der, 132+17-$arriba, 'Firma');
			$pdf->SetFont('pdfahelvetica', '', 9);
			//$pdf->Text(124+17, 136+16, 'Recibió / Cotejó: _______________________________      ____________');
			$pdf->Text(27+115+$der, 140+16-$arriba, 'Recibió / Cotejó: _______________________________     ____________');
			$pdf->SetFont('pdfahelvetica', '', 8);
			$pdf->Text(78+115+$der, 144+16-$arriba, 'Nombre');
			$pdf->Text(118+115+$der, 144+16-$arriba, 'Firma');
		
		}else{
			$pdf->Text(27-$izq, 136-$arriba, 'Entregó expediente _____________________________     ____________');
			$pdf->Text(78-$izq, 140-$arriba, 'Nombre');
			$pdf->Text(118-$izq, 140-$arriba, 'Firma');
		
			$pdf->Text(27-$izq, 149+3-$arriba, 'Recibió / Cotejó: _______________________________     ____________');
			$pdf->Text(78-$izq, 154+3-$arriba, 'Nombre');
			$pdf->Text(118-$izq, 154+3-$arriba, 'Firma');
		
			$pdf->Text(27+115+$der, 136-$arriba, 'Entregó expediente _____________________________     ____________');
			$pdf->Text(78+115+$der, 140-$arriba, 'Nombre');
			$pdf->Text(118+115+$der, 140-$arriba, 'Firma');
		
			$pdf->Text(27+115+$der, 149+3-$arriba, 'Recibió / Cotejó: _______________________________     ____________');
			$pdf->Text(78+115+$der, 154+3-$arriba, 'Nombre');
			$pdf->Text(118+115+$der, 154+3-$arriba, 'Firma');
		
		}
		
		$pdf->SetFont('pdfahelveticab', '', 8); //Negrita
		$pdf->Rect(125+16+$der, 161+15-$arriba, 115, 16, 'DF', null, array(192,192,192));
		//$pdf->Rect(25-$izq, 163+15-$arriba, 115, 16, 'DF', null, array(192,192,192));
		$pdf->Text(125+16+$der, 161+15-$arriba, 'Tus documentos y datos, seran revisados en oficinas centrales. Si se detecta alguna');
		$pdf->Text(125+16+$der, 165+15-$arriba, 'inconsistencia no procederá tu tramite en tanto no regularices la situación. Te lo');
		$pdf->Text(125+16+$der, 169+15-$arriba, 'notificaremos vía correo electrónico, por lo que consúltalo regularmente, ya que de');
		$pdf->Text(125+16+$der, 173+15-$arriba, 'no regularizarlo no podremos incorporarte al programa.');
		
		$pdf->Text(125-$izq, 189, 'F-1516-01');
		$pdf->Text(125+116+$der,189, 'F-1516-01');
		
		
		$pdf->SetFont('pdfahelvetica',	'', 9);	// Normal
		
		
		
		///////////////////////////////////////////////////////
		//	Datos de ENTREGA RECEPCION DE DOCUMENTOS
		///////////////////////////////////////////////////////
		$pdf->SetFont('pdfahelvetica',	'', 9);	// Normal
		if($data['id_archivo']==1){
			$tramite = "Inscripción";
			$puntos = "................................................";
			$pdf->Text(27-$izq, 128-$arriba, '6.- Número de Monedero Electrónico (Tarjeta Prepa Sí):');
			$pdf->Text(118+24+$der, 128-$arriba, '6.- Número de Monedero Electrónico (Tarjeta Prepa Sí):');
		
			$pdf->Line(27-$izq, 140-$arriba, 126, 140-$arriba, $style2);
		
			$pdf->Line(120+24+$der, 140-$arriba, 145+116, 140-$arriba, $style2);
		
		
			//	$pdf->RoundedRect(20, 128, 60, 5, 3, '0000', 'NULL');
		
			$pdf->SetFont('pdfahelvetica',	'', 9);
			$pdf->Text(27-$izq, 140+9-$arriba, 'y Recibió Tarjeta');
			$pdf->Text(124+18+$der, 140+9-$arriba, 'y Recibió Tarjeta');
		}
		
		if($data['id_archivo']==2){
			$tramite = "Reinscripción";
			$puntos = "............................................";
		
		}
		if($data['id_archivo']==3){
			$tramite = "Universitario";
			$puntos = "..............................................";
		
		}
		$estilo = array('padding'=>'auto' );
		
		//Negrita
		$pdf->SetFont('pdfahelveticab', '', 8);
		$pdf->Text(87-$izq, 51-$arriba, fecha_con_letra($data['fecha_carga']));
		$pdf->SetFont('pdfahelveticab', '', 9);
		$pdf->Text(42-$izq, 62-$arriba, $data['paterno'].' '.$data['materno'].' '.$data['nombre']);
		$pdf->SetFont('pdfahelvetica', '', 9);
		$pdf->Text(49-$izq, 72-$arriba, $tramite.' (impresión):'.$puntos);
		
		$pdf->SetFont('pdfahelveticab', '', 8);
		$pdf->Text(65, 192, $data['matricula']);
		$pdf->endLayer();
		$pdf->Text(124+84+$der, 45, fecha_con_letra($data['fecha_carga']));
		$pdf->Text(124+32+$der, 62-$arriba, $data['paterno'].' '.$data['materno'].' '.$data['nombre']);
		
		$pdf->SetFont('pdfahelvetica', '', 9);
		$pdf->Text(164+$der, 72-$arriba, $tramite.' (impresión):'.$puntos);
		$pdf->SetFont('pdfahelveticab', '', 8);
		$pdf->Text(124+70+$der, 192, $data['matricula']);
		$pdf->endLayer();
		
		$pdf->write1DBarcode($data['matricula'], 'C128', 65-$izq, 184,50, 10, 0.4, $estilo, 'N');
		$pdf->Image('resources/img/logo_fide_ps.jpg', 26-$izq, 187, 21, 8, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		$pdf->write1DBarcode($data['matricula'], 'C128', 112+70+$der, 184, 50, 10, 0.4, $estilo, 'N');
		$pdf->Image('resources/img/logo_fide_ps.jpg', 125+18+$der, 187, 21, 8, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		///////////////////////////////////////////////////---------------///////////////////////////////////////////////////
		///////////////////////////////////////////////////DATOS PERSONALES//////////////////////////////////////////////////
		///////////////////////////////////////////////////---------------///////////////////////////////////////////////////
		$bajar=3;
		
		$pdf->AddPage('P','LETTER');
		//$fontname = $pdf->addTTFfont('./font/DejaVuSans.ttf', 'TrueTypeUnicode', '', 32);
		
		//$pdf->SetFont('dejavusans', '', 10);
		//$pdf->SetFont('pdfahelveticab', '', 10); //Negrita
		$pdf->SetFont('pdfahelvetica', '', 9); //Normal
		//$pdf->SetFont('pdfahelveticai', '', 10); // S
		$pdf->SetTextColor(0,0,0);
		$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,20,5,10', 'phase' => 10, 'color' => array(255, 0, 0));
		$style2 = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style3 = array('width' => 0.5, 'cap' => 'round', 'join' => 'round', 'dash' => '2,10', 'color' => array(0, 0, 0));
		$style4 = array('L' => 0,
				'T' => array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '20,10', 'phase' => 10, 'color' => array(100, 100, 255)),
				'R' => array('width' => 0.50, 'cap' => 'round', 'join' => 'miter', 'dash' => 0, 'color' => array(50, 50, 127)),
				'B' => array('width' => 0.75, 'cap' => 'square', 'join' => 'miter', 'dash' => '30,10,5,10'));
		$style5 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 64, 128));
		$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,10', 'color' => array(0, 128, 0));
		$style7 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 128, 0));
		
		# Imagenes del Encabezado
		//-$pdf->Image('../images/angel2.jpg', 15, 6, 23, 23, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		//-$pdf->Image('../images/fideicomiso.jpg', 38, 6, 23, 23, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		//-$pdf->Image('../images/prepasi.png', 180, 6, 21, 23, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		$pdf->Image('resources/img/cdmx.png', 153, 8, 50, 13, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		//$pdf->SetFontSize(7);
		$pdf->SetFont('pdfahelvetica', '', 7); //Normal
		
		// create some HTML content
		$html = '
		
<div align="justify"><br /><br /><br /><br /><br /><br />
  <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="justify">Yo '.$data['nombre']." ".$data['paterno']." ".$data['materno'].' declaro bajo protesta o exhorto de decir verdad que <b>NO CUENTO CON OTRA BECA </b>y/o ayuda igual o similar a la que por este   medio pido me otorgue <b>Prepa Sí</b> (FIDEGAR). <br />
        <br />
        <br />
        <br />
      Así mismo, manifiesto mi voluntad de contribuir con el programa Prepa Sí, para lo cual estoy dispuesto y <b>ME COMPROMETO A PARTICIPAR EN ACTIVIDADES EN COMUNIDAD </b>durante el periodo en el que el estímulo me sea otorgado. </div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <br />
  </table>
  <p><br />
    <br /><br /><br /><br />
    Los datos personales recabados serán protegidos, incorporados y tratados en el sistema denominado Sistema de Datos Personales del Programa <b>Prepa Sí</b> del Fideicomiso Educación Garantizada del Distrito Federal (FIDEGAR), lo cual se funda en los artículos 6, 7 y demás relativos de la Ley de Protección de Datos Personales para el D. F, con el  fin de verificar que se cumplan las Reglas de Operación del Programa e integrar la base de datos de los beneficiarios de éste.
    <br /><br />
    Los datos marcados con asterisco (*) son obligatorios. Sin ellos no podrás acceder al Programa. Tus datos no podrán ser difundidos sin tu conocimiento expreso, salvo la excepciones previstas en la Ley.  La responsable del Sistema de Datos Personales es Mónica Pérez Egüis, Subdirectora de Control de Entregas e Incidencias. El lugar  donde podrás ejercer los derechos de acceso, rectificación, cancelación y oposición, así como la renovación del consentimiento es la Oficina de Información Pública del FIDEGAR, ubicada en Ejército Nacional N° 359, Col. Granada, Delegación Miguel Hidalgo, D.F. C.P.11520. <b>Tel. 11021730 ext.4079. Pág. web: www.fideicomisoed.df.gob.mx y e-mail oip@fideicomisoed.df.gob.mx. </b>El interesado podrá dirigirse al Instituto de Acceso a la Información Pública del D. F., donde recibirá asesoría sobre los derechos que tutela la Ley de Protección de Datos Personales, al tel.56534636; correo  datos.personales@infodf.org.mx o www.infodf.org.mx. En tal virtud, con base en el art. 16 de la Ley de Protección de Datos Personales para el D. F. <b>otorgo mi consentimiento para que mis datos personales tengan un tratamiento sólo para los fines del Programa Prepa Sí </b>durante el tiempo en cual me encuentre inscrito(a).<br>
    <br>
    <br>
  <em>
  <br>
  </em></p>
</div>
<div align="center"><em><br>Este programa es de carácter público, no es patrocinado ni promovido por partido político alguno y  sus recursos provienen de los impuestos que pagan todos los contribuyentes. Está  prohibido el uso de este programa con fines políticos, electorales, de lucro y  otros distintos a los establecidos. Quien haga uso indebido de los recursos de  este programa en el Distrito Federa, será sancionado de acuerdo con la ley  aplicable y ante la autoridad competente</em></div>
		
		
';
		// output the HTML content
		$pdf->writeHTML($html, true, 0, true, 0);
		
		##############################################################################
		# SOLICITUD DE INSCRIPCIÓN
		##############################################################################
		
		$pdf->SetFont('pdfahelveticab', '', 9); //Negrita
		
		$pdf->Text(15, 8, 'GOBIERNO DEL DISTRITO FEDERAL');
		$pdf->Text(15, 12, 'FIDEICOMISO EDUCACIÓN GARANTIZADA');
		$pdf->Text(15, 16, 'PROGRAMA DE ESTÍMULOS PARA EL BACHILLERATO UNIVERSAL');
		if ($data['id_archivo']==1){
			$tipo = "INSCRIPCION";
		}
		if ($data['id_archivo']==2){
			$tipo = "REINSCRIPCION";
		}
		if ($data['id_archivo']==3){
			$tipo = "UNIVERSITARIO";
		}
		$pdf->Text(88, 20, 'SOLICITUD DE '.$tipo.'');
		$pdf->SetFont('pdfahelvetica', '', 10); //Normal
		$pdf->SetFontSize(10);
		
		
		$pdf->Text(15, 25, 'FECHA DE TRAMITE:');
		$pdf->RoundedRect(55, 25, 50, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(150, 25, 51, 5, 3, '0000', 'NULL');
		
		$pdf->SetFontSize(7);
		$pdf->Text(170, 30, '*CURP');
		
		$pdf->SetFontSize(10);
		$pdf->SetTextColor(0, 100, 50, 0);
		$pdf->Text(15, 31, '1.- IDENTIFICACIÓN:');
		$pdf->SetTextColor(0, 0, 0, 100);
		$pdf->RoundedRect(15, 36, 60, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(78, 36, 60, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(141, 36, 60, 5, 3, '0000', 'NULL');
		$pdf->SetFontSize(7);
		$pdf->Text(34, 41, '*Apellido Paterno');
		$pdf->Text(95, 41, '*Apellido Materno');
		$pdf->Text(165, 41, '*Nombre(s)');
		
		$pdf->RoundedRect(15, 45, 60, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(78, 45, 60, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(141, 45, 60, 5, 3, '0000', 'NULL');
		$pdf->SetFontSize(7);
		$pdf->Text(34, 50, '*Correo electrónico');
		$pdf->Text(96, 50, '*Teléfono particular');
		$pdf->Text(163, 50, '*Teléfono celular');
		
		
		$pdf->RoundedRect(15, 54, 90, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(110, 54, 90, 5, 3, '0000', 'NULL');
		
		$pdf->SetFontSize(7);
		$pdf->Text(38, 59, 'Nombre del padre');
		$pdf->Text(114, 59, 'Nombre de la madre');
		
		
		
		$pdf->SetFontSize(10);
		$pdf->SetTextColor(0, 100, 50, 0);
		$pdf->Text(15, 57+$bajar+2, '2.- DOMICILIO:');
		$pdf->SetTextColor(0, 0, 0, 100);
		$pdf->RoundedRect(15, 62+$bajar+2, 96, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(112, 62+$bajar+2, 17, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(130, 62+$bajar+2, 17, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(148, 62+$bajar+2, 17, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(166, 62+$bajar+2, 17, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(184, 62+$bajar+2, 17, 5, 3, '0000', 'NULL');
		
		$pdf->SetFontSize(7);
		$pdf->Text(60, 67+$bajar+2, '*Calle');
		$pdf->Text(111, 67+$bajar+2, '*No Exterior');
		$pdf->Text(131, 67+$bajar+2, 'No Interior');
		$pdf->Text(150, 67+$bajar+2, 'Manzana');
		$pdf->Text(171, 67+$bajar+2, 'Lote');
		$pdf->Text(185, 67+$bajar+2, 'No Edificio');
		$pdf->RoundedRect(15, 72+$bajar+2, 16, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(32, 72+$bajar+2, 16, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(49, 72+$bajar+2, 16, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(66, 72+$bajar+2, 16, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(83, 72+$bajar+2, 16, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(100, 72+$bajar+2, 16, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(117, 72+$bajar+2, 84, 5, 3, '0000', 'NULL');
		$pdf->Text(16, 77+$bajar+2, 'No Depto');
		$pdf->Text(33, 77+$bajar+2, 'Andador');
		$pdf->Text(51, 77+$bajar+2, 'Rampa');
		$pdf->Text(69, 77+$bajar+2,  'Pasillo');
		$pdf->Text(87, 77+$bajar+2,  'Villa');
		$pdf->Text(102, 77+$bajar+2, 'Entrada');
		$pdf->Text(152, 77+$bajar+2,  '*Colonia');
		$pdf->RoundedRect(15, 82+$bajar+2, 86, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(102, 82+$bajar+2, 25, 5, 3, '0000', 'NULL');
		$pdf->Text(51, 87+$bajar+2, '*Delegacion');
		$pdf->Text(104, 87+$bajar+2, '*Código Postal');
		//$pdf->RoundedRect(15, 69, 95, 4, 3, '0000', 'NULL');
		
		
		
		$pdf->SetFontSize(10);
		$pdf->SetTextColor(0, 100, 50, 0);
		$pdf->Text(15, 92+$bajar+2, '3.- DATOS ESCOLARES:');
		$pdf->SetTextColor(0, 0, 0, 100);
		$pdf->RoundedRect(15, 97+$bajar+2, 95, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(111, 97+$bajar+2, 90, 5, 3, '0000', 'NULL');
		
		$pdf->SetFontSize(7);
		$pdf->Text(51, 102+$bajar+2, '*Institución');
		$pdf->Text(155, 102+$bajar+2,  '*Plantel');
		$pdf->RoundedRect(15, 107+$bajar+2, 67, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(83, 107+$bajar+2, 40, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(124, 107+$bajar+2, 46, 5, 3, '0000', 'NULL');
		$pdf->RoundedRect(171, 107+$bajar+2, 30, 5, 3, '0000', 'NULL');
		$pdf->Text(47, 112+$bajar+2, 'Grado');
		$pdf->Text(98, 112+$bajar+2, 'Turno');
		$pdf->Text(139, 112+$bajar+2, 'Modalidad');
		$pdf->Text(179, 112+$bajar+2, 'Promedio');
		
		$pdf->SetFont('pdfahelveticab', '', 9); //Negrita
		$pdf->Text(35, 117+$bajar, 'La inscripción al Programa de Estímulos para el Bachillerato Universal (en lo sucesivo Prepa Sí)');
		$pdf->Text(39, 121+$bajar, 'queda sujeta al cumplimiento de los requisitos de la Convocatoria y la verificación de datos.');
		$pdf->Text(15, 127+$bajar, 'Tu trámite quedará invalidado:');
		$pdf->SetFont('pdfahelvetica', '', 9); //Normal
		$pdf->Text(15, 132+$bajar, '• Si la institución educativa en la que te inscribiste no coincide con la que indicaste en tu hoja de registro.');
		$pdf->Text(15, 136+$bajar, '• Si el promedio que señalaste no corresponde con tu comprobante de calificaciones.');
		$pdf->Text(15, 140+$bajar, '• Si eres ');
		$pdf->SetFont('pdfahelveticab', '', 9); //Negrita
		$pdf->Text(28, 140+$bajar, 'Prepa Sí ');
		$pdf->SetFont('pdfahelvetica', '', 9); //Normal
		$pdf->Text(42, 140+$bajar, 'y te registraste como Universitario');
		$pdf->SetFont('pdfahelveticab', '', 9); //Negrita
		$pdf->Text(91, 140+$bajar, 'Prepa Sí');
		$pdf->SetFont('pdfahelvetica', '', 9); //Normal
		$pdf->Text(105, 140+$bajar, 'o viceversa.');
		
		//$pdf->RoundedRect(15, 104+15+2, 45, 5, 3, '0000', 'NULL');
		
		//$pdf->SetFont('pdfahelveticai', '', 6); // S
		$pdf->SetFont('pdfahelveticabi', '', 6); // S N
		
		$pdf->Text(140, 157+$bajar+2, 'Firma del alumno o alumna');
		$pdf->Text(140, 173+$bajar+2, 'Firma del alumno o alumna');
		# Linea para firma
		$pdf->Line(120, 157+$bajar+2, 190, 157+$bajar+2, $style2);
		$pdf->Line(120, 173+$bajar+2, 190, 173+$bajar+2, $style2);
		$pdf->SetFont('pdfahelveticab', '', 9); //Negrita
		$pdf->Text(27, 220+$bajar, 'He leído, comprendo y acepto los términos y condiciones generales establecidas en este documento:');
		$pdf->SetFont('pdfahelvetica', '', 9); //Normal
		$pdf->SetFont('pdfahelveticabi', '', 6); // S N
		$pdf->Text(32, 232+$bajar, 'Firma del padre/madre o tutor');
		$pdf->Text(24, 234+$bajar, '(En caso que el alumno(a) sea menor de edad)');
		
		$pdf->Text(140, 232+$bajar, 'Firma del alumno o alumna');
		$pdf->SetFont('pdfahelveticab', '', 8); //Negrita
		//$pdf->Text(79, 229, 'Firma del padre/madre o tutor');
		$pdf->Line(23, 232+$bajar, 75, 232+$bajar, $style2);
		$pdf->Line(120, 232+$bajar, 190, 232+$bajar, $style2);
		$pdf->SetFont('pdfahelvetica', '', 9); //Normal
		
		///////////////////////////////////////////////////////
		//	Datos de DATOS PERSONALES
		///////////////////////////////////////////////////////
		$pdf->SetFont('pdfahelveticab', '', 10); //Negrita
		//$pdf->SetFont('pdfahelvetica',	'', 10);	// Normal
		$pdf->Text(55, 25, $data['fecha_carga']);
		$pdf->Text(150, 25, $data['curp']);
		//$pdf->Text(34, 49, '*Apellido Paterno');
		$pdf->Text(16, 36, $data['paterno']);
		$pdf->Text(79, 36, $data['materno']);
		$pdf->Text(142, 36, $data['nombre']);
		$pdf->SetFont('pdfahelveticab', '', 8);
		$pdf->Text(16, 45, $data['correo']);
		$pdf->SetFont('pdfahelveticab', '', 10);
		$pdf->Text(79, 45, $data['tel']);
		$pdf->Text(142, 45, $data['cel']);
		
		
		$pdf->Text(16, 54, $data['padre']);
		$pdf->Text(110, 54, $data['madre']);
		
		
		$pdf->Text(16, 63+$bajar+2, $data['calle']);
		$pdf->Text(112, 63+$bajar+2, $data['noext']);
		$pdf->Text(130, 63+$bajar+2, $data['noint']);
		$pdf->Text(148, 63+$bajar+2, $data['manzana']);
		$pdf->Text(166, 63+$bajar+2, $data['lote']);
		$pdf->Text(184, 63+$bajar+2, $data['noedif']);
		$pdf->Text(15, 73+$bajar+2, $data['nodpto']);
		$pdf->Text(32, 73+$bajar+2, $data['andador']);
		$pdf->Text(49, 73+$bajar+2, $data['rampa']);
		$pdf->Text(66, 73+$bajar+2,  $data['rampa']);
		$pdf->Text(83, 73+$bajar+2,  $data['villa']);
		$pdf->Text(100, 73+$bajar+2, $data['entrada']);
		$pdf->Text(117, 73+$bajar+2,  $data['colonia']);
		$pdf->Text(16, 83+$bajar+2, $data['delegacion']);
		$pdf->Text(108, 83+$bajar+2, $data['cp']);
		
		$pdf->SetFont('pdfahelveticab', '', 7); //Negrita
		$pdf->Text(16, 98+$bajar+2, $data['institucion']);
		$pdf->Text(112, 98+$bajar+2, $data['plantel']);
		
		$pdf->SetFont('pdfahelveticab', '', 10); //Negrita
		$pdf->Text(16, 108+$bajar+2, $data['grado']);
		$pdf->Text(84, 108+$bajar+2, $data['turno']);
		
		 $pdf->Text(123.5, 108+$bajar+2, $data['modalidad']);
		$pdf->Text(176, 108+$bajar+2, $data['promedio']);	
		
		$pdf->endLayer();
		//cambio de 6 a 14 el sexto parametro
		$estilo = array('padding'=>'auto' );
		$pdf->write1DBarcode($data['matricula'], 'C128', 142, 251, 40,7, 0.4, $estilo, 'N');
		$pdf->SetFont('pdfahelveticab', '', 7);
		$pdf->Text(147, 255, $data['matricula']);
		$pdf->SetFont('pdfahelveticab', '', 8);
		$pdf->Text(185, 255, 'F-1516-02');
		//$pdf->write1DBarcode('F-1314-02', 'C128', 160, 250, 40, 14, 0.4, $stylecb, 'N');
		
		
		///////////////////////////////////////////////////---------------///////////////////////////////////////////////////
		///////////////////////////////////////////////////POLIZA DE SEGURO///////////////////////////////////////////////////
		///////////////////////////////////////////////////---------------///////////////////////////////////////////////////
		$pdf->AddPage('P','LETTER');
		
		//$pdf->SetFont('pdfahelveticab',	'', 10);	// Negrita
		//$pdf->SetFont('pdfahelveticabi',	'', 6);		// S N
		//$pdf->SetFont('pdfahelvetica',	'', 10);	// Normal
		//$pdf->SetFont('pdfahelveticai',	'', 10);	// S
		
		$pdf->SetTextColor(0,0,0);
		$style = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,20,5,10', 'phase' => 10, 'color' => array(255, 0, 0));
		$style2 = array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		$style3 = array('width' => 0.5, 'cap' => 'round', 'join' => 'round', 'dash' => '2,10', 'color' => array(0, 0, 0));
		$style4 = array('L' => 0,
				'T' => array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => '20,10', 'phase' => 10, 'color' => array(100, 100, 255)),
				'R' => array('width' => 0.50, 'cap' => 'round', 'join' => 'miter', 'dash' => 0, 'color' => array(50, 50, 127)),
				'B' => array('width' => 0.75, 'cap' => 'square', 'join' => 'miter', 'dash' => '30,10,5,10'));
		$style5 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 64, 128));
		$style6 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => '10,10', 'color' => array(0, 128, 0));
		$style7 = array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 128, 0));
		$style8 = array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
		# Imagenes del Encabezado
		$pdf->Image('resources/img/banorte.jpg', 15, 10, 75, 15, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		$pdf->SetFontSize(9);
		
		// create some HTML content
		$html = '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		
<div align="justify">
Advertencia: Si designas a menores de edad como beneficiarios, no es necesario señalar a un mayor de edad como representante para cobrar el seguro, ya que si lo haces, el representante tiene derecho a disponer de la suma asegurada, pues no queda obligado jurídicamente a entregársela a el o los beneficiarios del seguro.
</div>
		
<div align="justify">En el caso de que el beneficiario sea menor de edad, el padre o tutor deberá firmar de manera obligatoria este documento para su validez.</div>';
		
		// output the HTML content
		$pdf->writeHTML($html, true, 0, true, 0);
		//$pdf->SetFontSize(6);
		$pdf->SetFont('pdfahelvetica', '', 6); //Normal
		$html1 = '
<br />
<div align="justify">Los datos personales recabados serán protegidos, incorporados y tratados en el sistema denominado Sistema de Datos Personales del Programa Prepa Sí del Fideicomiso Educación Garantizada del Distrito Federal, el cual tiene su fundamento jurídico conforme a lo dispuesto en los artículos 6, 7 y demás relativos de la Ley de Protección de Datos Personales para el Distrito Federal, así como en el Contrato 21562 y sus convenios modificatorios, cuya finalidad es la integración de las bases de datos de los beneficiarios del Programa de Estímulos para el Bachillerato Universal para proporcionar los apoyos y estímulos correspondientes a los beneficiarios del Programa Educación Garantizada, Programa de Estímulos para el Bachillerato Universal, Programa de Niñ@s y Jóvenes Talento y del Programa de Seguro Contra Accidentes Personales de Escolares, así como aquellos programas que en su caso instruya el C. Jefe de Gobierno y el Comité Técnico de este Fideicomiso apruebe de conformidad con los lineamientos, reglas y/o mecanismos de operación correspondientes y podrán ser transmitidos únicamente al titular de los mismos datos o a su representante legal, además de otras transmisiones previstas en la Ley de Protección de Datos Personales para el Distrito Federal.
<br>
<br>
Los datos marcados con asterisco (*) son obligatorios y sin ellos no podrá acceder al servicio hasta completar el trámite Solicitud de ingreso o reingreso al Programa de Estímulos para el Bachillerato Universal, PREBU, Prepa Sí”. Asimismo, se le informa, que sus datos no podrán ser difundidos sin su conocimiento expreso, salvo las excepciones previstas en la Ley.
<br />
El responsable del Sistema de Datos Personales es la Lic. Mónica Pérez Egüis, Subdirectora de Control de Entregas e Incidencias y el domicilio en donde podrá ejercer los derechos de acceso, rectificación, cancelación y oposición, así como la renovación del consentimiento es la Oficina de Información Pública de este Fideicomiso Educación Garantizada, ubicada en Ejército Nacional No. 359, Col. Granada, Delegación Miguel Hidalgo, C.P. 11520, México, Distrito Federal, Número de Teléfono: 11021730 ext. 4079, Página de Internet: www.fideicomisoed.df.gob.mx y correo electrónico: oip@fideicomisoed.df.gob.mx.
<br />
El interesado podrá dirigirse al Instituto de Acceso a la Información Pública del Distrito Federal, donde recibirá asesoría sobre los derechos que tutela la Ley de Protección de Datos Personales para el Distrito Federal al teléfono 56364636; correo electrónico: datos.personales@infodf.org.mx o www.infodf.org.mx.
<br />
<br />
Este programa es de carácter público, no es patrocinado ni promovido por partido político alguno y sus recursos provienen de los impuestos que pagan todos los contribuyentes. Está prohibido el uso de este programa con fines políticos, electorales, de lucro y otros distintos a los establecidos. Quien haga uso indebido de los recursos de este programa en el Distrito Federal, será sancionado de acuerdo con la ley aplicable y ante la autoridad competente.
<br />
<br />
Con fundamento en el artículo 16 de la Ley de Protección de Datos Personales para el Distrito Federal y el Numeral 23 de los Lineamientos para la Protección de Datos Personales en el Distrito Federal, <b>'.$data['paterno'].' '.$data['materno'].' '.$data['nombre'].'</b> otorgo mi consentimiento expreso para que mis datos personales tengan un tratamiento específicamente para la operación que desarrolla el Programa de Estímulos para el Bachillerato Universal durante el tiempo en el cual me encuentre inscrito.</div>
<br />
';
		$pdf->writeHTML($html1, true, 0, true, 0);
		
		
		
		//$pdf->SetFontSize(6);
		$pdf->SetFont('pdfahelvetica', '', 9); //Normal
		$html2 = '
<br />
<div align="justify"><strong>IMPORTANTE<br/>
Si eres menor de edad, debe firmar el padre, la madre o el tutor.
</strong></div>';
		
		$pdf->writeHTML($html2, true, 0, true, 0);
		
		
		
		
		
		$pdf->SetFont('pdfahelveticab', '', 9); //Negrita
		$pdf->Text(92, 18, 'Consentimiento de seguro: ACCIDENTES PERSONALES COLECTIVO');
		# Linea 1
		$pdf->Line(15, 28, 200, 28, $style2);
		$pdf->SetFontSize(10);
		$pdf->Text(15, 30, 'Nombre del contratante BANCO MERCANTIL DEL NORTE, S.A.                                      1274/01');
		# Linea 2
		$pdf->Line(15, 35, 130, 35, $style2);
		# Linea 2 continuacion
		$pdf->Line(155, 35, 175, 35, $style2);
		$pdf->SetFont('pdfahelvetica',	'', 10);	// Normal
		$pdf->Text(56, 35, 'No Certificado');
		# Linea 3
		$pdf->Line(15, 41, 200, 41, $style2);
		$pdf->Text(15, 41, 'Nombre del Asegurado');
		$pdf->Text(120, 41, 'Sexo');
		$pdf->Text(170, 41, 'Estado Civil');
		# Linea 4
		$pdf->Line(15, 52, 200, 52, $style2);
		$pdf->Text(20, 52, '         Fecha de                    Fecha de Ingreso al                                                             Vigencia del Seguro ');
		$pdf->Text(20, 56, '        Nacimiento             Servicio del Contratante         Puesto u ocupación              Desde                   Hasta ');
		$pdf->Text(20, 60, '      Dia   Mes   Año              Dia   Mes   Año                                                         Dia  Mes  Año      Dia  Mes  Año');
		$pdf->Text(64, 65, '01     09    2015');
		# Linea 5
		$pdf->Line(15, 71, 200, 71, $style2);
		//Datos de (de los) asegurado(s)
		
		$pdf->Text(15, 72, 'Datos de (de los) asegurado (s)');
		$pdf->SetLineStyle(array('width' => 0.3, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		# Rectangulo de contenido
		$pdf->RoundedRect(15, 77, 185, 15, 3, '0000', 'NULL');
		# Lineas del Rectangulo
		$pdf->Line(75, 77, 75, 92, $style2);
		$pdf->Line(112, 77, 112, 92, $style2);
		$pdf->Line(132, 77, 132, 92, $style2);
		$pdf->Line(167, 77, 167, 92, $style2);
		
		$pdf->Text(18, 81, 'Nombre y Apellidos Completos');
		$pdf->Text(75, 77, 'Fecha de Nacimiento');
		$pdf->Text(136, 77, 'Fecha de Alta');
		
		$pdf->Text(78, 81, 'Dia     Mes     Año');
		$pdf->Text(116, 81, 'Sexo');
		
		$pdf->Text(134, 81, 'Dia     Mes     Año');
		$pdf->Text(173, 81, 'Parentesco');
		# Linea 6
		$pdf->Line(15, 94, 200, 94, $style2);
		$pdf->Text(15, 94.5, 'Regla para determinar la suma asegurada: Suma Asegurada fija igual a $10,000.00');
		
		# Linea 7
		$pdf->Line(15, 100, 200, 100, $style2);
		$pdf->SetFontSize(9);
		$pdf->Text(15, 100, 'Beneficios:');
		$pdf->SetFontSize(10);
		$pdf->Text(15, 105, 'MUERTE ACCIDENTAL');
		# Linea 8
		$pdf->Line(15, 110, 200, 110, $style2);
		$pdf->SetFont('pdfahelveticab', '', 9); //Negrita
		$pdf->Text(15, 111, 'Nombre completo de los Beneficiarios (para efectos de identificación) y porcentaje de participación');
		# Linea 9
		$pdf->Line(15, 121.5, 200, 121.5, $style2);
		
		$pdf->SetFont('pdfahelvetica',	'', 7);	// Normal
		
		$pdf->Text(16, 243, 'FIRMA DEL REPRESENTANTE DEL');
		$pdf->Text(87, 243, 'FIRMA DEL PADRE O TUTOR');
		$pdf->Text(148, 243, 'FIRMA DEL BENEFICIARIO/ALUMNO');
		
		$pdf->Text(15, 246, 'CONTRATANTE (BANCO MERCANTIL');
		$pdf->Text(163, 246, 'ASEGURADO');
		
		$pdf->Text(28, 249, 'DEL NORTE, S.A.)');
		
		$pdf->Line(15, 243, 67, 243, $style2);
		$pdf->Line(81, 243, 133, 243, $style2);
		$pdf->Line(147, 243, 199, 243, $style2);
		
		//$pdf->Line(15, 262, 200, 262, $style8);
		//$pdf->Line(15, 94, 255, 94, $style2);
		//$pdf->Text(185, 255, 'F-1415-02');
		///////////////////////////////////////////////////////
		//	Datos de DATOS PERSONALES
		///////////////////////////////////////////////////////
		$pdf->SetFont('pdfahelveticab', '', 10); //Negrita
		//$pdf->SetFont('pdfahelvetica',	'', 10);	// Normal
		$pdf->Text(15, 48, $data['paterno'].' '.$data['materno'].' '.$data['nombre']);
		$pdf->Text(118, 48, $data['sexo']);
		$pdf->Text(165, 48, $data['ecivil']);
		$pdf->Text(26, 65, substr($data['fecha_nac'],8,2));
		$pdf->Text(35, 65, substr($data['fecha_nac'],5,2));
		$pdf->Text(43, 65, substr($data['fecha_nac'],0,4));
		$pdf->Text(152, 254, $data['matricula']);
		$pdf->endLayer();
		$estilo = array('padding'=>'auto' );
		$pdf->write1DBarcode($data['matricula'], 'C128', 150, 247.5, 40, 9, 0.4, $estilo, 'N');
		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
		
		///////////////////////////////////////////////////---------------///////////////////////////////////////////////////
		///////////////////////////////////////////////////FORMATO TARJETAS//////////////////////////////////////////////////
		///////////////////////////////////////////////////---------------//////////////////////////////////////////////////
		
		$pdf->AddPage('P','LETTER');
		//$pdf->SetXY(110, 200);
		$pdf->SetFontSize(13);
		$pdf->SetLineStyle(array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
		# Primer Credencial
		$pdf->RoundedRect(8, 33, 95, 63, 3, '1111', 'NULL');
		//-$pdf->Image('../images/angel2.jpg', 10, 35, 23, 23, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		//-$pdf->Image('../images/fideicomiso.jpg', 40, 35, 20, 20, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		//-$pdf->Image('../images/prepasi.png', 80, 35, 20, 20, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		$pdf->Image('resources/img/tarjeta_cdmx.jpg', 11, 37, 87, 14, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		$codarr='';
		# Primer Codigo de Barras
		$params = $pdf->serializeTCPDFtagParameters(
		array($data['matricula'], 'C128', '25', '68', 60, 20, 0.4,
		array('position'=>'S', 'border'=>false, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
		$codarr .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
		
		$pdf->Text(30, 61, ''.$data['nombre'].'');
		$pdf->Text(135, 61, ''.$data['nombre'].'');
		$pdf->Text(10, 56, 'Nombre: '.$data['paterno'].' '.$data['materno'].'');
		$pdf->Text(115, 56, 'Nombre: '.$data['paterno'].' '.$data['materno'].'');
		$pdf->writeHTML($codarr, '', '', '', 0);
		
		# Segunda Credencial
		$pdf->RoundedRect(112, 33, 95, 63, 3, '1111', 'NULL');
		//-$pdf->Image('../images/angel2.jpg', 114, 35, 23, 23, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		//-$pdf->Image('../images/fideicomiso.jpg', 144, 35, 20, 20, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		//-$pdf->Image('../images/prepasi.png', 184, 35, 20, 20, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		$pdf->Image('resources/img/tarjeta_cdmx.jpg', 115, 37, 87, 14, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		
		# Segundo Codigo de Barras
		$params = $pdf->serializeTCPDFtagParameters(
		array($data['matricula'], 'C128', '130', '68', 60, 20, 0.4,
		array('position'=>'S', 'border'=>false, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,250), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
		$codarr .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
		$pdf->writeHTML($codarr, '', '', '', 0);
		# Tercer Credencial
		$pdf->RoundedRect(8, 105, 95, 63, 3, '1111', 'NULL');
		/*$pdf->Image('../images/angel2.jpg', 10, 107, 23, 23, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		 $pdf->Image('../images/fideicomiso.jpg', 40, 107, 20, 20, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		$pdf->Image('../images/prepasi.png', 80, 107, 20, 20, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);*/
		
		$pdf->Image('resources/img/tarjeta_cdmx.jpg', 11, 109, 87, 14, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		# Tercer Codigo de Barras 140+72
		$params = $pdf->serializeTCPDFtagParameters(
		array($data['matricula'], 'C128', '25', '140', 60, 20, 0.4,
		array('position'=>'S', 'border'=>false, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
		$codarr .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
		$pdf->writeHTML($codarr, '', '', '', 0);
		# Cuarta Credencial
		$pdf->RoundedRect(112, 105, 95, 63, 3, '1111', 'NULL');
		/*$pdf->Image('../images/angel2.jpg', 114, 107, 23, 23, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		 $pdf->Image('../images/fideicomiso.jpg', 144, 107, 20, 20, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		$pdf->Image('../images/prepasi.png', 184, 107, 20, 20, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);*/
		
		$pdf->Image('resources/img/tarjeta_cdmx.jpg', 115, 109, 87, 14, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		# Cuarto Codigo de Barras 140+72
		$params = $pdf->serializeTCPDFtagParameters(
		array($data['matricula'], 'C128', '130', '140', 60, 20, 0.4,
		array('position'=>'S', 'border'=>false, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,250), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
		$codarr .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
		$pdf->writeHTML($codarr, '', '', '', 0);
		# Quinta Credencial
		$pdf->RoundedRect(8, 177, 95, 63, 3, '1111', 'NULL');
		/*$pdf->Image('../images/angel2.jpg', 10, 179, 23, 23, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		 $pdf->Image('../images/fideicomiso.jpg', 40, 179, 20, 20, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		$pdf->Image('../images/prepasi.png', 80, 179, 20, 20, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);*/
		
		$pdf->Image('resources/img/tarjeta_cdmx.jpg', 11, 181, 87, 14, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		# Quinto Codigo de Barras 140+72
		$params = $pdf->serializeTCPDFtagParameters(
		array(''.$data['matricula'].'', 'C128', '25', '212', 60, 20, 0.4,
		array('position'=>'S', 'border'=>false, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
		$codarr .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
		$pdf->writeHTML($codarr, '', '', '', 0);
		# Sexta Credencial
		$pdf->RoundedRect(112, 177, 95, 63, 3, '1111', 'NULL');
		/*$pdf->Image('../images/angel2.jpg', 114, 179, 23, 23, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		 $pdf->Image('../images/fideicomiso.jpg', 144, 179, 20, 20, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		$pdf->Image('../images/prepasi.png', 184, 179, 20, 20, 'PNG', '', '', true, 100, '', false, false, 0, false, false, false);*/
		
		$pdf->Image('resources/img/tarjeta_cdmx.jpg', 115, 181, 87, 14, 'JPG', '', '', true, 100, '', false, false, 0, false, false, false);
		
		
		
		# Sexto Codigo de Barras 140+72
		$params = $pdf->serializeTCPDFtagParameters(
		array(''.$data['matricula'].'', 'C128', '130', '212', 60, 20, 0.4,
		array('position'=>'S', 'border'=>false, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,250), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));
		$codarr .= '<tcpdf method="write1DBarcode" params="'.$params.'" />';
		$pdf->writeHTML($codarr, '', '', '', 0);
		
		$pdf->Text(30, 133, ''.$data['nombre'].'');
		$pdf->Text(135, 133, ''.$data['nombre'].'');
		
		$pdf->Text(30, 205, ''.$data['nombre'].'');
		$pdf->Text(135, 205, ''.$data['nombre'].'');
		
		
		$pdf->Text(10, 128, 'Nombre: '.$data['paterno'].' '.$data['materno'].'');
		$pdf->Text(115, 128, 'Nombre: '.$data['paterno'].' '.$data['materno'].'');
		
		$pdf->Text(10, 200, 'Nombre: '.$data['paterno'].' '.$data['materno'].'');
		$pdf->Text(115, 200, 'Nombre: '.$data['paterno'].' '.$data['materno'].'');
		
		$pdf->setCellPaddings(1, 1, 1, 1);
		// set cell margins
		$pdf->setCellMargins(1, 1, 1, 1);
		
		// ---------------------------------------------------------
		
		//$pdf->writeHTML($html, '', '', '', 0);
		
		$pdf->SetFont('helvetica', '', 5);
		// print a message
		$txt = '“Este programa es de carácter público, no es patrocinado ni promovido por partido político alguno y sus recursos provienen de los impuestos que pagan todos los contribuyentes. Está prohibido el uso de este programa con fines políticos, electorales, de lucro y otros distintos a los establecidos. Quien haga uso indebido de los recursos de este programa en el Distrito Federal, será sancionado de acuerdo con la ley aplicable y ante la autoridad competente.”';
		$pdf->MultiCell(90, 0, $txt, 0, 'C', false, 1, 10, 82, true, 0, false, true, 0, 'T', false);
		$pdf->Ln(2);
		$txt = '“Este programa es de carácter público, no es patrocinado ni promovido por partido político alguno y sus recursos provienen de los impuestos que pagan todos los contribuyentes. Está prohibido el uso de este programa con fines políticos, electorales, de lucro y otros distintos a los establecidos. Quien haga uso indebido de los recursos de este programa en el Distrito Federal, será sancionado de acuerdo con la ley aplicable y ante la autoridad competente.”';
		$pdf->MultiCell(90, 0, $txt, 0, 'C', false, 1, 115, 82, true, 0, false, true, 0, 'T', false);
		$pdf->Ln(2);
		
		$txt = '“Este programa es de carácter público, no es patrocinado ni promovido por partido político alguno y sus recursos provienen de los impuestos que pagan todos los contribuyentes. Está prohibido el uso de este programa con fines políticos, electorales, de lucro y otros distintos a los establecidos. Quien haga uso indebido de los recursos de este programa en el Distrito Federal, será sancionado de acuerdo con la ley aplicable y ante la autoridad competente.”';
		$pdf->MultiCell(90, 0, $txt, 0, 'C', false, 1, 10, 154, true, 0, false, true, 0, 'T', false);
		$pdf->Ln(2);
		$txt = '“Este programa es de carácter público, no es patrocinado ni promovido por partido político alguno y sus recursos provienen de los impuestos que pagan todos los contribuyentes. Está prohibido el uso de este programa con fines políticos, electorales, de lucro y otros distintos a los establecidos. Quien haga uso indebido de los recursos de este programa en el Distrito Federal, será sancionado de acuerdo con la ley aplicable y ante la autoridad competente.”';
		$pdf->MultiCell(90, 0, $txt, 0, 'C', false, 1, 115, 154, true, 0, false, true, 0, 'T', false);
		$pdf->Ln(2);
		
		$txt = '“Este programa es de carácter público, no es patrocinado ni promovido por partido político alguno y sus recursos provienen de los impuestos que pagan todos los contribuyentes. Está prohibido el uso de este programa con fines políticos, electorales, de lucro y otros distintos a los establecidos. Quien haga uso indebido de los recursos de este programa en el Distrito Federal, será sancionado de acuerdo con la ley aplicable y ante la autoridad competente.”';
		$pdf->MultiCell(90, 0, $txt, 0, 'C', false, 1, 10, 226, true, 0, false, true, 0, 'T', false);
		$pdf->Ln(2);
		$txt = '“Este programa es de carácter público, no es patrocinado ni promovido por partido político alguno y sus recursos provienen de los impuestos que pagan todos los contribuyentes. Está prohibido el uso de este programa con fines políticos, electorales, de lucro y otros distintos a los establecidos. Quien haga uso indebido de los recursos de este programa en el Distrito Federal, será sancionado de acuerdo con la ley aplicable y ante la autoridad competente.”';
		$pdf->MultiCell(90, 0, $txt, 0, 'C', false, 1, 115, 226, true, 0, false, true, 0, 'T', false);
		$pdf->Ln(2);
		
		
		// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
		
		
		

	// reset pointer to the last page
	//$pdf->lastPage();
		$nombre_archivo = utf8_decode("Registro_".$data['matricula'].".pdf");
		
		$pdf->Output($nombre_archivo, 'I');
		ob_end_flush();
	}
}
	
?>