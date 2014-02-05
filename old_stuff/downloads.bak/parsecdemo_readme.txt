
------------------------------------------------------------------------------
PARSEC SELF-RUNNING DEMO (build 0182)                      February 29, 2000.
------------------------------------------------------------------------------
mailto:parsec@parsec.org                               http://www.parsec.org/
------------------------------------------------------------------------------


------------------------------------------------------------------------------
1. INTRODUCTION
------------------------------------------------------------------------------

This is the Parsec self-running demo. It shows the current state of Parsec,
a 3D space-combat game currently in development. In this demo you can view a
movie of in-game action rendered with the Parsec game engine, and you can
also get a first glimpse of Parsec's look and feel.

This is not a demo of an upcoming commercial product, Parsec will be a free
Internet game for non-commercial purposes. Please see http://www.parsec.org
for more details.

This release is mostly intended to serve a testing purpose, and can be
considered to be of alpha quality (i.e. not finished, optimized, or fully
debugged yet). Problems and limitations that may be evident will be addressed
during the further development of the game. Please keep this in mind when
watching the demo and when submitting bug reports or comments. You should
expect to see several minor updates to this demo release that fix bugs or
other issues, over the next few weeks. Therefore it is recommended that you
frequently check our webpage at http://www.parsec.org for updates. These
updates will most likely not require full downloads, but be released in the
form of small patches.

We will create a public mailing list for announcements and general discussion
on the topic of Parsec in the near future.
If you think that you have discovered a bug and can reproduce it, we would
be glad to receive your bug report. However, please don't send your reports
via e-mail. Instead, to report a bug go to http://www.parsec.org/bugs/
Bug reports that we receive via e-mail will most likely not be processed.
Parsec generates a log file called "parsec.log", which should be included in
any bug reports.


------------------------------------------------------------------------------
2. LICENSE AND DISCLAIMER OF WARRANTY
------------------------------------------------------------------------------

--
Please note that the RESTRICTION TO NOT ALLOW DISTRIBUTION ON MAGAZINE COVER
CD-ROM'S OR OTHER NON-ELECTRONIC MEDIA will be lifted in a couple of weeks
after all major reported bugs have been fixed. Thank you for your patience.
--

