
<li class="<?php echo $type ?> clearfix h<?php echo $userMessageDetail->id ?> msgDet">
    <form action="/berkas-buat-pesan/" method="post">
        <a href="#" class="avatar">
            <img src="<?php echo $img['small'] ?>" width="40" class="img-polaroid"/>
        </a>
        <div class="message">
            <div class="head clearfix">
                <span class="name"><strong><?php echo $name ?></strong> says : </span>
                <span class="time">
                    <?php
                    echo CHtml::ajaxLink(
                            '<i class="icon-trash"></i>', url('userMessageDetail/delete', array('id' => $userMessageDetail->id)), array(// ajaxOptions
                        'type' => 'POST',
                        'success' => 'function( data )
                                        {
                                          $(".h' . $userMessageDetail->id . '").fadeOut();
                                        }',
                            )
                    );
                    ?>
                </span>
            </div>
            <input type="hidden" name="isi_pesan" id="isi_pesan" value="{messages}"/>

<?php echo $userMessageDetail->message ?>
            <br/><small>-- <?php echo Yii::app()->landa->ago($userMessageDetail->created) ?> --</small>
        </div>
    </form>
</li>



