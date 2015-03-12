<div class="nextMessage"></div>
<?php
$listUser = User::model()->listUser();
//trace($listUser);
foreach ($ticketDetails as $ticketDetail):
    $type = ($ticketDetail->created_user_name == user()->id) ? 'admin' : 'user';
    $name = $listUser[$ticketDetail->created_user_name]['name'];

//    $img = Yii::app()->landa->urlImg('avatar/', $listUser[$userMessageDetail->created_user_id]['avatar_img'], $userMessageDetail->created_user_id);
    $this->renderPartial('_viewDetailLi', array('type' => $type, 'ticketDetail' => $ticketDetail,  'name' => $name));
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

