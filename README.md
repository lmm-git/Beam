Beam
====

Please note: This software is curerently under development and there aren't all required software at the moment!

Requirements (hardware)
-----------------------
* Computer at the Beamer: We develop our controller on a Raspberry Pi Version B Rev. 2 (with ethernet, 512MB RAM and Raspian). We use the GPU for display videos, so if you want to use another computer you should be sure that mplayer can decode all videos you wish.
* Beamer: It's planned to control beamers with PJLink. For stages it would be great thet the beamers have a shutter.
* Server: A fast running Apache, a MySQL database, running PJLink on server and the Zikula Application Framework (perfectly installed ;) ).
* Clients: Clients should have a easy webbrowser to access the internal Zikula site.
* A fast network to connect all (as best a own subnet).
We suggest to use Raspian for your Rasperry Pi's and Ubuntu for your clients/thin clients and main server.


Installation of Raspberry Pi (as Controller)
--------------------------------------------
* get the newest version of Raspian and image it to a (at minimum) 4GB SD-Card
* on first start set the following settings in raspi-config: Overclocking -> 950MHz; Please don't forget expand-rootfs for further Software
* now install the gstreamer omx-plugin. For this step please look in your repositories or - at the moment this manual was written - install it by compiling it yourself. (Download source at gstreamer.freedesktop.org/download)
* Further steps coming soon
* For exactly description, scripts and further information please look at /doc/Hardware/Controller/RasPi/

More information coming soon.
