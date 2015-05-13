<?php

class UniversitasController extends Controller
{
        public $breadcrumbs;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

	/**
	 * @return array action filters
	 */
	public function filters() {
            return array(
                'accessControl', // perform access control for CRUD operations
            );
        }

        public function accessRules() {
            return array(
                array('allow', // c
                    'actions' => array( 'create'),
                    'expression' => 'app()->controller->isValidAccess(1,"c")'
                ),
                array('allow', // r
                    'actions' => array('index', 'view'),
                    'expression' => 'app()->controller->isValidAccess(1,"r")'
                ),
                array('allow', // u
                    'actions' => array( 'update'),
                    'expression' => 'app()->controller->isValidAccess(1,"u")'
                ),
                array('allow', // d
                    'actions' => array( 'delete'),
                    'expression' => 'app()->controller->isValidAccess(1,"d")'
                )
            );
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Universitas;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Universitas']))
		{
			$model->attributes=$_POST['Universitas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Universitas']))
		{
			$model->attributes=$_POST['Universitas'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $session=new CHttpSession;
            $session->open();		
            $criteria = new CDbCriteria();            

                $model=new Universitas('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Universitas']))
		{
                        $model->attributes=$_GET['Universitas'];
			
			
                   	
                       if (!empty($model->id)) $criteria->addCondition('id = "'.$model->id.'"');
                     
                    	
                       if (!empty($model->name)) $criteria->addCondition('name = "'.$model->name.'"');
                     
                    			
		}
                 $session['Universitas_records']=Universitas::model()->findAll($criteria); 
       

                $this->render('index',array(
			'model'=>$model,
		));

	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Universitas::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='universitas-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionGenerateExcel()
	{
            $session=new CHttpSession;
            $session->open();		
            
             if(isset($session['Universitas_records']))
               {
                $model=$session['Universitas_records'];
               }
               else
                 $model = Universitas::model()->findAll();

		
		Yii::app()->request->sendFile(date('YmdHis').'.xls',
			$this->renderPartial('excelReport', array(
				'model'=>$model
			), true)
		);
	}
//        public function actionGeneratePdf() 
//	{
//           
//           $session=new CHttpSession;
//           $session->open();
//		Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
//		require_once(Yii::getPathOfAlias('common').'/extensions/tcpdf/tcpdf.php');
//		require_once(Yii::getPathOfAlias('common').'/extensions/tcpdf/config/lang/eng.php');
//
//             if(isset($session['Universitas_records']))
//               {
//                $model=$session['Universitas_records'];
//               }
//               else
//                 $model = Universitas::model()->findAll();
//
//
//
//		$html = $this->renderPartial('expenseGridtoReport', array(
//			'model'=>$model
//		), true);
//		
//		//die($html);
//		
//		$pdf = new TCPDF();
//		$pdf->SetCreator(PDF_CREATOR);
//		$pdf->SetAuthor(Yii::app()->name);
//		$pdf->SetTitle('Laporan Universitas');
//		$pdf->SetSubject('Laporan Universitas Report');
//		//$pdf->SetKeywords('example, text, report');
//		$pdf->SetHeaderData('', 0, "Report", '');
//		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" Universitas, "");
//		$pdf->SetHeaderData("", "", "Laporan Universitas", "");
//		$pdf->setHeaderFont(Array('helvetica', '', 8));
//		$pdf->setFooterFont(Array('helvetica', '', 6));
//		$pdf->SetMargins(15, 18, 15);
//		$pdf->SetHeaderMargin(5);
//		$pdf->SetFooterMargin(10);
//		$pdf->SetAutoPageBreak(TRUE, 0);
//		$pdf->SetFont('dejavusans', '', 7);
//		$pdf->AddPage();
//		$pdf->writeHTML($html, true, false, true, false, '');
//		$pdf->LastPage();
//		$pdf->Output("Universitas_002.pdf", "I");
//	}
}