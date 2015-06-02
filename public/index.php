<?php header('Content-type: text/html; charset=UTF-8');
/*
 *-------------------------------------------------------
 *              Simple MVC - Mick Hill
 *-------------------------------------------------------
 * 
 *  Arquivo de acesso (aplicação => cliente)
 *
 */

// Caminhos relativos a esse arquivo. (Editavel)
$config['CAMINHOS']['APLICACAO'] = '../app/';
$config['CAMINHOS']['FRAMEWORK'] = '../app/core/';



// Caminhos padrões. (Não Editavel)
$config['CAMINHOS']['PUBLIC']    = str_replace('\\', '/', __DIR__) . '/';
$config['CAMINHOS']['APLICACAO'] = str_replace('\\', '/', realpath($config['CAMINHOS']['PUBLIC'] . $config['CAMINHOS']['APLICACAO'])) . '/';
$config['CAMINHOS']['FRAMEWORK'] = str_replace('\\', '/', realpath($config['CAMINHOS']['PUBLIC'] . $config['CAMINHOS']['FRAMEWORK'])) . '/';



require_once $config['CAMINHOS']['FRAMEWORK'] . 'class/FrontController.class.php';
$bootstrap = new FrontController();
$bootstrap->run();