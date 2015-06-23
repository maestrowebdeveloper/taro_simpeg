<div class="form">
  
    <fieldset>                      
        <?php
        $this->widget('common.extensions.EAjaxUpload.EAjaxUpload', array(
            'id' => 'primary_image',
            'config' => array(
                'action' => Yii::app()->createUrl('honorer/upload/' . $model->id),
                'allowedExtensions' => array("jpg", "jpeg", "gif", "png", "gif","doc","docx","xls","xlsx","ppt","pptx","pdf","zip", "rar"), //array("jpg","jpeg","gif","exe","mov" and etc...
                'sizeLimit' => 2 * 1024 * 1024, // maximum file size in bytes
                'minSizeLimit' => 10 * 10 * 10, // minimum file size in bytes
                'multiple' => true,                
            ),

        ));
        ?>          
    </fieldset>


    <br/>
        <div class="well">
            <ul>
                <li>Untuk melakukan multiple upload file, drag file secara bersamaan ke dalam area tombol Upload</li>
                <li>Extensi yang diperbolehkan adalah <span class="label label-info">jpg, jpeg, gif, png, gif, doc, docx, xls, xlsx, pdf, ppt, pptx, zip, rar</span></li>                
                <li>Maxsimum per file 2 Mb</li>                
            </ul>

        </div>
</div>