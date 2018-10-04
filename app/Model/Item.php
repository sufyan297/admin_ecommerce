<?php
App::uses('AppModel', 'Model');

class Item extends Model
{
    var $belongsTo = ['ItemCategory','ItemSubCategory'];
    var $hasMany = array('ChildItems'=> array('className' => 'Item', 'foreignKey'=>'item_id'),'ItemVariant','SellerItem','ItemPhoto');

    public $actsAs = array(
                'Upload.Upload' => array(
                    // Field in the table which will store the path of the image
                    'image_file' => array(
                    // Allowed mime types
                    'mimetypes'=> array('image/jpg','image/jpeg', 'image/png'),
                    'storagePath' => 's3',
                    'aws' => [
                        'region' => 'ap-southeast-1',
                        'key' =>  '',
                        'secret' =>  '',
                        'bucket' =>  'krerum-prod',
                        'prefix_path' => 'files/', //make sure to end path with dir seperator '/'
                        'original_upload' => false //Upload original image?
                    ],
                    // Use php for localhost or where imagick is not installed
                    'thumbnailMethod'=>"php",
                    // Allowed set of extensions
                    'extensions'=> array('jpg','png','JPG','PNG','jpeg','JPEG'),
                    'thumbnailSizes' => array(
                        'tm'  => '[80x60]',
                        'sm'  => '[200x150]',
                        'api' => '[400x300]',
                        'md'  => '[500x375]',
                        'big' => '[800x600]',
                        'hd'  => '[1000x750]'
                    ),
                    // Map the directory path to specified field in the table
                    'fields' => array(
                        'dir' => 'image_dir'
                    )
                )
            )
        );

}
?>
