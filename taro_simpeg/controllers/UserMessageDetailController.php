<?php

class UserMessageDetailController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new UserMessageDetail;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserMessageDetail'])) {
            //$modelUserMessage = UserMessage::model()->find(array('condition' => 'created_user_id=' . app()->user->id . ' AND receiver_user_ids=\'' . json_encode($_POST['receiver_user_ids']) . '\''));
            
            UserMessage::model()->insertMsg($_POST['receiver_user_ids'] , app()->user->id);
            $id = UserMessage::model()->insertMsg(app()->user->id , $_POST['receiver_user_ids']);

            $this->redirect(url('userMessage/view', array('id' => $id['UserMessageId'])));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionCreateDetail() {
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UserMessageDetail'])) {
            
            UserMessage::model()->insertMsg($_POST['user_id_opp'] , app()->user->id);
            $id = UserMessage::model()->insertMsg(app()->user->id , $_POST['user_id_opp']);
            //update usermessage
//            $modelUserMessage = UserMessage::model()->findByPk($_POST['UserMessageDetail']['user_message_id']);
//            $modelUserMessage->last_date = date('Y-m-d H:i');
//            $modelUserMessage->last_message = $_POST['UserMessageDetail']['message'];
//            $modelUserMessage->count_messages += 1;
//            $modelUserMessage->is_read = false;
////            $modelUserMessage->is_sender = (app()->user->id == $modelUserMessage->created_user_id) ? false : true;
//            $modelUserMessage->save();
//
//            //insert new record user message detail
//            $model = new UserMessageDetail;
//            $model->attributes = $_POST['UserMessageDetail'];
//            $model->save();

            //render new li
            $model = $this->loadModel($id['UserMessageDetailId']);
            $listUser = User::model()->listUser();
            $type = 'admin';
            $name = $listUser[app()->user->id]['name'];
            $img = Yii::app()->landa->urlImg('avatar/', $listUser[app()->user->id]['avatar_img'], app()->user->id);

            echo '<div class="nextMessage"></div>';
            $this->renderPartial('/userMessage/_viewDetailLi', array('type' => $type, 'userMessageDetail' => $model, 'img' => $img, 'name' => $name));
        }
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

        if (isset($_POST['UserMessageDetail'])) {
            $model->attributes = $_POST['UserMessageDetail'];
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
//            if (!isset($_GET['ajax']))
//                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
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

        $model = new UserMessageDetail('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['UserMessageDetail'])) {
            $model->attributes = $_GET['UserMessageDetail'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->user_message_id))
                $criteria->addCondition('user_message_id = "' . $model->user_message_id . '"');


            if (!empty($model->title))
                $criteria->addCondition('title = "' . $model->title . '"');


            if (!empty($model->message))
                $criteria->addCondition('message = "' . $model->message . '"');


            if (!empty($model->is_sender))
                $criteria->addCondition('is_sender = "' . $model->is_sender . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');
        }
        $session['UserMessageDetail_records'] = UserMessageDetail::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new UserMessageDetail('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UserMessageDetail']))
            $model->attributes = $_GET['UserMessageDetail'];

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
        $model = UserMessageDetail::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-message-detail-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['UserMessageDetail_records'])) {
            $model = $session['UserMessageDetail_records'];
        }
        else
            $model = UserMessageDetail::model()->findAll();


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

        if (isset($session['UserMessageDetail_records'])) {
            $model = $session['UserMessageDetail_records'];
        }
        else
            $model = UserMessageDetail::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan UserMessageDetail');
        $pdf->SetSubject('Laporan UserMessageDetail Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" UserMessageDetail, "");
        $pdf->SetHeaderData("", "", "Laporan UserMessageDetail", "");
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
        $pdf->Output("UserMessageDetail_002.pdf", "I");
    }

}
