<?php


class GenericUtils{
	public $dateDisplayFormat = 'd/m/Y';
	public static $dateDBFormat = 'Y-m-d';	
	public static function getWeekStartEndDate(){
		
		$first_day_of_week = date(self::$dateDBFormat, 
							 strtotime('Last Sunday', time()));
		$last_day_of_week = date(self::$dateDBFormat, 
							strtotime('Next Sunday', time()));
		/*
		Yii::trace ('GenericUtils.getWeekStartEndDate '
					.$first_day_of_week. ' '.
					$last_day_of_week);	*/						
		return array ('start'=>$first_day_of_week,
					  'end' => $last_day_of_week);
		
	}
	public static function getMonthStartEndDate(){
		$oFirst = date(self::$dateDBFormat,
				  strtotime('first day of this month'));
		$oLast  = date (self::$dateDBFormat,
				strtotime('last day of this month'));
		
		Yii::trace('getMonthStartEndDate '. $oFirst . ' '. $oLast );
		return array('start'=>$oFirst,
					 'end'=>$oLast);
	}
	
	
}



?>