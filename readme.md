# Небольшая документация по использованию #

## state(int $key) ##
  Данная функция выводит данные об ферме в зависимости от ключа.
  * 0 - отобразить кол.во всех животных
  * 1 - отобразить кол.во продукции

## passCycle(int $count) ##
  Заставляем программу посчитать кол.во собранных продуктов за count циклов(1 цикл = 1 день)
  
## addNewTypeAnimal(String $animalName, String $product, array $minMax,String $unit,String $animalRus,String $productRus) ##
  Добавляем новый вид животного на ферму.
  * animalName - название животного, которое добавляем(Курица, корова)
  * product    - название продукта который будет воспроизводить данное животное(яйца, молоко)
  * minMax     - массив из двух элементов, который отображает сколько минимум и максимум может дать животное продуктов за один цикл([1,2] - от 1 до 2 яиц за цикл)
  * unit       - название единицы измерения, в которой будет выводиться информация об кол.ве продуктов( яйца - 10 штук)
  * animalRus  - имя животного для вывода информации(Корова - 10)
  * productRus - название продукта для вывода информации(Молоко - 10 литров)
  
  
## addAnimals(String $animalName,int $count) ##
  Добавляем на ферму уже существующий вид животного в определенных кол.вах 
  * animalName - название уже существующего вида животного на ферме
  * count      - сколько животных хотим добавить
