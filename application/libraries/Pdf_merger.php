<?php

defined('BASEPATH') or exit('No direct script access allowed');

use setasign\Fpdi\Fpdi;


require_once dirname(__FILE__) . '/setasign/fpdi/fpdi.php';


class Pdf_merger extends Fpdi
{
    public function __construct()
    {
        parent::__construct();
    }
}
