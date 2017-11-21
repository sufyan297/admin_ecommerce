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


    /**
    *   Make Url Slag
    * @return url_slag
    */
    public function getUrlSlag($name = null)
    {
        $url_slag = null;
        if ($name != null) {

            $url_slag = str_replace(" ","_",strtolower(trim($name)));
            $url_slag = str_replace("'","",$url_slag);
            $url_slag = str_replace("/","_",$url_slag);
            $url_slag = str_replace("&","_",$url_slag);
            
            return $url_slag;
        }
        return false;
    }

    /**
     * Url Slag for Item Name
     * 
     * @return url_slag
     */
    public function getItemUrlSlag($name = null)
    {
        $url_slag = null;
        if ($name != null) {

            $url_slag = str_replace(" ","-",strtolower(trim($name)));
            $url_slag = str_replace("'","",$url_slag);
            $url_slag = str_replace("/","-",$url_slag);
            $url_slag = str_replace("&","-",$url_slag);
            
            return $url_slag;
        }
        return false;
    }

    /**
    *   Export Fields
    * @return comma seperated value
    */
    public function exportFields($fields = [],$type = 'excel')
    {
        $header_row = "";
        foreach ($fields as $key => $value) {
            if ($type == 'excel') {
                $header_row .= $value."\t";
            } else {
                $header_row .= $value.",";
            }
        }
        $header_row .= "\n";
        return $header_row;
    }
    
    /**
    *
    *
    */
    public function export($data = [], $filename = 'export',$type = 'excel')
    {
        $this->autoRender=false;
        if ($type == 'excel') {
            $filename = $filename."_".date("d_m_Y").".xls";
            header('Content-type: application/ms-excel');
        } else {
            $filename = $filename."_".date("d_m_Y").".csv";
            header('Content-type: text/csv');
        }
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        echo($data);die();
    }

    /**
     * Get Image Base Url
     * 
     * @return uri
     */
    public function getBaseImageUrl()
    {
        return "https://krerum-prod.s3.amazonaws.com/files/";
    }
}
?>
