<?php
class ArquivosMickHill
{
    private $pasta_arquivos = 'uploads/';
    public  $url_padrao_site;
    public  $pasta_public_html;
    
    public function __construct($site_url = '', $pasta_public = '')
    {
        $this->url_padrao_site   = $site_url;
        $this->pasta_public_html = $pasta_public;
    }
    public function listar_pasta($subPasta = '')
    {
        $subPasta      = $this->pasta_arquivos . $subPasta;
        $PastaPublic   = $this->pasta_public_html;
        $PastaListar   = $PastaPublic . $subPasta;
        
        if($subPasta == $this->pasta_arquivos)
            return exit('Digite o nome da pasta dentro de"' .  $this->url_padrao_site . $this->pasta_arquivos . '" a ser listada...');
        
        elseif(!is_dir($PastaListar))
            return exit('A pasta "' . $this->url_padrao_site . $subPasta . '" não existe...');
        
        else
        {
            $Pasta    = dir($PastaListar);
            $subPasta = ($subPasta == '' ? '' : $subPasta . '/');
            while($arquivo = $Pasta->read())
            {
                if($arquivo == '.' || $arquivo == '..' || $arquivo == 'index.html' || $arquivo == '.DS_Store')
                    continue;
                if(is_dir($PastaListar . $arquivo)) 
                    $arquivo .= '/' ;
                $conteudo[] = $this->url_padrao_site . $subPasta . $arquivo;
            }
            $Pasta->close();
            
            if($conteudo)
                rsort($conteudo);
            return $conteudo;
        }
    }
}
