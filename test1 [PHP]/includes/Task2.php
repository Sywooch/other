<?php
//проверка наличия переменной $n в массиве $M
function in_arraySortableSplFixedArray($n,$M){
	for($i=0;$i<count($M);$i++){
		if($M[$i]===$n){ return true; }
		
	}
	return false;
}



//генерация массива
//диапазон чисел от $start до $end
//$count - размер массива
function generate($start, $end, $count) {
	if($count<=20000){
		//
		$M = array();
		$index = mt_rand(0,$count-1);//место для повторяющегося элемента
		//echo "index= ".$index."<br>";
		
		for($i=0;$i<$count;$i++){
			if($i==$index){
				$M[$i]="_";
			}else{
				while(1){
					$int=mt_rand($start, $end);
					if(!in_array($int, $M)){
						$M[$i]=$int;
						break;
					}
				}
				
			}
			
		}

		
		while(1){
			$index2 = mt_rand(0,$count-1);//номер элемента, который будет повторяться
			if($index2!=$index) break;
		}
		$M[$index]=$M[$index2];
	}else{
		$M = new SortableSplFixedArray($count);
		$index = mt_rand(0,$count-1);//место для повторяющегося элемента
		for($i=0;$i<$count;$i++){
			if($i==$index){
				$M[$i]="_";
			}else{
				
				
					
					$int=mt_rand($start, $end);
						$M[$i]=$int;
				
				
			}
			
		}
		while(1){
			$index2 = mt_rand(0,$count-1);//номер элемента, который будет повторяться
			if($index2!=$index) break;
		}
		$M[$index]=$M[$index2];
		
		
					
	}
	return $M;

}




//сортировка методом quick sort
function quick_sort($array)
{
	
	if(is_array($array)){
		//<=10000
		$length = count($array);
		if($length <= 1){
			return $array;
		}else{
		
			//выбор элемента для использования в качестве точки-разделителя
			$pivot = $array[0];
			
			//две части
			$left = $right = array();
			
			//проверка каждого элемента, и в зависимости от того, больше он или меньше точки-разделителя, помещаем в соответствующую часть.
			for($i = 1; $i < count($array); $i++)
			{
				if($array[$i] < $pivot){
					$left[] = $array[$i];
				}
				else{
					$right[] = $array[$i];
				}
			}
			
			//рекурсивно сортируем обе части
			//состыковываем части
			return array_merge(quick_sort($left), array($pivot), quick_sort($right));
		}
	}else{
		
		
		$array->sort(SORT_ASC);
		
		return $array;
		
	}
	
	
	
}



function bubbleSort(SplFixedArray $a) 
{
   $len = $a->getSize() - 1;
   $sorted = false;

   while (!$sorted) {
    $sorted = true;
    for ($i = 0; $i < $len; $i++)
    {
        $current = $a->offsetGet($i);
        $next = $a->offsetGet($i + 1);

        if ( $next < $current ) {
            $a->offsetSet($i, $next);
            $a->offsetSet($i + 1, $current);
            $sorted = false;
        }
    }
  }

  return $a;
}











class SortableSplFixedArray extends SplFixedArray {
    /**
     * Take an array and build an instance of the current class around it. No need 
     * to overwrite this for children.
     * @static
     * @param array $array
     * @return array
     */
    public static function fromArray(array $array) {
        $class = __CLASS__;
        $instance = new $class(count($array));
        $i = 0;
        foreach($array as $value) {
            $instance[$i++] = $value;
        }
        return $instance;
    }
    /**
     * Publicly accessible method for sorting the FixedArray
     * @param int|callable $dir - can be either a sort flag (SORT_ASC or SORT_DESC)
     *                            or a user-defined comparison function
     */
    function sort($dir = SORT_ASC) {
        if($dir == SORT_ASC) {
            $comp_function = function($a, $b) {
                return $a<$b;
            };
        } else if($dir == SORT_DESC) {
            $comp_function = function($a, $b) {
                return $a>$b;
            };
        } elseif(is_callable($dir)) {
            $comp_function = $dir;
        } else {
            trigger_error('Bad argument provided for sort flag. Valid parameters are '
                        . 'SORT_ASC, SORT_DESC, or a user-defined sorting function');
            //proceed as though SORT_ASC
            $comp_function = function($a, $b) {
                return $a<$b;
            };
        }
        $this->_quicksort($comp_function, 0, $this->getSize()-1);
    }
    /**
     * Finds a pivot point using a 'midpoint of three' procedure
     * @param int $left - left index
     * @param int $right - right index
     * @return array - array contains the pivot's index and its value
     */
    protected function _pivot_selection_function($left, $right) {
        $midpoint = (int)(((($right-$left)%2)==1) ? (($right-1-$left)/2 + $left) : 
                                                    (($right-$left)/2 + $left));
        if($this->offsetGet($right)<$this->offsetGet($left)) {
            if($this->offsetGet($midpoint) > $this->offsetGet($right)) {
                return array($right, $this->offsetGet($right));
            } else {
                return ($this->offsetGet($midpoint) > $this->offsetGet($left)) ? 
                                      array($midpoint, $this->offsetGet($midpoint)) : 
                                      array($left, $this->offsetGet($left));
            }
        } else {
            if($this->offsetGet($midpoint) > $this->offsetGet($left)) {
                return array($left, $this->offsetGet($left));
            } else {
                return ($this->offsetGet($midpoint) > $this->offsetGet($right)) ? 
                                      array($midpoint, $this->offsetGet($midpoint)) : 
                                      array($right, $this->offsetGet($right));
            }
        }
    }
    /**
     * Implement a recursive quicksort algorithm ordering based on the passed-in 
     * comparison function
     * @param callable $comp_function
     * @param int $left_offset
     * @param int $right_offset
     */
    protected function _quicksort($comp_function, $left_offset, $right_offset) {
        if($right_offset - $left_offset < 1) return;

        list($key, $value) = $this->_pivot_selection_function($left_offset, 
                                                                 $right_offset);
        if($key != $left_offset) {
            $this->_swap($left_offset, $key);
        }
        $j = $left_offset+1;
        $has_larger = false;
        for($i=$j; $i <= $right_offset; $i++) {
            $val = $this->offsetGet($i);
            $comp = $comp_function($val,$value);
            if($has_larger && $comp) {
                $this->_swap($j, $i);
                $j++;
            } elseif($comp) {
                $j++; //just advance pointer, no swap
            } elseif(!$has_larger) {
                $has_larger = true;
            }
        }
        $this->_swap($left_offset, $j-1);
        $this->_quicksort($comp_function, $left_offset, $j-2);
        $this->_quicksort($comp_function, $j, $right_offset);
    }

    protected function _swap($i, $j) {
        $temp = $this->offsetGet($j);
        $this->offsetSet($j, $this->offsetGet($i));
        $this->offsetSet($i, $temp);
    }
}











//поиск двух одинаковых числе в массиве $M
//возврат: значение повторяющегося числа
function search($M){
	
	//сортировка массива
	$M=quick_sort($M);
	//пробегаемся по массиву и сравниваем попарно стоящие рядом элементы
	
	
	for($i=0;$i<count($M)-1;$i++){
		if($M[$i]===$M[$i+1]){
			$result=$M[$i];
			break;	
		}
	}
	return $result;
	
	
}




?>

