<?php


namespace Ijdb\Controllers;
use Framework\DatabaseTable;

class CategorysController
{
    private $categoriesTable;

    public function __construct(DatabaseTable $categoriesTable){
        $this->categoriesTable = $categoriesTable;
    }
	
	public function index(){
		$categories = $this->categoriesTable->findAll();
		$title = "Lista delle categorie";
		return ['template' => 'categories.html.php', 'title' => $title, 'variabili' => ['categories' => $categories]];
	}
	
    public function edit()
    {
        if(isset($_GET['id'])){
            $category = $this->categoriesTable->findById($_GET['id']);
        }

        $title = 'Modifica categoria.';

        return ['template' => 'editcategories.html.php', 'title' => $title, 'variabili' => ['category' => $category ?? '']];
    }
    
    public function saveEdit(){
	    $categoryName = $_POST['category'];
	    $this->categoriesTable->save($categoryName);
	    header('location: /category/index');
    }
    
    public function delete()
    {
    	$this->categoriesTable->delete($_POST['id']);
    	header('location: /category/index');
    }
}