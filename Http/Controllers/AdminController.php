<?php

namespace Maestro\Admin\Http\Controllers;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{    
    /**
     * Renderiza a tela principal do sistema 
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function home()
    {
        return view('admin::pages.home');       
    }

    /**
     * Renderiza a tela de login do sistema
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function login()
    {
        return view('admin::pages.login');
    }
}
