$(function() {

	$('#export').click(function() {
		var text = "# Diagram specification for Thrustmaster HOTAS Warthog. Upload at http://subn3t.com/warthog to generate diagram.\r\n";
		$('.label').each(function() {
			text += $(this).parent().attr('class').capitalize() + ' ' + getControl(this) + ' ' + $(this).html() + "\r\n";
		});
		exportControls($('#stick').length ? 'WarthogStick.txt' : 'WarthogThrottle.txt', text);
	});	

	$('#print').click(function() {
		window.print();
	});

	if (!window.file) {
		$('.label').each(function() {
			var ctrl = getControl(this),
  				device = $(this).parent().hasClass('stick') ? 'ThrustMasterWarthogJoystick' : 'ThrustMasterWarthogThrottle',
  				label = ctrl in controls[device] ? labels[controls[device][ctrl]] : '';

			$(this).html(label);
		});
	}
	else {
		for (var i = 0; i < file.length; i++) {
      var line = $.trim(file[i]);
      if (!line || line.charAt(0) == '#') {
        continue;
      }
			var split = line.split(' '),
  				device = split.shift().toLowerCase(),
  				control = split.shift(),
  				label = split.join(' ');
			$('.' + device + ' .' + control).html(label);
		}
	}

	$('.label').click(function() {
		var input = $('<textarea></textarea>'),
  			width = $(this).css('width'),
  			height = $(this).css('height'),
  			top = $(this).css('top'),
  			left = $(this).css('left');

		input.html($(this).html());

		input.css({
			position: 'absolute',
			top: top,
			left: left,
			width: width,
			height: height
		});

		input.data({
			device: $(this).parent().attr('class'),
			control: getControl(this)
		});

		input.blur(function() {
			var data = $(this).data();
			$('.' + data.device + ' .' + data.control).html($(this).val());
			$(this).remove();
		});

		$(this).parent().append(input);
		input.focus();
		input.select();
	});

});

function getControl(label) {
	return $(label).attr('class').split(' ').pop();
}

function exportControls(filename, text) {
  var blob = new Blob([text], { type: 'text/plain' });
  var textUrl = URL.createObjectURL(blob);
  $('<a></a>').attr({
  	download: filename,
  	href: textUrl
  })[0].click();
}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}