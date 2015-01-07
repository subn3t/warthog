<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Thrustmaster HOTAS Warthog Bindings</title>
  <link rel="stylesheet" href="css/controls.css">
</head>

<body>

  <input id="export" type="button" value="Export (Chrome only)"/>
  <input id="print" type="button" value="Print"/>

  <?php if ($device == 'stick'): ?>
  <div id="stick" class="stick">
    <div class="label Joy_1"></div>
    <div class="label Joy_2"></div>
    <div class="label Joy_3"></div>
    <div class="label Joy_4"></div>
    <div class="label Joy_5"></div>
    <div class="label Joy_6"></div>
    <div class="label Joy_7"></div>
    <div class="label short Joy_8"></div>
    <div class="label Joy_9"></div>
    <div class="label Joy_10"></div>
    <div class="label Joy_11"></div>
    <div class="label short Joy_12"></div>
    <div class="label Joy_13"></div>
    <div class="label Joy_14"></div>
    <div class="label Joy_15"></div>
    <div class="label short Joy_16"></div>
    <div class="label Joy_17"></div>
    <div class="label Joy_18"></div>
    <div class="label Joy_19"></div>
    <div class="label short Joy_POV1Up"></div>
    <div class="label short Joy_POV1Down"></div>
    <div class="label short Joy_POV1Left"></div>
    <div class="label short Joy_POV1Right"></div>
  </div>
  <?php endif ?>

  <?php if ($device == 'throttle'): ?>
  <div id="throttle" class="throttle">
    <div class="label Joy_1"></div>
    <div class="label size3 Joy_2"></div>
    <div class="label size3 Joy_3"></div>
    <div class="label size4 Joy_4"></div>
    <div class="label size3 Joy_5"></div>
    <div class="label size3 Joy_6"></div>
    <div class="label size2 Joy_7"></div>
    <div class="label size2 Joy_8"></div>
    <div class="label size2 Joy_9"></div>
    <div class="label size2 Joy_10"></div>
    <div class="label size2 Joy_11"></div>
    <div class="label size2 Joy_12"></div>
    <div class="label Joy_13"></div>
    <div class="label Joy_14"></div>
    <div class="label Joy_15"></div>
    <div class="label Joy_16"></div>
    <div class="label Joy_17"></div>
    <div class="label Joy_18"></div>
    <div class="label Joy_19"></div>
    <div class="label Joy_20"></div>
    <div class="label Joy_21"></div>
    <div class="label Joy_22"></div>
    <div class="label Joy_23"></div>
    <div class="label Joy_24"></div>
    <div class="label Joy_25"></div>
    <div class="label Joy_26"></div>
    <div class="label Joy_27"></div>
    <div class="label Joy_28"></div>
    <div class="label size1 Joy_29"></div>
    <div class="label size1 Joy_30"></div>
    <div class="label Joy_31"></div>
    <div class="label Joy_32"></div>
    <div class="label Joy_POV1Up"></div>
    <div class="label Joy_POV1Down"></div>
    <div class="label Joy_POV1Left"></div>
    <div class="label Joy_POV1Right"></div>
  </div>
  <?php endif ?>

  <script type="text/javascript">

  <?php if (isset($labels)): ?>
  var labels = <?= json_encode($labels) ?>;
  <?php endif ?>

  <?php if (isset($controls)): ?>
  var controls = <?= json_encode($controls) ?>;
  <?php endif ?>

  <?php if (isset($import)): ?>
  var file = <?= json_encode($import) ?>;
  <?php endif ?>

  </script>

  <script src="js/jquery.js"></script>
  <script src="js/controls.js"></script>

</body>
</html>