<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Thrustmaster HOTAS Warthog Bindings</title>
  <link rel="stylesheet" href="css/basic.css">
  <link rel="stylesheet" href="css/dropzone.css">
  <link rel="stylesheet" href="css/jquery-ui.min.css">

  <style type="text/css">

    body {
      font-family: "Trebuchet MS", Helvetica, sans-serif;
    }

    #drop {
      width: 100px;
      height: 100px;
      background-color: red;
    }

    .title {
      text-align: center;
      font-size: 36px;
      margin: 35px 0 15px;
    }

    .content {
      text-align: center;
      margin: 0 0 20px 0;
    }

    .container {
      width: 860px;
      margin: 0 auto;
    }

    .buttons {
      text-align: center;
      margin: 0 0 30px 0;
    }

    .footer {
      cursor: pointer;
      margin-top: 20px;
      color: #999;
      display: flex;
      justify-content: center; /* align horizontal */
      align-items: center; /* align vertical */
      font-size: 24px;
    }

  </style>

</head>

<body>

<div class="container">

  <div class="title">Warthog Diagram Builder</div>

  <div class="content">
    Select one of the following templates or upload an existing diagram file.
    <br/>You may also upload Elite: Dangerous *.binds files
  </div> 

  <div class="buttons">
    <input type="button" id="blankTemplate" value="Blank Template" style="margin-right: 45px;"/>
    <input type="button" id="EDDefault" value="Elite: Dangerous Defaults"/>
  </div>

  <form action="home/upload" class="dropzone" id="file-upload"></form>

  <div class="footer">
    <img src="images/chrome.png" style="width: 32px; height: 32px;"/>
    &nbsp;&nbsp;Google Chrome recommended
  </div>

</div>

<form action="" method="post" id="fileForm">
  <input type="hidden" id="fileData" name="fileData"/>
  <input type="hidden" id="template" name="template"/>
  <input type="hidden" id="device" name="device"/>
</form>

<div id="dialog" title="Select device">Please select a device.</div>

<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/dropzone.js"></script>
<script type="text/javascript">

var currentFile;

Dropzone.options.fileUpload = {
  maxFiles: 1,
  autoProcessQueue: false,
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  accept: function(file, done) {
    if (file.name.substr(-6) == '.binds') {
      currentFile = file;
      $('#dialog').dialog('open');
    }
    else {
      uploadFile(file);
    }
  }
};
  
$(function() {

  $('.footer').click(function() {
    window.location.href = 'http://www.google.com/chrome/';
  });

  $('#fileData').val('');
  $('#template').val('');
  $('#device').val('');

  $('#dialog').dialog({
    autoOpen: false,
    modal: true,
    close: function() {
      if (currentFile) {
        window.location.reload();
      }
    },
    buttons: {
      Stick: function() {
        $('#device').val('stick');
        dialogSelect();
      },
      Throttle: function() {
        $('#device').val('throttle');
        dialogSelect();
      }
    }
  })

  $('input[type=button]').button();

  $('#defaultControls').click(function () {
    $('#template').val('default');
    $('#dialog').dialog('open');
  });

  $('#blankTemplate').click(function () {
    $('#template').val('blank');
    $('#dialog').dialog('open');
  });

  $('#EDDefault').click(function () {
    $('#template').val('ed');
    $('#dialog').dialog('open');
  });

});

function uploadFile(file) {
  var reader = new FileReader();
  reader.onload = function(e) {
    $('#fileData').val(e.target.result);
    $('#fileForm').submit();
  }
  reader.readAsDataURL(file);
}

function dialogSelect() {
  if (currentFile) {
    uploadFile(currentFile);
  }
  else {
    $('#fileForm').submit();
  }
}

</script>


</body>
</html>