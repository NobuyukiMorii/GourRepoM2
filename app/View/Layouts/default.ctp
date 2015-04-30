<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>GourRepo</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php echo $this->Html->css('bootstrap.min'); ?>
    <?php echo $this->Html->css('view-default/header'); ?>
    <?php echo $this->Html->css('view-default/serch-input.css'); ?>
    <?php echo $this->Html->css('view-default/flash'); ?>
    <?php echo $this->Html->css('view-default/body.css'); ?>
    <?php echo $this->Html->css('view-default/footer.css'); ?>
    <style>
.input-group-addon {

}
    </style>
  </head>
  <body>
  <!-- HEADER ============-->
  <div class="row">
    <div class="col-md-2 header">
      <?php echo $this->element('headerLogo'); ?>
      <?php echo $this->element('dropDownButton'); ?>
    </div>
    
    <?php echo $this->element('serchInput'); ?>
    <?php echo $this->element('movieUploadButton'); ?>
    <?php echo $this->element('profileImage'); ?>

  </div>
  <!-- /HEADER ============-->
  
  <!-- CONTENT ============-->
  <?php echo $this->Session->flash(); ?>
  <?php echo $this->fetch('content'); ?>

  <!-- 開発用に追加 -->
  <?php pr($userSession['role']) ;?>
  <?php pr($userSession['email']) ;?>
  <!-- CONTENT ============-->

  <!-- FOOTER ============-->
  <div class="row footer-area">
    <?php echo $this->element('footerLogo'); ?>
    <?php echo $this->element('footerConcept'); ?>
    <?php echo $this->element('footerCopyright'); ?>
  </div>
  <!-- /FOOTER ============-->

  <!-- script references -->
  <?php echo $this->Html->script('jquery-1.11.2.min');?>
  <?php echo $this->Html->script('bootstrap');?>
  <?php echo $this->Html->script('input-keypress');?>
  </body>
</html>

