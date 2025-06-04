<?php

namespace App\Controllers;

use Config\Services;

class Home extends BaseController
{
    public function index(): string
    {

        // ci view
        // return view('welcome_message');

        // twig view
		return Services::render('welcome_message'); // 사용자 목록 페이지 (뷰 파일)
    }
}
