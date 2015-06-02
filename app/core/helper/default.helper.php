<?php
/*
 *-------------------------------------------------------
 *              Simple MVC - Mick Hill
 *-------------------------------------------------------
 * 
 *  Helper padrão da aplicação...
 *
 */



// Definições de dados padrões do framework.
$config['TITULO_APLICACAO']            = default_valida_valor(@$config['TITULO_APLICACAO'],           'Simple MVC');
$config['SLUG_SESSION']                = default_valida_valor(@$config['SLUG_SESSION'],               'simple-mvc');
$config['AUTOR_APLICACAO']             = default_valida_valor(@$config['AUTOR_APLICACAO'],            'Mick Hill');
$config['CONTATO_AUTOR']               = default_valida_valor(@$config['CONTATO_AUTOR'],              'mickhill@hotmail.com.br');
$config['PAGINA_INICIAL']              = default_valida_valor(@$config['PAGINA_INICIAL'],             'index');
$config['VERSAO_APLICACAO']            = default_valida_valor(@$config['VERSAO_APLICACAO'],           'v2.0');
$config['COPYRIGHT_APLICACAO']         = default_valida_valor(@$config['COPYRIGHT_APLICACAO'],        '©Código aberto');
$config['TITULO_ERRO']['404']          = default_valida_valor(@$config['TITULO_ERRO']['404'],         'Error 404 (Not Found)!!!');
$config['TITULO_ERRO']['403']          = default_valida_valor(@$config['TITULO_ERRO']['403'],         'Error 403 (Forbidden)!!!');
$config['HTML_HEAD']['keywords']       = default_valida_valor(@$config['HTML_HEAD']['keywords'],      'framework, simples, mvc, ejovem, e-jovem, turma beta, beta, aprendizes, aprendize, turma de aprendizes, turma aprendizes');
$config['HTML_HEAD']['description']    = default_valida_valor(@$config['HTML_HEAD']['description'],   'Esquema simples de MVC que imita o fluxo de grandes frameworks(ZEND, CI, LARAVEL) que eu(Mick HIll) uso na PC4. Desenvolvi esse mini framework para atender a minha necessidade no projeto E-Jovem de programar usando MVC; Meu professo(Randell Rodrigues - Professor de Informática da 1º Turma de aprendizes do Projeto E-Jovem no ano de 2014), por questões de didática não nos deixou usar um framework, mas como gosto de desenvolver usando MVC aliei meu conhecimento adquirido em sala de aula com o trabalho na PC4 para resolver essa questão.');
$config['EXTENCOES']['Controllers']    = default_valida_valor(@$config['EXTENCOES']['Controllers'],   '.php');
$config['EXTENCOES']['Views']          = default_valida_valor(@$config['EXTENCOES']['Views'],         '.phtml');
$config['EXTENCOES']['favicon']        = default_valida_valor(@$config['EXTENCOES']['favicon'],       '.ico');



// Definição de caminhos padrões do framework.
$config['CAMINHOS']['MODELS']      = $config['CAMINHOS']['APLICACAO'] . "models/";
$config['CAMINHOS']['VIEWS']       = $config['CAMINHOS']['APLICACAO'] . "views/";
$config['CAMINHOS']['CONTROLLERS'] = $config['CAMINHOS']['APLICACAO'] . "controllers/";



// Definição de varaveis para MVC.
$config['URI']  = isset($_GET['uri']) ? $_GET['uri'] : $config['PAGINA_INICIAL'];
$config['URI'] .= '/';
$config['URI']  = explode("/", $config['URI']);
$config['URI']  = array_filter($config['URI']);
$config['MVC']['controller']     = default_trata_uri($config['URI'][0] . 'Controller');
$config['MVC']['method']         = default_trata_uri($config['URI'][1] = ($config['URI'][1] == null ? 'index' : $config['URI'][1]));



// Definição de URL Dinámica.
if ($config['URL_BASE']['URL_DINAMICA'] == true)
{
    if (isset($config['URL_BASE']['DOMINIO']) && (strlen($config['URL_BASE']['DOMINIO']) !== 0))
        exit('Para "URL_BASE dinámica" deixe o domínio em branco.<br>Setup.php');

    else if (($_SERVER['SERVER_ADDR'] == '127.0.0.1') || ($_SERVER['SERVER_ADDR'] == '::1'))
        $config['URL_BASE'] = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $config['URL_BASE']['ALIAS'] = (($config['URL_BASE']['ALIAS'] == NULL || $config['URL_BASE']['ALIAS'] == '') ? '' : $config['URL_BASE']['ALIAS'] . '/');

    else
        $config['URL_BASE'] = 'http://' . $_SERVER['SERVER_NAME'] . '/';
}
else
{
    if (($config['URL_BASE']['DOMINIO'] == '') || $config['URL_BASE']['DOMINIO'] == NULL)
        exit('Defina um "domínio na URL_BASE" da aplicação!<br>Setup.php');

    $config['URL_BASE'] = 'http://' . $config['URL_BASE']['DOMINIO'] . '/';
}



// Funções de auxilio(helpers) padão do framework.
function default_trata_uri($string, $sep = '')
{
    $string = explode('-', $string);
    
    for($i = 0; $i < count($string); $i++)
        $string[$i] = ucfirst($string[$i]);
    
    $string = implode($sep, $string);
    
    return $string;
}

function default_valida_valor($variavel, $valor)
{
    return(($variavel == NULL || $variavel == '')? $valor : $variavel);
}

function default_debug($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}





// Exibir configurações padrão do sistema.
if ($config['EXIBIR_CONFIG_PADRAO'])
{
    default_debug($config);
    die;
}