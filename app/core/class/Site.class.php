<?php
/*
 *-------------------------------------------------------
 *              Simple MVC - Mick Hill
 *-------------------------------------------------------
 * 
 *  Configuração global do site:
 *
 */

abstract class Site
{
    private   $site_config;
    protected $site_url;
    protected $site_url_index;
    protected $site_uri;
    protected $site_titulo;
    protected $site_session_nome;
    protected $site_copyright;
    protected $site_author;
    protected $site_author_contato;
    protected $site_versao;
    protected $site_extencoes;
    protected $site_homepage;
    protected $site_caminhos;
    protected $site_cabecalho;
    protected $site_rodape;
    protected $site_titulo_erros;

    public function __construct()
    {
        global $config;

        $this->site_config          = $config;
        $this->site_url             = $this->site_url();
        $this->site_url_index       = $this->site_config['EXIBIR_INDEX_URL'];
        $this->site_uri             = $this->site_config['URI'];
        $this->site_titulo          = $this->site_config['TITULO_APLICACAO'];
        $this->site_session_nome    = $this->site_config['SLUG_SESSION'];
        $this->site_copyright       = $this->site_config['COPYRIGHT_APLICACAO'];
        $this->site_author          = $this->site_config['AUTOR_APLICACAO'];
        $this->site_author_contato  = $this->site_config['CONTATO_AUTOR'];
        $this->site_versao          = $this->site_config['VERSAO_APLICACAO'];
        $this->site_extencoes       = $this->site_config['EXTENCOES'];
        $this->site_homepage        = $this->site_config['PAGINA_INICIAL'];
        $this->site_caminhos        = $this->site_config['CAMINHOS'];
        $this->site_cabecalho       = $this->site_config['HTML_HEAD'];
        $this->site_rodape          = $this->site_config['HTML_FOOTER'];
        $this->site_titulo_erros    = $this->site_config['TITULO_ERRO'];
    }




    protected function site_url($uri = '')
    {
        return $this->site_config['URL_BASE'] . $uri;
    }




    protected function site_model($model = '', $par1 = '', $par2 = '', $par3 = '')
    {
        $arquivo = $this->site_caminhos['MODELS'] . $model . '.class.php';
        
        if ($model == '')
            exit('Erro!<br />Passe o nome do "model" no paramentro sem a extenção.');
        
        elseif(!file_exists($arquivo))
            exit('Erro!<br />O model "' . $model . '.class.php" não existe.<br />OBS.: Nome de classe com letra maiuscula.');
        
        else
        {
            include_once($arquivo);
            return new $model($par1, $par2, $par3);
        }
    }




    protected function site_session()
    {
        session_name($this->site_session_nome);
        session_start();
    }
}