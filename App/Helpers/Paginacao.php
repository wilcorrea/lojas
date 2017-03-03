<?php
    namespace App\Helpers;
	
    class Paginacao
    {
        protected $total;
        protected $quantidade;
        protected $link;
        protected $getPagina;
        protected $pg;
		
        public function __construct($total, $link, $quantidade, $getPagina = 'pagina'){
            $this->total = $total;
            $this->link = $link;
            $this->quantidade = $quantidade;
            $this->getPagina = $getPagina;
            $this->pg = (isset($_GET[$this->getPagina])) ? $_GET[$this->getPagina] : 1;
        }
		
        public function offset(){
            $pagina = $this->pg;
            $offset = (--$pagina) * $this->quantidade;
            return $offset;
        }
		
        public function links(){
            $links = '';
            $paginas = ceil($this->total / $this->quantidade);
            $link = $this->link.'?'.$this->getPagina.'=';
            $maxlinks = 4;
            if ($this->total > $this->quantidade) {
                $links .= '<ul class="pagination">';
                $links .= '<li><a href="'.$link.'1">Primeira página</a></li>';
                for ($i = $this->pg - $maxlinks; $i<= $this->pg-1; $i++) {
                    if ($i >= 1) {
                        $links .= '<li><a href="'.$link.$i.'">'.$i.'</a></li>';
                    }
                }
                $links .= '<li><a href="#"><b>'.$this->pg.'</b></a></li>';
                for ($i = $this->pg + 1; $i <= $this->pg + $maxlinks; $i++) {
                    if ($i <= $paginas) {
                        $links .= '<li><a href="'.$link.$i.'">'.$i.'</a></li>';
                    }
                }
                $links .= '<li><a href="'.$link.$paginas.'">Última página</a></li>';
                $links .= '</ul>';
            }
            return $links;
        }
    }