# warthog
Simple web app for creating diagrams for the Warthog HOTAS

I found myself in need of diagrams for DCS and Elite: Dangerous for my Warthog HOTAS, but especially Elite: Dangerous since it's such a chore to slowboat through the input controls to scribble down all the bindings. I made the above application in a couple of days, and it initially was just going to be a tool for my own use, but it seemed like it might be useful so I took it a little further to make it usable by others.

A couple of people have requested the source code, so here it is. I built this using CodeIgniter, a PHP framework. In retrospect, this was probably massive overkill, but it's efficient and lightweight, so not a big deal. (I use CodeIgniter for most projects like this just out of habit.)

The source tree may look daunting, but 99% of it is either CodeIgniter, jQuery, or Dropzone, which wasn't even written by me. The actual source code of the diagram builder is limited to handful of files:

/application/controllers/home.php
/application/views/controls.php
/application/views/upload.php
/css/controls.css
/images/stick.png
/images/throttle.png
/js/controls.js
/blank.txt
/controls.json