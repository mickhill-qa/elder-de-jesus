<?php

class Html
{
    private   $html_title;
    private   $html_keywords;
    private   $html_description;
    private   $html_copyright;
    private   $html_favicon;
    private   $html_css;
    private   $html_js_head;
    private   $html_js_footer;
    private   $html_author;
    private   $html_contact;
    public    $iniciou = false;
    
    public function title($title = '')
    {
        $this->html_title = "
        <title>$title</title>";
    }
    
    public function keywords($keywords = '')
    {
        $this->html_keywords = '
        <meta   name="keywords"        content="' . $keywords . '" />';
    }
    
    public function description($description = '')
    {
        $this->html_description = '
        <meta   name="description"     content="' . $description . '" />';
    }
    
    public function copyright($copyright = '')
    {
        $this->html_copyright = '
        <meta   name="copyright"       content="' . $copyright . '" />';
    }
    
    public function favicon($arquivo = '')
    {
        $this->html_favicon = '
        <link   type="image/x-icon"    href="' . $arquivo . '" rel="icon" />';
    }
    
    public function css($arquivo = "")
    {
        $this->html_css .= '
        <link   type="text/css"        href="' . $arquivo . '.css" rel="stylesheet" />';
    }
    
    public function js_head($arquivo = "")
    {
        $this->html_js_head .= '
        <script type="text/javascript" src="' . $arquivo . '.js"></script>';
    }
    
    public function js_footer($arquivo = "")
    {
        $this->html_js_footer .= '
        <script type="text/javascript" src="' . $arquivo . '.js"></script>';
    }
    
    public function author($author = '')
    {
        $this->html_author = '
        <meta   name="author"          content="' . $author . '" />';
    }
    
    public function contact($contact = '')
    {
        $this->html_contact = '
        <meta   name="contact"         content="' . $contact . '" />';
    }


    

    public function inicio()
    {
        $this->iniciou = true;
        echo '<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        
        <!-- Padão bootstrap -->
        <meta content="IE=edge" http-equiv="X-UA-Compatible" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        '
        .$this->html_title
        .$this->html_favicon
        .$this->html_keywords
        .$this->html_description
        .$this->html_copyright
        .$this->html_css
        .$this->html_js_head
        .$this->html_author
        .$this->html_contact
        .'
    </head>
    <body>
';
    }
    
    public function fim()
    {
        if($this->iniciou)
            echo $this->html_js_footer . '
    </body>
</html>'
        ;
    }
}