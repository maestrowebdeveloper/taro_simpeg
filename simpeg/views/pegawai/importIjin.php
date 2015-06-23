<div class="row-fluid">
    <div class="span6">
        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon16 entypo-icon-write"></span>
                    <span>Import Kenaikan Pangkat</span>
                </h4>
            </div>
            <div class="content">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'User-form',
                    'enableAjaxValidation' => false,
                    'method' => 'post',
                    'type' => 'horizontal',
                    'htmlOptions' => array(
                        'enctype' => 'multipart/form-data'
                    )
                ));
                echo $form->fileFieldRow($model, 'modified', array('class' => 'span12'));
                echo '<a href="'.param('pathImg').'contoh_import_pangkat.xls" class="btn btn-success">Download Format</a>&nbsp;&nbsp;&nbsp;';
                echo '<input type="hidden" name="kenaikan">';
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'icon' => 'upload white',
                    'label' => 'Proses Upload',
                ));

                $this->endWidget();
                ?>
                <ol>
                    <li>Proses ini akan memakan waktu lama, harap bersabar untuk melakukan proses ini</li>
                    <li>Menu ini dipergunakan untuk insert kedalam riwayat pangkat pegawai secara massal</li>
                    <li>Pastikan yang terisi di excel hanya data kenaikan pangkat baru dari pegawai</li>
                </ol>


            </div>

        </div>
    </div>
    
</div>