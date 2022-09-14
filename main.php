<?php 
class farm
{
	//Массивы животных
	private $animalTypes = array(0=>"cow",
								 1=>"chicken");

								//Т.к каждое животное должно иметь свой номер - создаем массив чисел
	private $arrayOfAnimals=array("cow"=> array(),
								  "chicken"=>array());

	//массивы таймингов по добыче продукта(яйца, мясо, молоко и т.д)
    //Пусть 1 цикл = 1 день
    private $productTypes=array(0=>"milk",
								1=>"egg");
    private $countProduct=array("milk"=> 0,
								"egg"=> 0);

    private $productPerCycle=array("milk"=>[8,12],
								   "egg"=>[0,1]);
    private $productAndAnimal=array("cow"=>"milk",
									"chicken"=>"egg");

    //Еще пару массивов чтобы сделать единицы измерения продуктов и вывод на русский язык(Чисто для удобства, можно и без этого)

    private $unitOfMessure=array("milk"=>"Литров",
								 "egg"=>"Штук");
    private $rusAnimal=array("cow"=>"Коров",
    						 "chicken"=>"Куриц");
    private $rusProduct=array("milk"=>"Молоко",
							  "egg"=>"Яйца");



	public function __construct()
  	{
  		$this-> addAnimals("cow",10);
  		$this -> state(0);
  		$this-> addAnimals("chicken",20);
  		$this -> state(0);
  		$this-> addNewTypeAnimal("pig","meet",[10,20], "Килограмм", "Свиней","Мясо");
  		$this-> addAnimals("pig",10);
  		$this -> state(1);

  		$this-> passCycle(7);
  		$this->state(1);

  	}

  	public function state($key){
  		/*
  		0 - отобразить кол.во всех животных
  		1 - отобразить кол.во продукции
  		*/
  		$message="";
  		if($key==0){
  			$message="Количество животных на ферме:\n\r";
  			for($i=0;$i<sizeof($this->animalTypes);$i++){
  				$typeAnimal=$this->animalTypes[$i];
  				$typeAnimalRus=$this->rusAnimal[$this->animalTypes[$i]];
  				$count= end($this->arrayOfAnimals[$typeAnimal]);
  				if($count==null)
  					$count=0;
  				$message= $message."   ".$typeAnimalRus." - ".$count."\n\r";
  			}
  		}
  		if($key==1){
  			$message="Количество собранной продукции:\n\r";
  			for($i=0;$i<sizeof($this->productTypes);$i++){
  				$typeProduct=$this->productTypes[$i];
  				$typeProductRus=$this->rusProduct[$this->productTypes[$i]];
  				$message= $message."   ".$typeProductRus." - ".$this->countProduct[$typeProduct]." ".$this->unitOfMessure[$typeProduct]."\r\n";
  			}
  		}

  		echo $message;

  		echo "\r\n\r\n";
  	}
  	public function passCycle($count){
  		//Каждые i дней(1 день = 1 цикл) мы перебираем всех животных(на имена и их кол.во). После собираем продукцию
  		for($i=0;$i<$count;$i++){
  			foreach ( $this->arrayOfAnimals as $nameOfAnimal => $value )
			{
				$countAnimals=sizeof($value);
				for($y=0;$y<$countAnimals;$y++){
					$productName=$this->productAndAnimal[$nameOfAnimal];
					$currentCount=$this->countProduct[$productName];
					$minMax=$this->productPerCycle[$productName];
  					$rand=random_int($minMax[0],$minMax[1]);
  					$this->countProduct[$productName]=$currentCount+$rand;
				}
			}
  		}
  	}

  	public function addNewTypeAnimal($animalName,$product, $minMax,$unit,$animalRus,$productRus){
  		$this->animalTypes[sizeof($this->animalTypes)]=$animalName;
  		$this->arrayOfAnimals[$animalName]=array();
  		$this->productTypes[sizeof($this->productTypes)]=$product;
  		$this->countProduct[$product]=0;
  		$this->productPerCycle[$product]=$minMax;
  		$this->productAndAnimal[$animalName]=$product;

  		//единицы измерения и рус.яз
  		$this->unitOfMessure[$product]=$unit;
  		$this->rusAnimal[$animalName]=$animalRus;
  		$this->rusProduct[$product]=$productRus;
  	}
  	public function addAnimals($animalName,$count){
  		$localArray=& $this->arrayOfAnimals[$animalName];

  		$lastId=end($localArray);
  		if($lastId==null)
  			$lastId=0;
  		

  		//Добавляем новых животных в массив
  		for($i=0;$i<$count;$i++){
  			$lastId++;
  			array_push($localArray, $lastId);
    	}
  	}
}
$f = new farm();

 ?>
