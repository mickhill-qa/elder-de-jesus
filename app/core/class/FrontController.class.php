<?php
/*
 *-------------------------------------------------------
 *              Simple MVC - Mick Hill
 *-------------------------------------------------------
 * 
 *  Front control - Arquivo que faz o fluxo MVC
 *
 */

class FrontController
{
    private $config_site;
    
    
    
    
    
    
    public function run()
    {
        $this->autoload();
        $this->mvc();
    }
    
    
    
    
    
    
    private function mvc()
    {
        $controller         = $this->config_site['MVC']['controller'];
        $method             = $this->config_site['MVC']['method'];
        $arquivoController  = $this->config_site['CAMINHOS']['CONTROLLERS'] . $controller . $this->config_site['EXTENCOES']['Controllers'];
        
        if (file_exists($arquivoController))
        {
            require_once($arquivoController);
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
    }

    
    
    
    
    
    private function autoload()
    {
        // Leitura de variaveis e arquivos necessarios para framework.
        global $config;
        require_once $config['CAMINHOS']['FRAMEWORK']   . 'config/Setup.php';
        require_once $config['CAMINHOS']['FRAMEWORK']   . 'helper/default.helper.php';
        require_once $config['CAMINHOS']['FRAMEWORK']   . 'class/Pagina.class.php';
        require_once $config['CAMINHOS']['FRAMEWORK']   . 'config/Controller.php';
        $this->config_site = $config;
        unset($config);
        
        
        // Leitura de arquivos descriminados no setup.
        foreach ($this->config_site['AUTOLOAD'] as $pasta => $arquivos)
        {
            $extencao = &$pasta;
            
            if (count($this->config_site['AUTOLOAD'][$pasta]) > 0)
            {
                foreach ($this->config_site['AUTOLOAD'][$pasta] as $nomeArquivo)
                {
                    $arquivo = $this->config_site['CAMINHOS']['FRAMEWORK'] . $pasta .'/'. $nomeArquivo .'.'. $extencao .'.php';
                    
                    if(file_exists($arquivo))
                        require_once $arquivo;

                    else
                        exit(
                            'O arquivo "'. $nomeArquivo .'.'. $extencao . '.php" não existe!<br />
                            Crie ele na pasta "' . $this->config_site['CAMINHOS']['FRAMEWORK'] . $pasta . '" com a extenção ".' . $extencao . '.php",<br />
                            ou remova-o do [AUTOLOAD][' . $pasta . ']=array("' . $nomeArquivo . '").'
                        );
                }
            }
        }
    }
}