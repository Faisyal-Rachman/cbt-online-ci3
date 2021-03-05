<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');
//$rendererLibraryPath = APPPATH.'libraries/tcpdf';
  //   APPPATH.'libraries/tcpdf';
require_once dirname(__FILE__).'/tcpdf/tcpdf.php';
// Extend the TCPDF class to create custom Header and Footer
class Pdf_report extends TCPDF 
{

public function Header() {
    $headerData = $this->getHeaderData();
    $this->SetFont('helvetica', 'B', 10);
    $this->writeHTML($headerData['string']);
}
    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
  
}