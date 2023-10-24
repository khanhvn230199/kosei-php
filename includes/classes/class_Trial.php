<?
/******************************************************
 * Class Page
 *
 * Static Page Handling
 * 
 * Project Name               :  FTS-USSH
 * Package Name            		:  
 * Program ID                 :  class_Trial.php
 * Environment                :  PHP  version 4, 5
 * Author                     :  TuanTA
 * Version                    :  1.0
 * Creation Date              :  2014/02/10
 *
 * Modification History     :
 * Version    Date            Person Name  		Chng  Req   No    Remarks
 * 1.0       	2014/02/10    	TuanTA          -  		-     -     -
 *
 ********************************************************/
class Trial extends dbBasic{
	function Trial(){
		$this->pkey = "trial_id";
		$this->tbl 	= "_trial";
	}
	
	//INSERT
	//UPDATE




       //EXPORT
    function exportTrial($level_id="", $limit=''){



        global $dbconn, $_LANG_ID;
      
      
        $sql = "SELECT * FROM $this->tbl ";
        if (is_numeric($level_id)){
            $sql.= " WHERE level_id=$level_id";
        }
        $sql.= " ORDER BY trial_id DESC";
        if( $limit!='' ) $sql.= " LIMIT $limit";
        $arrListTrial = $dbconn->GetAll($sql);

        // echo $sql;
        // print_r($arrListTrial);die();

        // echo $sql;

        /** Error reporting */
        error_reporting(0);
        /** PHPExcel */
        require_once DIR_INCLUDES.'/PHPExcel.php';
        /** PHPExcel_IOFactory */
        require_once DIR_INCLUDES.'/PHPExcel/IOFactory.php';
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                     ->setLastModifiedBy("Maarten Balliauw")
                                     ->setTitle("Office 2007 XLSX Test Document")
                                     ->setSubject("Office 2007 XLSX Test Document")
                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                                     ->setKeywords("office 2007 openxml php")
                                     ->setCategory("Test result file");
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'STT')
                    ->setCellValue('B1', 'ID')
                    ->setCellValue('C1', 'Họ Tên')
                    ->setCellValue('D1', 'Trình Độ')
                    ->setCellValue('E1', 'Phone')
                    ->setCellValue('F1', 'Email')
                    


                    // ->setCellValue('AD1', 'Mã ngôn ngữ')
        ;
        // product_id,cat_id,name,trademark, code, input_price, price,image, list_image, sale, des, detail, reg_date, total_view, is_online, in_stock,is_hot, tags, order_no, page_title, meta_keywords, meta_des, lang_code
        $clsLevel = new Level();
       

        if(is_array($arrListTrial))
        foreach($arrListTrial as $k => $v){
            $level_id = $v['level_id'];
            $level = $clsLevel->getOne($level_id);
            $level_name = $level['name'];              
               
            $objPHPExcel->getActiveSheet()->setCellValue('A'.($k+2), $k+1);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.($k+2), $v[trial_id]);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.($k+2), $v[name]);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.($k+2), $level_name);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.($k+2), $v[phone]);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.($k+2), $v[email]);
            

        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:AC1')->applyFromArray(
                array(
                    'font'    => array(
                        'bold'      => true
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                    'borders' => array(
                        'top'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    ),
                    'fill' => array(
                        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => 'FFA0A0A0'
                        ),
                        'endcolor'   => array(
                            'argb' => 'FFFFFFFF'
                        )
                    )
                )
        );
        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client's web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="product.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        //freeing memory
        unset($arrListProduct);
        unset($clsCategory);
        unset($objPHPExcel);
        exit;
    }
    //End



	//DELETE
	//OTHER
}

?>