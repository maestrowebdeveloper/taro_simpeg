<div class="nextMessage"></div>
<?php
$listUser = User::model()->listUser();
//trace($listUser);
foreach ($userMessageDetails as $userMessageDetail):
    $type = ($userMessageDetail->created_user_id == user()->id) ? 'admin' : 'user';
    $name = $listUser[$userMessageDetail->created_user_id]['name'];

    $img = Yii::app()->landa->urlImg('avatar/', $listUser[$userMessageDetail->created_user_id]['avatar_img'], $userMessageDetail->created_user_id);


    $this->renderPartial('_viewDetailLi', array('type' => $type, 'userMessageDetail' => $userMessageDetail, 'img' => $img, 'name' => $name));
endforeach;
?>

<div class="msgDetLoad"></div>
<?php
$this->widget('common.extensions.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '.msgDetLoad',
    'itemSelector' => 'li.msgDet',
    'donetext' => '-- this is the end of data --',
    'pages' => $pages,
));
?>

