<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{

    public function __construct()
    {
        parent::__construct();
    }
}


// defined('BASEPATH') or exit('No direct script access allowed');

// require_once APPPATH . 'libraries/fpdi/src/autoload.php';

// use setasign\Fpdi\Fpdi;

// class Pdf extends Fpdi
// {
//     public function __construct()
//     {
//         parent::__construct();
//     }
// }
