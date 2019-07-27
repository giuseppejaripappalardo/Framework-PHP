<?php
	
	
	namespace Ijdb\Entity;
	
	
	use Framework\DatabaseTable;
	
	class Category
	{
		public $id;
		public $name;
		private $jokesTable;
		private $jokeCategoriesTable;
		
		public function __construct(DatabaseTable $jokesTable, DatabaseTable $jokeCategoriesTable)
		{
			$this->jokeCategoriesTable = $jokeCategoriesTable;
			$this->jokesTable = $jokesTable;
		}
		
		public function getJokes()
		{
			$jokeCategories = $this->jokeCategoriesTable->findByField('category_id', $this->id);
			$jokes = [];
			
			foreach($jokeCategories as $jokeCategory)
			{
				$joke = $this->jokesTable->findById($jokeCategory->joke_id);
				if($joke){
					$jokes[] = $joke;
				}
			}
			return $jokes;
		}
	}