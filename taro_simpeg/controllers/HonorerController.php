<?php

class HonorerController extends Controller
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
                    'actions' => array('index', 'create'),
                    'expression' => 'app()->controller->isValidAccess("honorer","c")'
                ),
                array('allow', // r
                    'actions' => array('index', 'view'),
                    'expression' => 'app()->controller->isValidAccess("honorer","r")'
                ),
                array('allow', // u
                    'actions' => array('index', 'update'),
                    'expression' => 'app()->controller->isValidAccess("honorer","u")'
                ),
                array('allow', // d
                    'actions' => array('index', 'delete'),
                    'expression' => 'app()->controller->isValidAccess("honorer","d")'
                )
            );
        }

	public function cssJs() {     
	    cs()->registerScript('', '  
	    
	    $("#myTab a").click(function(e) {
	        e.preventDefault();
	        $(this).tab("show");
	    })

	    ');

  	}

  	public function actionRemovephoto($id) {
        Honorer::model()->updateByPk($id, array('foto' => NULL));
  	}

	public function actionView($id)
	{
		$this->cssJs();
                cs()->registerScript('read', '
                    $("form input, form textarea, form select").each(function(){
                    $(this).prop("disabled", true);
                });');
		$_GET['v'] = true;
                $this->actionUpdate($id);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->cssJs();
		$model=new Honorer;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Honorer']))
		{
			$model->attributes=$_POST['Honorer'];
			$model->kota = $_POST['kota'];
      		$model->tempat_lahir = $_POST['tempat_lahir'];

      		$file = CUploadedFile::getInstance($model, 'foto');
		    if (is_object($file)) {
		          $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
		    } else {
		          unset($model->foto);
		    }

			if($model->save()){
				if (is_object($file)) {
                    $file->saveAs('images/honorer/' . $model->foto);
                    Yii::app()->landa->createImg('honorer/', $model->foto, $model->id);
                }
				$this->redirect(array('view','id'=>$model->id));
			}
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
		$this->cssJs();
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Honorer']))
		{
			$model->attributes=$_POST['Honorer'];
			$model->kota = $_POST['kota'];
      		$model->tempat_lahir = $_POST['tempat_lahir'];

      		$file = CUploadedFile::getInstance($model, 'foto');
            if (is_object($file)) {
                $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
            } else {
                unset($model->foto);
            }

			if($model->save()){
				$file = CUploadedFile::getInstance($model, 'foto');
	            if (is_object($file)) {
	                  $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
	                  $file->saveAs('images/honorer/' . $model->foto);
	                  Yii::app()->landa->createImg('honorer/', $model->foto, $model->id);
	            }
				$this->redirect(array('view','id'=>$model->id));
			}
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
		if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            foreach ($_POST['ceckbox'] as $data) {
                $this->loadModel($data)->delete();                              
            }               
        }

                $model=new Honorer('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['Honorer']))
		{
                        $model->attributes=$_GET['Honorer'];
                        if($model->tempat_lahir==0) unset($model->tempat_lahir);
                        if($model->kota==0)  unset($model->kota);                        
                        if($model->unit_kerja_id==0)  unset($model->unit_kerja_id);                                                
                        if($model->jabatan_honorer_id==0)  unset($model->jabatan_honorer_id);  
			                   	                    	
		}       

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
		$model=Honorer::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='honorer-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Honorer_records'])) {
            $model = $session['Honorer_records'];
        } else
            $model = Honorer::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }
}
