<?php

class SuratMasukController extends Controller
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
                    'expression' => 'app()->controller->isValidAccess("suratMasuk","c")'
                ),
                array('allow', // r
                    'actions' => array('index', 'view'),
                    'expression' => 'app()->controller->isValidAccess("suratMasuk","r")'
                ),
                array('allow', // u
                    'actions' => array('index', 'update'),
                    'expression' => 'app()->controller->isValidAccess("suratMasuk","u")'
                ),
                array('allow', // d
                    'actions' => array('index', 'delete'),
                    'expression' => 'app()->controller->isValidAccess("suratMasuk","d")'
                )
            );
        }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

	

	public function actionView($id)
	{
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
		$model=new SuratMasuk;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SuratMasuk']))
		{
			$model->attributes=$_POST['SuratMasuk'];
			$file = CUploadedFile::getInstance($model, 'file');
		      if (is_object($file)) {
		          $model->file = Yii::app()->landa->urlParsing($model->pengirim).'-'.$model->tanggal_terima . '-' . $file->name;
		      } else {
		          unset($model->file);
		      }
			if($model->save()){
				if (is_object($file)) {
                    $file->saveAs('images/surat_masuk/' . $model->file);                    
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SuratMasuk']))
		{
			$model->attributes=$_POST['SuratMasuk'];
			$file = CUploadedFile::getInstance($model, 'file');
		      if (is_object($file)) {
		          $model->file = Yii::app()->landa->urlParsing($model->pengirim).'-'.$model->tanggal_terima . '-' . $file->name;
		      } else {
		          unset($model->file);
		      }
			if($model->save()){
				if (is_object($file)) {
                    $file->saveAs('images/surat_masuk/' . $model->file);                    
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
        $criteria = new CDbCriteria();  

                $model=new SuratMasuk('search');
                $model->unsetAttributes();  // clear any default values

                if(isset($_GET['SuratMasuk']))
		{
                        $model->attributes=$_GET['SuratMasuk'];
			
                   	
                       if (!empty($model->id)) $criteria->addCondition('id = "'.$model->id.'"');
                     
                    	
                       if (!empty($model->pengirim)) $criteria->addCondition('pengirim = "'.$model->pengirim.'"');
                     
                    	
                       if (!empty($model->penerima)) $criteria->addCondition('penerima = "'.$model->penerima.'"');
                     
                    	
                       if (!empty($model->tanggal_kirim)) $criteria->addCondition('tanggal_kirim = "'.$model->tanggal_kirim.'"');
                     
                    	
                       if (!empty($model->tanggal_terima)) $criteria->addCondition('tanggal_terima = "'.$model->tanggal_terima.'"');
                     
                    	
                       if (!empty($model->sifat)) $criteria->addCondition('sifat = "'.$model->sifat.'"');
                     
                    	
                       if (!empty($model->nomor_surat)) $criteria->addCondition('nomor_surat = "'.$model->nomor_surat.'"');
                     
                    	
                       if (!empty($model->perihal)) $criteria->addCondition('perihal = "'.$model->perihal.'"');
                     
                    	
                       if (!empty($model->isi)) $criteria->addCondition('isi = "'.$model->isi.'"');
                     
                    	
                       if (!empty($model->file)) $criteria->addCondition('file = "'.$model->file.'"');
                     
                    	
                       if (!empty($model->created)) $criteria->addCondition('created = "'.$model->created.'"');
                     
                    	
                       if (!empty($model->created_user_id)) $criteria->addCondition('created_user_id = "'.$model->created_user_id.'"');
                     
                    	
                       if (!empty($model->modified)) $criteria->addCondition('modified = "'.$model->modified.'"');
                     
                    	
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
		$model=SuratMasuk::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='surat-masuk-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['SuratMasuk_records'])) {
            $model = $session['SuratMasuk_records'];
        } else
            $model = SuratMasuk::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }
}