The Parsec demo program, artwork, music, sound effects, and associated
documentation (the "software") are the copyrighted work of Markus Hadwiger,
Andreas Varga, Clemens Beer, Michael Woegerbauer, Alex Mastny, Stefan Poiss,
and Karin Baier. It is protected by copyright law and international treaty
provisions. You are authorized to make and use copies of this software as long
as these copies are only distributed electronically. Physical media (e.g.
CD-ROM's, floppies, etc) redistribution of this software is prohibited. So
long as this document accompanies each copy you make of this software, and as
long as you fully comply at all times with this agreement, the authors grant
you the non-exclusive and limited right to copy this software and to
distribute such copies of this software free of charge for non-commercial
purposes.

THIS SOFTWARE IS PROVIDED TO YOU "AS IS" WITHOUT WARRANTY OF ANY KIND,
EITHER EXPRESS OR IMPLIED INCLUDING BUT NOT LIMITED TO THE APPLIED WARRANTIES
OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE. YOU ASSUME THE
ENTIRE RISK AS TO THE ACCURACY AND THE USE OF THE SOFTWARE AND ALL OTHER RISK
ARISING OUT OF THE USE OR PERFORMANCE OF THIS SOFTWARE AND DOCUMENTATION. THE
AFOREMENTIONED AUTHORS SHALL NOT BE LIABLE FOR ANY DAMAGES WHATSOEVER ARISING
OUT OF THE USE OF OR INABILITY TO USE THIS SOFTWARE, EVEN IF THEY HAVE BEEN
ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. TO THE MAXIMUM EXTENT PERMITTED BY
APPLICABLE LAW, IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CONSEQUENTIAL,
INCIDENTAL, DIRECT, INDIRECT, SPECIAL, PUNITIVE, OR OTHER DAMAGES WHATSOEVER
(INCLUDING WITHOUT LIMITATION, DAMAGES FOR LOSS OF BUSINESS PROFITS, BUSINESS
INTERRUPTION, LOSS OF BUSINESS INFORMATION, OR OTHER PECUNIARY LOSS) EVEN IF
THE AUTHORS HAVE BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. BECAUSE SOME
STATES/JURISDICTIONS DO NOT ALLOW THE EXCLUSION OR LIMITATION OF LIABILITY FOR
CONSEQUENTIAL OR INCIDENTAL DAMAGES, THE ABOVE LIMITATION MAY NOT APPLY.

This software contains the "amp MPEG audio decoder version 0.7.6",
Copyright (c) Tomislav Uzelac 1996, 1997.

The Windows version of this software uses the QMDX.DLL library by
QSound Labs, Inc. The included QMDX.DLL may only be used for running the
Parsec demo and not for any other purpose, as specified by the QMDX End-User
License Agreement.


------------------------------------------------------------------------------
3. SYSTEM REQUIREMENTS
------------------------------------------------------------------------------

Please note that the current system requirements are higher than what will be
required for the full game, since there are a lot of optimizations missing in
this release. This is especially true for the OpenGL rendering subsystem, as
well as the amount of RAM required.

As a general rule of thumb, the OpenGL rendering subsystem uses considerably
more system resources than the Glide (3dfx) renderer. That is, if you want to
use the OpenGL renderer we recommend at least 128MB of RAM and a
third-generation graphics accelerator, combined with a CPU of at least 300MHz.


PC/Win32 (95/98/NT/2K)
----------------------

CPU:
  minimum:     Pentium 200MHz
  recommended: Pentium II 300MHz or higher

Memory:
  minimum:     64MB for Glide/3dfx, 128MB for OpenGL
  recommended: 128MB or more

Harddisk space:
  About 50MB disk space are required.
  Please note that the demo will use about 15MB more disk space after you have
  started it for the first time, compared to immediately after installation.

Graphics card:
  * 3dfx Voodoo Graphics hardware accelerator (recommended Voodoo 2 or 3), or
  * OpenGL compatible hardware accelerator (recommended Matrox G400,
    NVIDIA TNT family, NVIDIA GeForce)

Additional requirements:
  DirectX 3 or higher (will be used for input only).
  Optionally, a DirectInput-compatible joystick is supported.


PC/Linux (x86)
--------------

CPU:
  minimum:     Pentium 200MHz
  recommended: Pentium II 300MHz or higher

Memory:
  minimum:     64MB
  recommended: 128MB or more

Harddisk space:
  About 50MB disk space are required.
  Please note that the demo will use about 15MB more disk space after you have
  started it for the first time, compared to immediately after installation.

Graphics card:
* 3dfx Voodoo Graphics hardware accelerator (recommended Voodoo 2 or 3).
* Please note that OpenGL support under Linux (GLX) will be available in
  the near future. However, this release requires a Voodoo Graphics
  accelerator with Glide 2.x installed.

Additional requirements:
  Linux Kernel 2.2, glibc 2.1, X or svgalib


Mac (MacOS 8.5 or later)
------------------------

CPU:
  minimum:     PowerPC 604e 200MHz
  recommended: PowerPC G3 350MHz

Memory:
  minimum:     64MB for Glide/3dfx, 128MB for OpenGL
  recommended: 128MB or more

Harddisk space:
  About 50MB disk space are required.
  Please note that the demo will use about 15MB more disk space after you have
  started it for the first time, compared to immediately after installation.

Graphics card:
  * 3dfx Voodoo Graphics hardware accelerator (recommended Voodoo 2 or 3), or
  * OpenGL compatible hardware accelerator with at least 8MB of VRAM
    (e.g. ATI Rage128)

Additional requirements:
  Apple GameSprockets
  Optionally, a InputSprocket-compatible joystick is recommended.


------------------------------------------------------------------------------
4. THE LAUNCHER
------------------------------------------------------------------------------

The Win32 and MacOS versions feature a launcher application that allows you
to select the video subsystem, resolution, color depth, and other options
prior to starting the actual Parsec demo.

On Win32, the launcher is a separate executable. Therefore, you should start
LAUNCHER.EXE instead of PARSEC.EXE.

On MacOS, the launcher will start automatically the first time you start
Parsec.

On Linux, you have to use command line options if you wish to override the
default settings (the most important of which will be saved on program
exit and restored automatically on restart).
See section 9 for a description of the most important command line options.


------------------------------------------------------------------------------
5. THE MENU
------------------------------------------------------------------------------

By selecting "play demo" in Parsec's main menu the cursor will enter the
demo list window. Select a demo to play by navigating using the cursor
keys and <enter> to start playback of the highlighted demo. Demo playback
can always be stopped with <escape>. Alternatively, you can also use the
mouse to select a demo from the list.

The most important demo is called "START PARSEC DEMO", which is a 11:40
movie showing lots of network game action and the capabilities of the
engine. It also features great background music.

A special demo called "FREE FLIGHT MODE" is actually not a real demo, but
can be used to enter the game. This mode is very similar to the actual
game mode, although there are no opponents, since the networking code
is disabled in this release. Still, you can steer your ship and fly around,
to get a feeling for the controls.

The <F1> key brings up the online help window, listing the most important
(default) keys for spacecraft navigation.

You can select one of six spacecraft in Parsec's spacecraft viewer
(config/spacecraft) by using the left/right arrow keys and pressing <enter>.
You can also use the mouse by clicking on the little arrows. Select a ship
by clicking on it.
By pressing the up/down arrow keys you can switch from the spacecraft viewer
to the power-up viewer, where you can take a look at most of Parsec's
power-ups with short descriptions.

You can use the options menu (config/options) to configure your display
resolution and color depth, rendering subsystem (OpenGL/Glide), and various
detail settings. Here you can also toggle sound and joystick support on and
off. You can use the mouse and/or the arrow keys and <enter> to navigate
and select items in the options menu. Please note that all networking options
are disabled in this demo.


------------------------------------------------------------------------------
6. THE CONSOLE
------------------------------------------------------------------------------

Parsec's command console can be opened at any time by pressing the tilde (~)
key. The console is a transparent window that can be used to enter console
commands and display various information. Console input is enabled if the
console is visible and the cursor is blinking. If the cursor is not blinking
it can be enabled by pressing the caps lock key.

Parsec's command console features tab completion which is able to complete
a partially supplied command. If multiple commands start with the entered
string a list of valid commands will be displayed.

Please note that the console exposes many features of Parsec's game engine,
even low-level functionality that can cause unexpected behavior if not used
properly. If you have altered the settings beyond repair, simply exit,
delete the PARSECRC.CON file and restart Parsec. Use at your own risk!

Some interesting things to try:

build
listcommands
listintcommands
cockpit.scale ++1
cockpit.scale --1
con.winx
con.winy
con.width
con.height
panelback
paneltext
listbindings
listgamefunckeys
bind
summon class firebird
summon class hurricane
aux_enable_trilinear_filtering 1
aux_enable_elite_radar 1
aux_enable_free_camera 1
aux_draw_wireframe 1
aux_draw_normals 1


We will document all major console commands in a future release.


------------------------------------------------------------------------------
7. TIMEDEMO
------------------------------------------------------------------------------

Use "timedemo 1" in the console to enable the benchmarking function for
demo playback. After demo playback has completed the console will contain
the obtained performance statistics. Return to normal demo playback mode
with "timedemo 0".


------------------------------------------------------------------------------
8. PARSECRC.CON
------------------------------------------------------------------------------

Parsec saves configuration information into a file called "parsecrc.con" on
program exit. If you want to start with the default settings, simply delete
this file. If this file cannot be created, is write protected, etc. the
current settings will not be saved on exit.


------------------------------------------------------------------------------
9. COMMAND LINE OPTIONS
------------------------------------------------------------------------------

Some important command line options are:

--vidmode     : override startup vidmode. syntax like "640x480x32".
--windowed    : start in windowed mode.
--fullscreen  : start in fullscreen mode.
--nojoystick  : disable joystick code.
--nosound     : disable sound code.
--log         : enable log window

--vidsys      : select video subsystem. use like --vidsys <video>,
		where <video> is "glide" for Glide/3dfx and
		"wgl" for OpenGL on Win32, "agl" for OpenGL on MacOS.

On Win32, you have to start the Parsec executable directly (without the
launcher) in order to use command line options.


------------------------------------------------------------------------------
10. SYSTEM-SPECIFIC ISSUES
------------------------------------------------------------------------------

Linux (x86)
-----------

This distribution includes two binaries, one for svgalib-based input
(parsec_svga), and one that uses X11 for input (parsec_x). The svgalib
version needs to be run as root from a console, while the X version can be
run as normal user if an X server is running.
Note that in order to run Parsec as non-root you also need to have
Device3dfx installed. See http://linux.3dfx.com for details.

Parsec/Linux uses its own sound server, based on GSI 0.8.8 by W.H.Scholten.
The server will be started automatically when Parsec starts. Usually this
spawned server will also be killed automatically when you exit the demo.
If you kill the Parsec process manually, you have to kill the server process
separately.
See http://www.xs4all.nl/~whs for more information about GSI.

If you already have a sound server running (which grabs the /dev/dsp device,
e.g. esd) you need to kill this server first.


Mac (MacOS 8.5 or later)
------------------------

OpenGL performance on ATI Rage 128 cards is less than optimal. You are
advised to use the latest drivers included with the OpenGL 1.1.2 release.
Cards with less than 8MB VRAM can not run this release, this includes all
Rev A, B and C iMacs, and beige G3 models. Hopefully OpenGL performance will
be increased by future driver releases.
This release also includes certain workarounds for bugs in the ATI driver,
which decrease performance.

To use the command line options in the Mac version, you need to start the
application with the OPTION key held down. A dialog will appear, where you can
enter the command line options.
If you want to start Parsec with a certain command line option every time,
use Get Info on the Parsec application in the Finder, and type the command
line options in the comments field.

If you own a MCI Gamewizard Voodoo 2 card, you need to install the
official Voodoo 2 reference drivers from 3dfx to avoid some visual problems
with the MCI drivers.


------------------------------------------------------------------------------
11. HARDWARE COMPATIBILITY
------------------------------------------------------------------------------

Please be sure to install the latest non-beta drivers for your respective
card if you experience any problems running the Parsec demo. Even so, many
OpenGL drivers have severe problems with certain rendering modes OpenGL
provides. In fact, there are so many different combinations that a driver
that is entirely capable of running other games without problems could
possibly exhibit strange behavior with this release.


We have tested the following graphics hardware:


PC/Win32 (95/98/NT/2K)
----------------------

Voodoo Graphics
Voodoo 2 (8MB, 12MB)
Voodoo 3
Matrox G400
NVIDIA TNT
NVIDIA TNT2
NVIDIA TNT2 ULTRA
NVIDIA GeForce (SDR, DDR)


PC/Linux (x86)
--------------

Voodoo Graphics
Voodoo 2 (8MB, 12MB)
Voodoo 3


Mac (MacOS 8.5 or later)
------------------------

Voodoo Graphics
Voodoo 2 (8MB, 12MB)
Voodoo 3
ATI Rage 128


We will extend this list in the future with information we get from users
and bug reports.


------------------------------------------------------------------------------
12. KNOWN ISSUES/BUGS
------------------------------------------------------------------------------

* flare visiblity detection is disabled in OpenGL.
  the most visible consequence of this is that the white spacecraft
  propulsion flares at the rear of each ship will shine through.



