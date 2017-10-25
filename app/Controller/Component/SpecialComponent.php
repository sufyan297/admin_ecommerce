<?php
App::uses('Component', 'Controller');

class SpecialComponent extends Component {

    /**
    *   Get Sorted MultiDimensional Array
    *
    * @param string $keyPass   Key of Array Element
    * @param array  $arr       Array to sort
    * @param string $sortOrder Sort Order Asscending or Descending
    *
    * @return array sorted
    * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
    */
   public static function sortMultiArray($keyPass,$arr = array(),$sortOrder = "ASC")
   {
       if ($sortOrder === "ASC") {
           $ORDER = 4; //Asscending
       } else if ($sortOrder === "DESC") {
           $ORDER = 3; //Descending
       } else {
           return "Invalid Sort Order. Hint [ASC,DESC]";
       }

       // PHP 7.0 Version [Anonymous Spaceship Operator]
       // usort($arr, function ($item1, $item2) {
       //     return $item1[$keyPass] <=> $item2[$keyPass];
       // });

       if (empty($arr) or empty($keyPass)) {
           return $arr;
       }

       $ordered = array();
       foreach ($arr as $key => $value) {
           $ordered[$value[$keyPass]] = $value;
       }
       ksort($ordered, $ORDER);
       return $ordered;
   }

   /**
    *  Get Random String
    *    DATE: 18th March 2017
    *
    * @param integer $length Length of Password
    *
    * @return string
    * @author Mohammed Sufyan <mohammed.sufyan@actonate.com>
    */
    public static function generateString($length = 8)
    {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
               ."abcdefghijklmnopqrstuvwxyz"
               ."0123456789-";
        $str = substr(str_shuffle($chars), 0, $length);
        return $str;
    }
}
?>
