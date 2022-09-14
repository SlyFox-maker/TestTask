<?php 
class farm
{
	//Массивы животных
	private $animalTypes = array();
	private $arrayOfAnimals=array();

	//массивы таймингов по добыче продукта(яйца, мясо, молоко и т.д)
    //Пусть 1 цикл = 1 день
    private $productTypes=array();
    private $countProduct=array();

    private $productPerCycle=array();
    private $productAndAnimal=array();

    //Еще пару массивов чтобы сделать единицы измерения продуктов и вывод на русский язык(Чисто для удобства, можно и без этого)

    private $unitOfMessure=array();
    private $rusAnimal=array();
    private $rusProduct=array();



	public function __construct()
  	{
  		//При желании можно добавить какую нить первичную инициализацию при создании объекта класса
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
  		//Проверка на существование данного вида животного
  		$exist=$this->checkExist($animalName);
  		if($exist){
  			echo "\n\r### Повтроная регистрация животного '".$animalName."' не нужна. ###\n\r";
  			return;
  		}


  		//Если все ок, то добавляем
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
  		//Проверка на существование данного вида животного
  		$exist=$this->checkExist($animalName);
  		if(!$exist){
  			echo "\n\r### Попытка добавить несуществующего вида животного '".$animalName."'. Сначала нужно зарегистрировать данный тип животного ###\n\r";
  			return;
  		}

  		//Если все ок, то добавляем
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
  	private function checkExist($animalName){
  		$correct=false;
  		foreach ( $this->arrayOfAnimals as $nameOfAnimal => $value ){
  			if($nameOfAnimal==$animalName){
  				$correct=true;
  				break;
  			}
  		}
  		return $correct;
  	}
}
$f = new farm();

//Добавление новых типов животных на ферму
$f -> addNewTypeAnimal("cow", "milk", [8,12],"литров", "Коров","Молоко");
$f -> addNewTypeAnimal("chicken", "egg", [0,1],"штук", "куриц","яиц");

//Добавление самих животных
$f -> addAnimals("cow",10);
$f -> addAnimals("chicken",20);

//Выводим инфо об кол.ве животных
$f -> state(0);


//Проводим 7 дней собирая урожай
$f -> passCycle(7);

//Выводим инфо об кол.ве собранной продукции за 7 дней
$f -> state(1);

//Добавляем на ферму еще животных(съездили на рынок)
$f -> addAnimals("cow",1);
$f -> addAnimals("chicken",5);

//Выводим инфо об кол.ве животных
$f -> state(0);

//Снова проводим 7 дней собирая урожай и выводим результат
$f -> passCycle(7);
$f -> state(1);
?>
