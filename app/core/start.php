<?php
/*
 *-------------------------------------------------------
 *              Simple MVC - Mick Hill
 *-------------------------------------------------------
 * 
 *  Front control - Arquivo que faz o fluxo MVC
 *
 */

require_once $config['CAMINHOS']['FRAMEWORK'] . 'config/Setup.php';

while (current($config['AUTOLOAD']))
{
    $pasta      = key($config['AUTOLOAD']);
    $extencao   = &$pasta;
    
    if (count($config['AUTOLOAD'][$pasta]) > 0)
    {
        foreach ($config['AUTOLOAD'][$pasta] as $nomeArquivo)
        {
            $arquivo = $config['CAMINHOS']['FRAMEWORK'] . $pasta .'/'. $nomeArquivo .'.'. $extencao .'.php';
            
            if(file_exists($arquivo))
                require_once $arquivo;
            
            else
                exit('O arquivo "'. $arquivo .'" não existe!<br>Crie ele na pasta "/' . $pasta . '" com a extenção ".' . $extencao . '.php", ou remova-o do "AUTOLOAD" - ("' . $nomeArquivo . '").');
        }
    }
    next($config['AUTOLOAD']);
}

require_once $config['CAMINHOS']['FRAMEWORK'] . 'config/Controller.php';

$config['URI']  = isset($_GET['uri']) ? $_GET['uri'] : $config['PAGINA_INICIAL'];
$config['URI'] .= '/';
$config['URI']  = explode("/", $config['URI']);
$config['URI']  = array_filter($config['URI']);
$controller     = default_trata_uri($config['URI'][0] . 'Controller');
$method         = default_trata_uri($config['URI'][1] = ($config['URI'][1] == null ? 'index' : $config['URI'][1]));
$pagina         = $config['CAMINHOS']['CONTROLLERS'] . $controller . $config['EXTENCOES']['Controllers'];


if (file_exists($pagina))
{
    require_once($pagina);
    $paginaAtual = new $controller();
}

else
    $paginaAtual = new Controller();


if(!method_exists($paginaAtual, $method))
{
    $method = 'pagina_erro';

    if($config['URI'][0] == 403)
        $parametro = 403;
}

$paginaAtual->$method($parametro);