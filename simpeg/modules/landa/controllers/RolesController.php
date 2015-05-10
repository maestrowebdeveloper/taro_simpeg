<?php

class RolesController extends Controller {

    public $breadcrumbs;
    public $layout = '//layouts/main';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // c
                'actions' => array('create'),
                'expression' => 'app()->controller->isValidAccess("groupUser","c")',
                'expression' => 'app()->controller->isValidAccess("groupSupplier","c")',
                'expression' => 'app()->controller->isValidAccess("groupVendor","c")',                
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("groupUser","r")',
                'expression' => 'app()->controller->isValidAccess("groupSupplier","r")',
                'expression' => 'app()->controller->isValidAccess("groupVendor","r")',
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("groupUser","u")',
                'expression' => 'app()->controller->isValidAccess("groupSupplier","u")',
                'expression' => 'app()->controller->isValidAccess("groupVendor","u")',
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("groupUser","d")',
                'expression' => 'app()->controller->isValidAccess("groupSupplier","d")',
                'expression' => 'app()->controller->isValidAccess("groupVendor","d")',
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $type = !empty($_GET['type'])?$_GET['type']:'user';
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'type' => $type,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Roles;
        $siteConfig = SiteConfig::model()->findByPk(param('id'));
//        $siteConfig = SiteConfig::model()->listSiteConfig();
        $type = !empty($_GET['type'])?$_GET['type']:'user';
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Roles'])) {
            $model->attributes = $_POST['Roles'];
            if ($type == 'user') {
                $model->attributes = $_POST['Roles'];
            }
            if ($model->save()) {
                $this->saveRolesAuth($model->id);

                //clear session roles
                unset(Yii::app()->session['listRoles']);

                if ($type == 'customer') {
                    $customer = json_decode($siteConfig->roles_customer, true);
                    if (isset($customer)) {
                        array_push($customer, $model->id);
                    } else {
                        $customer = array($model->id);
                    }

                    $siteConfig->roles_customer = json_encode($customer);
                } elseif ($type == 'contact') {
                    $contact = json_decode($siteConfig->roles_contact, true);
                    if (isset($contact)) {
                        array_push($contact, $model->id);
                    } else {
                        $contact = array($model->id);
                    }
                    $siteConfig->roles_contact = json_encode($contact);
                } elseif ($type == 'supplier') {
                    $supplier = json_decode($siteConfig->roles_supplier, true);
                    if (isset($supplier)) {
                        array_push($supplier, $model->id);
                    } else {
                        $supplier = array($model->id);
                    }
                    $siteConfig->roles_supplier = json_encode($supplier);
                } elseif ($type == 'vendor') {
                    $vendor = json_decode($siteConfig->roles_vendor, true);
                    if (isset($vendor)) {
                        array_push($vendor, $model->id);
                    } else {
                        $vendor = array($model->id);
                    }
                    $siteConfig->roles_vendor = json_encode($vendor);
                } elseif ($type == 'employment') {
                    $employment = json_decode($siteConfig->roles_employment, true);
                    if (isset($employment)) {
                        array_push($employment, $model->id);
                    } else {
                        $employment = array($model->id);
                    }
                    $siteConfig->roles_employment = json_encode($employment);
                } elseif ($type == 'teacher') {
                    $teacher = json_decode($siteConfig->roles_teacher, true);
                    if (isset($teacher)) {
                        array_push($teacher, $model->id);
                    } else {
                        $teacher = array($model->id);
                    }
                    $siteConfig->roles_teacher = json_encode($teacher);
                } elseif ($type == 'student') {
                    $student = json_decode($siteConfig->roles_student, true);
                    if (isset($student)) {
                        array_push($student, $model->id);
                    } else {
                        $student = array($model->id);
                    }
                    $siteConfig->roles_student = json_encode($student);
                } elseif ($type == 'guest') {
                    $guest = json_decode($siteConfig->roles_guest, true);
                    if (isset($guest)) {
                        array_push($guest, $model->id);
                    } else {
                        $guest = array($model->id);
                    }
                    $siteConfig->roles_guest = json_encode($guest);
                }elseif ($type == 'client') {
                    $client = json_decode($siteConfig->roles_client, true);
                    if (isset($client)) {
                        array_push($client, $model->id);
                    } else {
                        $client = array($model->id);
                    }
                    $siteConfig->roles_client = json_encode($client);
                }
                $siteConfig->save();

                unset(Yii::app()->session['site']);
                $this->redirect(array('view', 'id' => $model->id, 'type' => $type));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'type' => $type,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $type = !empty($_GET['type'])?$_GET['type']:'user';
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Roles'])) {
            $model->attributes = $_POST['Roles'];
            if ($model->save()) {
                //delete roles auth
                RolesAuth::model()->deleteAll(array('condition' => 'roles_id=' . $model->id));
                $this->saveRolesAuth($model->id);

                //clear session roles
                unset(Yii::app()->session['listRoles']);
                $this->redirect(array('view', 'id' => $model->id, 'type' => $type));
            }
            unset(Yii::app()->session['site']);
        }

