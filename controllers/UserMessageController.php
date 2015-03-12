<?php

class UserMessageController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    public function multipleName($data) {
        $listUser = User::model()->listUser();
        //$sResult = '';
//        foreach (json_decode($data->receiver_user_ids) as $arrReceiver) {
//            $sResult .= $listUser[$arrReceiver]['name'] . ', ';
//        }
        $sResult = $listUser[$data->user_id_opp]['name'];
        return $sResult;
//            $arrUsers = User::model()->findAll();
//            $arrUserName = array();
//            foreach ($arrUsers as $arrUser){
//                $arrUserName[$arrUser->id] = $arrUser->name;
//            }
//            trace($arrUserName);
//            $sResult = '';
//            foreach (json_decode($data->receiver_user_ids) as $arrReceiver){
//                $sResult .= $arrUserName[$arrReceiver] . ', ';
//            }
//            return $sResult;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $userMessageDetail = new UserMessageDetail;

        //change to readed
        $model = $this->loadModel($id);
        $model->is_read = true;
        $model->save();
        

        $this->render('view', array(
            'model' => $model,
            'userMessageDetail' => $userMessageDetail,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new UserMessage;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserMessage'])) {
            $model->attributes = $_POST['UserMessage'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserMessage'])) {
            $model->attributes = $_POST['UserMessage'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new UserMessage('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['UserMessage'])) {
            $model->attributes = $_GET['UserMessage'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->last_date))
                $criteria->addCondition('last_date = "' . $model->last_date . '"');


            if (!empty($model->last_message))
                $criteria->addCondition('last_message = "' . $model->last_message . '"');


            if (!empty($model->count_messages))
                $criteria->addCondition('count_messages = "' . $model->count_messages . '"');
        }
        $session['UserMessage_records'] = UserMessage::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new UserMessage('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UserMessage']))
            $model->attributes = $_GET['UserMessage'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = UserMessage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-message-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['UserMessage_records'])) {
            $model = $session['UserMessage_records'];
        }
        else
            $model = UserMessage::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionGeneratePdf() {

        $session = new CHttpSession;
        $session->open();
        Yii::import('application.modules.admin.extensions.giiplus.bootstrap.*');
        require_once(Yii::getPathOfAlias('common') . '/extensions/tcpdf/tcpdf.php');
        require_once(Yii::getPathOfAlias('common') . '/extensions/tcpdf/config/lang/eng.php');

        if (isset($session['UserMessage_records'])) {
            $model = $session['UserMessage_records'];
        }
        else
            $model = UserMessage::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan UserMessage');
        $pdf->SetSubject('Laporan UserMessage Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" UserMessage, "");
        $pdf->SetHeaderData("", "", "Laporan UserMessage", "");
        $pdf->setHeaderFont(Array('helvetica', '', 8));
        $pdf->setFooterFont(Array('helvetica', '', 6));
        $pdf->SetMargins(15, 18, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->SetFont('dejavusans', '', 7);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->LastPage();
        $pdf->Output("UserMessage_002.pdf", "I");
    }

}
