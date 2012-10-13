<?php
require('rotation.php');

class FPDFR extends PDF_Rotate{

	public $font;
	public $font_size;

	public $titulo;
	public $subtitulo;

	public $wmark;
	public $watermark;
	
	public $footer;

	public function FPDFR( $fecha = '', $titulo = '', $subtitulo = '', $entidad = '', $folio = '', $wmark=false, $watermark='', $resguardo = false, $footer = true){

		$this->FPDF( 'P', 'mm', 'Letter' );
		$this->SetLeftMargin( 13 );

		$this->fecha      =  $fecha;
		$this->titulo     =  $titulo;
		$this->subtitulo  =  $subtitulo;
		$this->entidad    =  $entidad;
		$this->folio      =  $folio;
		$this->wmark	  =	 $wmark;
		$this->watermark  =  $watermark;
		$this->resguardo  =  $resguardo;
		$this->footer     =  $footer;
		$this->init();


	}

	public function init(){

		$this->AliasNbPages();

		$this->font       =  'Arial';
		$this->font_size  =  9;
		//$this->logo       =  getcwd() . '/public/img/system/logo.jpg';
		//$this->logo2       =  getcwd() . '/public/img/system/logo2.jpg';

	}


	public function Header()
	{
		//watermark
		$this->SetFont( $this->font,'B', $this->font_size + 40 );
		if($this->wmark){
			$this->SetTextColor(255, 0, 0);
			$this->RotatedText(80, 140, $this->watermark, 45);
				
			$this->SetFont( $this->font,'B', $this->font_size );
			$this->SetTextColor(0, 0, 0);
		}

		//Logo
		if( $this->logo ){
			$this->Image( $this->logo, 10, 9, 12 );
		}

		//Logo2
		if( !$this->resguardo && $this->logo2 ){
			$this->Image( $this->logo2, 22, 10, 10 );
		}
		 
		if(!$this->resguardo){
			//T�tulo
			$this->SetFont( $this->font,'B', $this->font_size );
			$this->Cell( 0, 0, strtoupper( $this->corp ), 0, 0, 'R' );
			$this->Ln( 5 );
			$this->Cell( 0, 0, strtoupper( $this->dept ), 0, 0, 'R' );
			 
			if( $this->fecha != '' ){
				$this->SetFont( $this->font,'', $this->font_size - 1);
				$this->Ln( 5 );
				$this->Cell( 0, 0, $this->fecha , 0, 0, 'R' );
			}
			 
			$this->SetFont( $this->font,'B', $this->font_size );

			if( $this->titulo != '' ){
				$this->Cell( 0, 0, $this->titulo, 0, 0, 'C' );
				$this->Ln( 5 );
			}
			 
			if( $this->subtitulo != '' ){
				$this->Cell( 0, 0, $this->subtitulo, 0, 0, 'C' );
			}
		}else{
			//Titulo
			$this->Ln( -5 );
			$this->SetFont( $this->font,'', $this->font_size-1 );
			$this->SetFont( $this->font,'', $this->font_size-2 );
			$this->setX(50);
			$this->Cell( 100, 5, utf8_decode($this->titulo), 0, 0, 'C' );
			$this->Ln( 5 );
			$this->setX(50);
			$this->Cell( 100, 5, utf8_decode($this->subtitulo), 0, 0, 'C' );
			 
			$this->SetFont( $this->font,'', $this->font_size - 3);
			$this->Ln( -10 );
			$this->setX(190);
			$this->Cell( 10, 5, "" , 0, 0, 'R' );
		
			 
			$this->SetFont( $this->font,'B', $this->font_size );


		}
		 
		$this->Ln( 5 );
		 
		 
		 
	}

	function RotatedText($x, $y, $txt, $angle)
	{
		//Text rotated around its origin
		$this->Rotate($angle, $x, $y);
		$this->Text($x, $y, $txt);
		$this->Rotate(0);
	}

	public function Footer()
	{
		if($this->footer){
			//Posici�n: a 1,5 cm del final
			$this->SetY(-15);
			//Arial italic 8
			//N�mero de p�gina
			//$usr = Session :: get_data( 'usr.login' );
			$date = str_replace("-", "/", Utils::fecha_convertir($this->fecha));
			$this->SetFont( $this->font, 'I', $this->font_size - 1);
			$this->Cell( 20, 5, utf8_decode("CGRH/CIPAC "), 0, 0, 'L' );
			$this->SetFont( $this->font, 'I', $this->font_size - 1 );
			$this->Cell( 0, 5, utf8_decode( 'pág. ' . $this->PageNo().' de {nb}'), 0, 0, 'R' );
			
			$this->ln(5);
			$this->Cell( 20, 3, $date, 0, 0, 'L' );
		}
	}

	public function out( $n = '' ){

		$this->Output( $n, 'I' );

	}


}
?>