        $this->render('update', array(
            'model' => $model,
            'type' => $type,
        ));
    }

    public function saveRolesAuth($roles_id) {
        if (isset($_POST['auth_id'])) {
            foreach ($_POST['auth_id'] as $arrAuth) {
                $crud = array();
                if (isset($_POST[$arrAuth]['c']))
                    $crud['c'] = 1;
                if (isset($_POST[$arrAuth]['r']))
                    $crud['r'] = 1;
                if (isset($_POST[$arrAuth]['u']))
                    $crud['u'] = 1;
                if (isset($_POST[$arrAuth]['d']))
                    $crud['d'] = 1;

                if (count($crud) > 0) {
                    $mRolesAuth = new RolesAuth();
                    $mRolesAuth->roles_id = $roles_id;
                    $mRolesAuth->auth_id = $arrAuth;
                    $mRolesAuth->crud = json_encode($crud);
                    $mRolesAuth->save();
                }
            }
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id, $type = 'user') {
        $siteConfig = SiteConfig::model()->listSiteConfig();


        if (Yii::app()->request->isPostRequest) {

            $siteConfig = SiteConfig::model()->findByPk(1);


            if ($type == 'customer') {
                $customer = json_decode($siteConfig->roles_customer, true);
                $customer = array_diff($customer, array($id));
                $siteConfig->roles_customer = json_encode($customer);
            } elseif ($type == 'contact') {
                $contact = json_decode($siteConfig->roles_contact, true);
                $contact = array_diff($contact, array($id));
                $siteConfig->roles_contact = json_encode($contact);
            } elseif ($type == 'supplier') {
                $supplier = json_decode($siteConfig->roles_supplier, true);
                $supplier = array_diff($supplier, array($id));
                $siteConfig->roles_supplier = json_encode($supplier);
            } elseif ($type == 'vendor') {
                $vendor = json_decode($siteConfig->roles_vendor, true);
                $vendor = array_diff($vendor, array($id));
                $siteConfig->roles_vendor = json_encode($vendor);
            } elseif ($type == 'teacher') {
                $teacher = json_decode($siteConfig->roles_teacher, true);
                $teacher = array_diff($teacher, array($id));
                $siteConfig->roles_teacher = json_encode($teacher);
            } elseif ($type == 'student') {
                $student = json_decode($siteConfig->roles_student, true);
                $student = array_diff($student, array($id));
                $siteConfig->roles_student = json_encode($student);
            } elseif ($type == 'guest') {
                $guest = json_decode($siteConfig->roles_guest, true);
                $guest = array_diff($guest, array($id));
                $siteConfig->roles_guest = json_encode($guest);
            }elseif ($type == 'client') {
                $client = json_decode($siteConfig->roles_client, true);
                $client = array_diff($student, array($id));
                $siteConfig->roles_client = json_encode($client);
            }

            $siteConfig->save();

            //delete roles auth
            RolesAuth::model()->deleteAll(array('condition' => 'roles_id=' . $id));


            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            unset(Yii::app()->session['site']);
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    function Delete($id,$type){
        $siteConfig = SiteConfig::model()->findByPk(1);
            if ($type == 'customer') {
                $customer = json_decode($siteConfig->roles_customer, true);
                $customer = array_diff($customer, array($id));
                $siteConfig->roles_customer = json_encode($customer);
            } elseif ($type == 'contact') {
                $contact = json_decode($siteConfig->roles_contact, true);
                $contact = array_diff($contact, array($id));
                $siteConfig->roles_contact = json_encode($contact);
            } elseif ($type == 'supplier') {
                $supplier = json_decode($siteConfig->roles_supplier, true);
                $supplier = array_diff($supplier, array($id));
                $siteConfig->roles_supplier = json_encode($supplier);
            } elseif ($type == 'vendor') {
                $vendor = json_decode($siteConfig->roles_vendor, true);
                $vendor = array_diff($vendor, array($id));
                $siteConfig->roles_vendor = json_encode($vendor);
            } elseif ($type == 'member') {
                $member = json_decode($siteConfig->roles_member, true);
                $member = array_diff($member, array($id));
                $siteConfig->roles_vendor = json_encode($member);
            } elseif ($type == 'teacher') {
                $teacher = json_decode($siteConfig->roles_teacher, true);
                $teacher = array_diff($teacher, array($id));
                $siteConfig->roles_teacher = json_encode($teacher);
            } elseif ($type == 'student') {
                $student = json_decode($siteConfig->roles_student, true);
                $student = array_diff($student, array($id));
                $siteConfig->roles_student = json_encode($student);
            } elseif ($type == 'guest') {
                $guest = json_decode($siteConfig->roles_guest, true);
                $guest = array_diff($guest, array($id));
                $siteConfig->roles_guest = json_encode($guest);
            }elseif ($type == 'client') {
                $client = json_decode($siteConfig->roles_client, true);
                $client = array_diff($student, array($id));
                $siteConfig->roles_client = json_encode($client);
            }

            $siteConfig->save();

            //delete roles auth
            RolesAuth::model()->deleteAll(array('condition' => 'roles_id=' . $id));


            $this->loadModel($id)->delete();
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
                $type = (isset($_POST['type']))?$_POST['type']:'user';
                foreach ($_POST['ceckbox'] as $data) {                     
                    $this->delete($data,$type);     
                }
        }

        $this->redirect(url('landa/roles/user'));
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];

            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'index'
        ));
    }
    
    public function actionClient() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
