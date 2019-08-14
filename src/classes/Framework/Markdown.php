<?php

namespace Framework;

class Markdown {
    private $string;

    public function __construct($markDown){
        $this->string = $markDown;
    }

    public function toHtml() {
        // converte $this->string in HTML
        $text = htmlspecialchars($this->string, ENT_QUOTES, 'UTF-8');
        
        //strong (bold, grassetto)

        $text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);

        $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);

        
        //italic corsivo
        $text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);

        $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);

        //CONVERTE WINDOWS (r/n) in unix (/n)
        $text = str_replace("\r\n", "\n", $text);

        //conversione mac osx
        $text = str_replace("\r", "\n", $text);

        // paragrafi
        $text = '<p>' . str_replace("\n\n", '</p><p>', $text);
        // fine riga
        $text = str_replace("\n", '<br>', $text);

        // [testo del link](URL del link)
        $text = preg_replace('/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i', '<a href="$2">$1</a>', $text);

        return $text;
    }
}