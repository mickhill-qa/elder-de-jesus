<?php

class IndexController extends Controller
{
    public $banners;
    protected $pasta_uploads;
    
    
    public function Index()
    {
        $this->pasta_uploads = $this->site_model('ArquivosMickHill',$this->site_url,$this->site_caminhos['PUBLIC']);
        $this->banners       = $this->pasta_uploads->listar_pasta('banners');
        $this->pagina_view();
    }
}