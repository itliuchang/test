<!DOCTYPE html>
<html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- <meta name="viewport" content="width=device-width, maximum-scale=1.0, user-scalable=no"> -->
      <meta name="viewport" content="initial-scale=1.1,user-scalable=no">
      <title><?php echo $this->pageTitle ?></title>
      <link rel="stylesheet" type="text/css" href="/css/all.css">
      <link rel="stylesheet" type="text/css" href="/css/error.css">
      <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    </head>
    
    <body>
      <div id="container">    
          <div id="main" class="clearfix">
              <?php echo $content; ?>
          </div>
      </div>
      <script type="text/javascript" src="/js/all.js"></script>
    </body>
</html>