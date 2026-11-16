<?php
class Pagination
{
    public $page, $perPage, $total;

    public function __construct($total, $perPage = null)
    {
        $this->total   = (int)$total;
        $this->perPage = $perPage ? $perPage : config('per_page', 10);
        $p = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $this->page = max(1, min($p, $this->pages()));
    }
    public function pages()  { return max(1, (int)ceil($this->total / $this->perPage)); }
    public function offset() { return ($this->page - 1) * $this->perPage; }
}
