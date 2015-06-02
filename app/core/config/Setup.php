<?php
/*
 *-------------------------------------------------------
 *              Simple MVC - Mick Hill
 *-------------------------------------------------------
 * 
 *  Configurações do site
 *
 */

$config['TITULO_APLICACAO']            = '';
$config['SLUG_SESSION']                = '';
$config['AUTOR_APLICACAO']             = '';
$config['CONTATO_AUTOR']               = '';
$config['PAGINA_INICIAL']              = '';
$config['VERSAO_APLICACAO']            = '';
$config['COPYRIGHT_APLICACAO']         = '';

$config['TITULO_ERRO']['404']          = '';
$config['TITULO_ERRO']['403']          = '';

$config['HTML_HEAD']['keywords']       = "";
$config['HTML_HEAD']['description']    = "";
$config['HTML_HEAD']['favicon']        = false;
$config['HTML_HEAD']['css']            = array();
$config['HTML_HEAD']['js']             = array();
$config['HTML_FOOTER']['js']           = array();

$config['URL_BASE']['URL_DINAMICA']    = true;
$config['URL_BASE']['ALIAS']           = '';
$config['URL_BASE']['DOMINIO']         = '';

$config['AUTOLOAD']['helper']          = array('default');
$config['AUTOLOAD']['class']           = array('Pagina');

$config['EXTENCOES']['Controllers']    = '';
$config['EXTENCOES']['Views']          = '';
$config['EXTENCOES']['favicon']        = '';

$config['EXIBIR_INDEX_URL']            = false;
$config['EXIBIR_CONFIG_PADRAO']        = false;