//        $siteConfig = SiteConfig::model()->listSiteConfig();
//        $rolescust = json_decode($siteConfig->roles_customer, true);
//        $customer="";
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];
//            $customer = $_GET['Roles']['$rolescust'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'client',
        ));
    }

    public function actionUser() {
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
                $type = (isset($_POST['type']))?$_POST['type']:'user';
                foreach ($_POST['ceckbox'] as $data) {                     
                    $this->delete($data,$type);     
                }
        }

        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'user'
        ));
    }

    public function actionCustomer() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
//        $siteConfig = SiteConfig::model()->listSiteConfig();
//        $rolescust = json_decode($siteConfig->roles_customer, true);
//        $customer="";
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];
//            $customer = $_GET['Roles']['$rolescust'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'customer',
        ));
    }

    public function actionContact() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
//        $siteConfig = SiteConfig::model()->listSiteConfig();
//        $rolescust = json_decode($siteConfig->roles_customer, true);
//        $customer="";
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];
//            $customer = $_GET['Roles']['$rolescust'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'contact',
        ));
    }

    public function actionSupplier() {
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
                $type = (isset($_POST['type']))?$_POST['type']:'user';
                foreach ($_POST['ceckbox'] as $data) {                     
                    $this->delete($data,$type);     
                }
        }

        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
//        $siteConfig = SiteConfig::model()->listSiteConfig();
//        $rolescust = json_decode($siteConfig->roles_customer, true);
//        $customer="";
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];
//            $customer = $_GET['Roles']['$rolescust'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'supplier',
        ));
    }

     public function actionVendor() {
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
                $type = (isset($_POST['type']))?$_POST['type']:'user';
                foreach ($_POST['ceckbox'] as $data) {                     
                    $this->delete($data,$type);     
                }
        }

        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes(); 
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];

            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);
        $this->render('index', array(
            'model' => $model,
            'type' => 'vendor',
        ));
    }

    public function actionEmployment() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
//        $siteConfig = SiteConfig::model()->listSiteConfig();
//        $rolescust = json_decode($siteConfig->roles_customer, true);
//        $customer="";
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];
//            $customer = $_GET['Roles']['$rolescust'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'employment',
        ));
    }

    public function actionTeacher() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
//        $siteConfig = SiteConfig::model()->listSiteConfig();
//        $rolescust = json_decode($siteConfig->roles_customer, true);
//        $customer="";
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];
//            $customer = $_GET['Roles']['$rolescust'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'teacher',
        ));
    }

    public function actionStudent() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
//        $siteConfig = SiteConfig::model()->listSiteConfig();
//        $rolescust = json_decode($siteConfig->roles_customer, true);
//        $customer="";
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];
//            $customer = $_GET['Roles']['$rolescust'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'student',
        ));
    }

    public function actionGuest() {
        $session = new CHttpSession;
        $session->open();
        $criteria = new CDbCriteria();

        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
//        $siteConfig = SiteConfig::model()->listSiteConfig();
//        $rolescust = json_decode($siteConfig->roles_customer, true);
//        $customer="";
        if (isset($_GET['Roles'])) {
            $model->attributes = $_GET['Roles'];
//            $customer = $_GET['Roles']['$rolescust'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->is_allow_login))
                $criteria->addCondition('is_allow_login = "' . $model->is_allow_login . '"');
        }
        $session['Roles_records'] = Roles::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
            'type' => 'guest',
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Roles('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Roles']))
            $model->attributes = $_GET['Roles'];

        $this->render('admin', array(
            'model' => $model,
            'customer' => $customer,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Roles::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'roles-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Roles_records'])) {
            $model = $session['Roles_records'];
        }
        else
            $model = Roles::model()->findAll();


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

        if (isset($session['Roles_records'])) {
            $model = $session['Roles_records'];
        }
        else
            $model = Roles::model()->findAll();



        $html = $this->renderPartial('expenseGridtoReport', array(
            'model' => $model
                ), true);

        //die($html);

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Yii::app()->name);
        $pdf->SetTitle('Laporan Roles');
        $pdf->SetSubject('Laporan Roles Report');
        //$pdf->SetKeywords('example, text, report');
        $pdf->SetHeaderData('', 0, "Report", '');
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "Laporan" Roles, "");
        $pdf->SetHeaderData("", "", "Laporan Roles", "");
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
        $pdf->Output("Roles_002.pdf", "I");
    }

}
