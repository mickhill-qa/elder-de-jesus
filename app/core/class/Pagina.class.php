<?php
/*
 *-------------------------------------------------------
 *              Simple MVC - Mick Hill
 *-------------------------------------------------------
 * 
 *  Configuração das página:
 *      
 *      Dependencias direta do site
 * 
 *
 */

include_once 'Site.class.php';

abstract class Pagina extends Site
{
    protected $pagina_url;
    protected $pagina_uri;
    protected $pagina_atual;
    public    $pagina_titulo;
    public    $pagina_dados;
    private   $pagina_html;


    public function __construct()
    {
        parent::__construct();
        
        $this->pagina_url     = $this->pagina_url();
        $this->pagina_uri     = explode("/", $this->pagina_uri());
        $this->pagina_atual   = $this->site_url($this->pagina_uri());
        $this->pagina_titulo  = $this->site_uri[0] == $this->site_homepage ? $this->site_titulo : $this->pagina_titulo();      
        
        include_once           'Html.class.php';
        $this->pagina_html    = new Html();
        
        if(!$this->site_url_index)
        {
            if($this->pagina_uri[0] == "index")
                $this->pagina_redireciona();

            elseif($this->pagina_uri[1] == "index")
                $this->pagina_redireciona($this->pagina_uri[0]);
        }
    }



    protected function pagina_url($pg = '')
    {
        return $this->pagina_url = $this->site_url . @$this->pagina_uri() . ($pg == '' ? '' : '/' . $pg);
    }




    protected function pagina_uri()
    {
        return $_GET['uri'];
    }




    public function pagina_titulo($tituloPagina = '')
    {
        if ($tituloPagina == '')
            $subTituloSite = default_trata_uri($this->site_uri[0], ' ');

        else
            $subTituloSite = $tituloPagina;
            
        return $this->pagina_titulo = $this->site_titulo . ' - ' . $subTituloSite;
    }




    protected function pagina_redireciona($pg = '', $interno = TRUE)
    {
        if ($interno == true)
            $pg = $this->site_url($pg);

        echo '<script>location.href="' . $pg . '";</script>';
        die;
    }




    protected function pagina_voltar($indice = 1)
    {
        echo "<script>location.href(history.go(-$indice));</script>";
        die;
    }




    public function pagina_erro($viewErro = '', $titulo = '')
    {
        if(($viewErro == 404 || $viewErro == 403) && $titulo != '')
            exit("Para o erro $viewErro o titulo é o padão do setup...");
        
        if($viewErro == '' || $viewErro == 404)
        {
            $viewErro = 404;
            $titulo  = $this->site_titulo_erros['404'];
        }

        elseif($viewErro == 403)
            $titulo = $this->site_titulo_erros['403'];
        
        $arquivo = $this->site_caminhos['VIEWS'] . 'erros/' . $viewErro . $this->site_extencoes['Views'];
        
        if (file_exists($arquivo))
        {
            $this->pagina_titulo = $titulo;
            $this->pagina_html();
            return require_once $arquivo;
        }

        exit('Erro!<br>A view de erro "' . $viewErro . $this->site_extencoes['Views'] . '" não existe.');
    }




    protected function pagina_view($view = '')
    {
        
        if ($view == '')
            $view = $this->site_uri;

        else
        {
            $view  = explode('/', $view);
            
            for($i = 0; $i < 2; $i++)
            {
                @$view[$i] = ((($view[$i] == NULL) || ($view[$i] == '')) ? $this->site_uri[$i] : $view[$i] );
            }
            
            $view  = array_filter($view);
        }

        $view      = implode('/', $view);
        $arquivo   = $this->site_caminhos['VIEWS'] . $view .  $this->site_extencoes['Views'];

        if (file_exists($arquivo))
            return require_once $arquivo;

        exit('Erro!<br>A view "' . $view . $this->site_extencoes['Views'] . '" não existe.');
    }




    public function pagina_html()
    {
        $this->pagina_html->title($this->pagina_titulo);
        
        if ($this->site_cabecalho['favicon'])
            $this->pagina_html->favicon($this->site_url('img/favicon' . $this->site_extencoes['favicon']));
        
        foreach ($this->site_cabecalho['css'] as $arquivo)
            $this->pagina_html->css($this->site_url('css/' . $arquivo));
        
        foreach ($this->site_cabecalho['js'] as $arquivo)
            $this->pagina_html->js_head($this->site_url('js/' . $arquivo));
        
        foreach ($this->site_rodape['js'] as $arquivo)
            $this->pagina_html->js_footer($this->site_url('js/' . $arquivo));
        
        $this->pagina_html->author($this->site_author);
        $this->pagina_html->contact($this->site_author_contato);
        $this->pagina_html->keywords($this->site_cabecalho['keywords']);
        $this->pagina_html->description($this->site_cabecalho['description']);
        $this->pagina_html->copyright($this->site_copyright);
        
        $this->pagina_html->inicio();
    }




    public function pagina_add_js_head($nomeJs = '')
    {
        return array_push($this->site_cabecalho['js'], $nomeJs);
    }




    public function pagina_add_js_footer($nomeJs = '')
    {
        return array_push($this->site_rodape['js'], $nomeJs);
    }




    public function pagina_add_css($nomeCss = '')
    {
        return array_push($this->site_cabecalho['css'], $nomeCss);
    }




    public function __destruct()
    {
        $this->pagina_html->fim();
    }
}