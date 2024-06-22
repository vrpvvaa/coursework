<?php
require_once "Connect.php";
class Pagination extends Connect
{
    private $currentPage;
    private $totalItems;
    private $itemsPerPage;
    private $totalPages;

    public function __construct($totalItems, $currentPage = 1, $itemsPerPage = 3) {
        $this->totalItems = $totalItems;
        $this->currentPage = $currentPage;
        $this->itemsPerPage = $itemsPerPage;
        $this->totalPages = ceil($totalItems / $itemsPerPage);
    }

    public function getOffset() {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }

    public function render() {
        $html = '<div class="pagination">';
        for ($i = 1; $i <= $this->totalPages; $i++) {
            $activeClass = ($i == $this->currentPage) ? 'active' : '';
            $html .= "<a href=\"?page=$i\" class=\"$activeClass\">$i</a>";
        }
        $html .= '</div>';
        return $html;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function getItemsPerPage() {
        return $this->itemsPerPage;
    }
}

?>