<?php
App::uses('AppModel', 'Model');

class Item extends Model
{
    var $belongsTo = ['ItemCategory','ItemSubCategory'];
    var $hasMany = array('ChildItems'=> array('className' => 'Item', 'foreignKey'=>'item_id'),'ItemVariant','SellerItem');

    public $actsAs = array(
                'Upload.Upload' => array(
                        // Field in the table which will store the path of the image
                        'image_file' => array(
                        // Allowed mime types
                        'mimetypes'=> array('image/jpg','image/jpeg', 'image/png'),
                        // Use php for localhost or where imagick is not installed
                        'thumbnailMethod'=>"php",
                        // Allowed set of extensions
                        'extensions'=> array('jpg','png','JPG','PNG','jpeg','JPEG'),
                        'thumbnailSizes' => array(
                        'tm'  => '[80x80]',
                        'sm'  => '[200x200]',
                        'api' => '[300x240]',
                        'md'  => '[500x400]',
                        'big' => '[800x640]',
                        'hd'  => '[1000x800]'
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
