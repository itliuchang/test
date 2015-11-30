<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no"> -->
      <meta name="viewport" content="initial-scale=1.1,user-scalable=no">
	    <title><?php echo $this->pageTitle ?></title>
      <link rel="stylesheet" type="text/css" href="/css/all.css">
      <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    </head>
    
    <body>
	    <?php echo $content ?>

      <!-- ModalBox -->
      <div id="prompt" data-toggle="popover" data-container="#prompt" data-placement="top"></div>
      
      <!-- <div class="modal fade" id="tipModal" role="dialog" data-type="success" data-keyboard="false" data-backdrop="false"> -->
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

      <script type="text/javascript" src="/js/all.js"></script>
    </body>
</html>