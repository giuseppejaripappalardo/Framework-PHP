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
		
		public function getJokes($limit = null, $offset = null)
		{
			$jokeCategories = $this->jokeCategoriesTable->findByField('category_id', $this->id, null, $limit, $offset);
			$jokes = [];
			
			foreach($jokeCategories as $jokeCategory)
			{
				$joke = $this->jokesTable->findById($jokeCategory->joke_id);
				if($joke){
					$jokes[] = $joke;
				}
			}
			usort($jokes, [$this, 'sortJokes']);
			return $jokes;
		}

		public function sortJokes($a, $b){
			$aDate = new \Datetime($a->jokedate);
			$bDate = new \Datetime($b->jokedate);

			if($aDate->getTimestamp() == $bDate->getTimestamp()){
				return 0;
			}
			return $aDate->getTimestamp() > $bDate->getTimestamp() ? -1 : 1;
		}

		public function getNumJokes() {
			return $this->jokeCategoriesTable->findCount('category_id', $this->id);
		}
	}