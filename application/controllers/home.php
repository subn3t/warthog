<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	public function index()
	{
		// $_POST['template'] = 'ed';
		// $_POST['device'] = 'stick';

		$labels = 'controls.json';
		$EDDefaults = 'ThrustMasterHOTASWarthog.binds';

		if (!$_POST) {
			$this->load->view('upload');
			return;
		}

		if ($template = $this->input->post('template')) {
			if ($template == 'default' || $template == 'blank') {
				$fileData = file_get_contents("$template.txt");
			}
			elseif ($template == 'ed') {
				$fileData = file_get_contents($EDDefaults);
			}
		}
		elseif ($fileData = $this->input->post('fileData')) {
			list($header, $fileData) = explode(',', $fileData);
			// $fileData = str_replace(' ', '+', $fileData);
			$fileData = base64_decode($fileData);
		}
		else {
			return;
		}

		if ($this->is_xml($fileData)) {
			$data['labels'] = json_decode(file_get_contents($labels));
			$data['controls'] = $this->parse_data($fileData);
		}
		else {
			$data['import'] = explode("\r\n", $fileData);
			if (!$_POST['device']) {
				foreach ($data['import'] as $line) {
					$char = substr(trim($line), 0, 1);
					if ($char == '#') {
						continue;
					}
					else {
						$_POST['device'] = strtolower($char) == 's' ? 'stick' : 'throttle';
						break;
					}
				}
			}
		}

		$data['device'] = $this->input->post('device');
		$this->load->view('controls', $data);
	}

	private function parse_data($xml)
	{
		$xml = simplexml_load_string($xml);

		$layers = array('Primary', 'Secondary');
		$devices = array('ThrustMasterWarthogJoystick', 'ThrustMasterWarthogThrottle');

		$controls = array();
		foreach ($devices as $device) {
			$controls[$device] = array();
		}

		foreach ($xml as $k1 => $v1) {
			foreach ($layers as $layer) {
				$device = (string) $v1->{$layer}['Device'];
				$key = (string) $v1->{$layer}['Key'];
				if (in_array($device, $devices)) {
					$controls[$device][$key] = $k1;
				}
			}
		}

		foreach ($devices as $device) {
			$controls[$device] = (object) $controls[$device];
		}
		
		return (object) $controls;
	}

	private function is_xml($fileData) 
	{
		$xml = @simplexml_load_string($fileData);
		return !!$xml;
	}

	public function temp()
	{
		$re = "/(.*){ top: (\d+)px; left: (\d+)px; }/";
		$css = file_get_contents('temp.txt');
		$css = explode("\r\n", $css);
		// exit('<pre>' . print_r($css, true) . '</pre>');
		$out = '';
		foreach ($css as $line) {
			preg_match_all($re, $line, $matches);
			// exit('<pre>' . print_r($matches, true) . '</pre>');
			$out .= $matches[1][0] . '{ top: ' . floor($matches[2][0] / 2) . 'px; left: ' 
			. ceil($matches[3][0] / 2) . "px; }\r\n";
		}
		file_put_contents('out.txt', $out);
	}
}