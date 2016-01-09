<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no"> -->
      <meta name="viewport" content="initial-scale=1.1,user-scalable=no">
	    <title><?php echo $this->pageTitle ?></title>
      <link rel="stylesheet" type="text/css" href="/css/m/all.css?v=1">
      <!-- <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" /> -->
      <script type="text/javascript">
        var systemVar = {
          isGuest: <?php echo Yii::app()->user->isGuest? 1 : 0 ?>,
          controller: '<?php echo $this->id ?>', action: '<?php echo $this->action->id ?>',
          uid: <?php echo Yii::app()->user->isGuest? 0 : Yii::app()->user->id ?>
        };
      </script>
    </head>
    
    <body class="<?php echo $this->bodyCss ?>">
	    <?php echo $content ?>
      <input type="hidden" id="_csrftoken" value="<?php echo Yii::app()->request->csrfToken ?>">
      <div class="modal fade" id="tipModal" role="dialog" data-type="success" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog" data-verticalAlign="true">
              <div class="modal-content">
                  <div class="modal-body">
                      <div class="tip-form">
                          <div class="hint">保存成功</div>
                          <div class="icon"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    <script src="/js/all.js"></script>
    </body>
</html>