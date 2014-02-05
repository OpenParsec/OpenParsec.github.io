
------------------------------------------------------------------------------
PARSEC LAN-TEST (build 0197)                                 October 25, 2001.
------------------------------------------------------------------------------
mailto:parsec@parsec.org                               http://www.parsec.org/
------------------------------------------------------------------------------


------------------------------------------------------------------------------
1. INTRODUCTION
------------------------------------------------------------------------------

This is the Parsec LAN-Test build 0197, a 3D space-combat game currently in
development. In this version of the game, up to eight people can play
together on the same local area network (LAN) using the TCP/IP
protocol. If IPX is used, the limit is four players.
However, it is not possible to play on the Internet. This feature will
follow in a future release. This version does not use a client/server
architecture. A peer-to-peer protocol is used to easily find other players
without the need for starting a server.

This is not a commercial product, Parsec will be a free Internet game for
non-commercial purposes. Please see http://www.parsec.org for more details.

This release is mostly intended to serve a testing purpose, and can be
considered to be of beta quality (i.e. not finished, optimized, or fully
debugged yet). Problems and limitations that may be evident will be addressed
during the further development of the game. Please keep this in mind when
playing the game and when submitting bug reports or comments. You should
expect to see several minor updates to this game release that fix bugs or
other issues in the near future. Therefore it is recommended that you
frequently check our webpage at http://www.parsec.org for updates. These
updates will most likely not require full downloads, but be released in the
form of small patches.

If you want to stay up-to-date on Parsec, there are public mailing-lists
for announcements and general discussions available. Take a look at

http://www.parsec.org/mailinglists/

for subscription details.

Alternatively, there are public web-based discussion boards available at

http://www.parsec.org/forum/

where people can discuss Parsec issues.

If you think that you have discovered a bug and can reproduce it, we would
be glad to receive your bug report. However, please don't send your reports
via e-mail. Instead, to report a bug go to

http://www.parsec.org/bugs/

Bug reports that we receive via e-mail will most likely not be processed.
Parsec generates a log file called "parsec.log", which should be included in
any bug report.


------------------------------------------------------------------------------
2. LICENSE AND DISCLAIMER OF WARRANTY
------------------------------------------------------------------------------

The Parsec program, artwork, music, sound effects, and associated
documentation (the "software") are the copyrighted work of Markus Hadwiger,
Andreas Varga, Clemens Beer, Michael Woegerbauer, Alex Mastny, Stefan Poiss,
and Karin Baier. It is protected by copyright law and international treaty
provisions. Provided this document accompanies each copy you make of this
software, and as long as you fully comply at all times with this agreement,
the authors grant you the non-exclusive and limited right to copy this
software and to distribute such copies of this software free of charge for
non-commercial purposes.

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

The Parsec launcher for the Linux version was written by Tamer Fahmy
<tamer@tammura.at>.

This software contains the "amp MPEG audio decoder version 0.7.6",
Copyright (c) Tomislav Uzelac 1996, 1997.

The Windows version of this software uses the QMDX.DLL library by
QSound Labs, Inc. The included QMDX.DLL may only be used for running the
Parsec game and not for any other purpose, as specified by the QMDX End-User
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


PC/Win32 (98/NT/2K)
-------------------

CPU:
  minimum:     Pentium 200MHz
  recommended: Pentium II 300MHz or higher

Memory:
  minimum:     64MB for Glide/3dfx, 128MB for OpenGL
  recommended: 128MB or more

Harddisk space:
  About 100MB disk space are required.
  Please note that the game will use about 15MB more disk space after you have
  started it for the first time, compared to immediately after installation.

Graphics card:
  * 3dfx Voodoo Graphics hardware accelerator (recommended Voodoo 2 or 3), or
  * OpenGL compatible hardware accelerator (recommended NVIDIA TNT
    family, NVIDIA GeForce family or ATI Radeon family)

Additional requirements:
  DirectX 3 or higher (will be used for input only).
  Optionally, a DirectInput-compatible joystick is supported.


PC/Linux (x86)
--------------

CPU:
  minimum:     Pentium 200MHz
  recommended: Pentium II 300MHz or higher

Memory:
  minimum:     64MB for Glide/3dfx, 128MB for OpenGL
  recommended: 128MB or more

Harddisk space:
  About 100MB disk space are required.
  Please note that the game will use about 15MB more disk space after you have
  started it for the first time, compared to immediately after installation.

Graphics card:
  * 3dfx Voodoo Graphics hardware accelerator (recommended Voodoo 2 or 3).
  * OpenGL compatible hardware accelerator, with GLX-capable X Server,
    i.e. XFree86 4.x with NVIDIA drivers. See section 11
    (Linux-specific issues) in this document for details.

Additional requirements:
  Linux Kernel 2.2 or higher, glibc 2.1.x or higher,
  X11 (for Voodoo1/2/3 or OpenGL)
  or svgalib (for Glide version on Voodoo1/2 only)


Mac (MacOS 8.5 or later)
------------------------

CPU:
  minimum:     PowerPC G3 233MHz
  recommended: PowerPC G3 400MHz

Memory:
  minimum:     64MB for Glide/3dfx, 128MB for OpenGL
  recommended: 128MB (with virtual memory enabled) or more

Harddisk space:
  About 100MB disk space are required.
  Please note that the game will use about 15MB more disk space after you have
  started it for the first time, compared to immediately after installation.

Graphics card:
  * 3dfx Voodoo Graphics hardware accelerator (recommended Voodoo 2 or 3), or
  * OpenGL compatible hardware accelerator with at least 8MB of VRAM
    (e.g. ATI Rage128 or NVIDIA GeForce2 MX)
    cards with less than 8MB VRAM are unsupported, but may work, with
    poor performance

Additional requirements:
  Apple GameSprockets
  Optionally, a InputSprocket-compatible joystick is recommended.


Mac (MacOS X)
-------------

CPU:
  minimum:     PowerPC G3 233MHz
  recommended: PowerPC G4 400MHz

Memory:
  minimum:     64MB for Glide/3dfx, 128MB for OpenGL
  recommended: 128MB or more

Harddisk space:
  About 100MB disk space are required.
  Please note that the game will use about 15MB more disk space after you have
  started it for the first time, compared to immediately after installation.

Graphics card:
  * 3dfx Voodoo Graphics hardware accelerator (recommended Voodoo 2 or 3), or
  * OpenGL compatible hardware accelerator with at least 8MB of VRAM
    (e.g. ATI Rage128 or NVIDIA GeForce2 MX)
    cards with less than 8MB VRAM are unsupported, but may work, with
    poor performance

Additional requirements:
  none


------------------------------------------------------------------------------
4. THE LAUNCHER
------------------------------------------------------------------------------

Parsec features a launcher application that allows you to select the video
subsystem, resolution, color depth, and other options prior to starting the
actual Parsec game.

On Win32 and Linux, the launcher is a separate executable. Therefore, you
should start LAUNCHER.EXE (on Win32) or launcher (on Linux) instead of
PARSEC.EXE or parsec.

On Linux, the 'startparsec' script will automatically start the launcher.

On MacOS, the launcher will start automatically the first time you start
Parsec.

On all systems you can alternatively use command line options if you wish to
override the default settings (the most important of which will be saved on
program exit and restored automatically on restart).
See section 10 for a description of the most important command line options.


------------------------------------------------------------------------------
5. THE MENU
------------------------------------------------------------------------------

The Parsec menu has the following structure:


GAME ----- + --- CONNECT / JOIN GAME ...... connect to other players on the LAN
           |                                or join the game if already
           |                                connected
           |
           + --- STARMAP .................. disabled in this version
           |
           + --- PLAY DEMO / DISCONNECT ... play a demo (if not connected),
           |                                or disconnect from a game
           |
           + --- BACK ..................... go back to main menu


SERVER .................................... disabled in this version


CONFIG --- + --- SPACECRAFT ............... select your spacecraft
           |                                and view power-ups
           |
           + --- CONTROLS ................. not available yet
           |
           + --- OPTIONS .................. activate options menu
           |
           + --- BACK ..................... go back to main menu


QUIT ...................................... exit Parsec


You can start a network game by choosing "CONNECT" from the "GAME" submenu.
Parsec will search for other players on the LAN (this may take a few seconds).
The player list window on the right-hand side of the menu will show the other
players after you have been connected.

You can then choose "JOIN GAME" to enter the action.

By selecting "PLAY DEMO" in Parsec's "GAME" submenu the cursor will enter the
demo list window. Select a demo to play by navigating using the cursor
keys and <enter> to start playback of the highlighted demo. Demo playback
can always be stopped with <escape>. Alternatively, you can also use the
mouse to select a demo from the list.

The most important demo is called "START PARSEC DEMO", which is a 11:40
movie showing lots of network game action and the capabilities of the
engine. It also features great background music.

A special demo called "FREE FLIGHT MODE" is actually not a real demo, but
can be used to enter the game. This mode is very similar to the actual
game mode, although there are no opponents. Still, you can steer your ship
and fly around, to get a feeling for the controls, before you enter a real
network game.

The <F1> key brings up the online help window, listing the most important
(default) keys for spacecraft navigation.
Use <Escape> to leave the game, this will bring up the game status window.
Pressing <Escape> again will bring you back to the menu.

In the CONFIG submenu you can choose SPACECRAFT to enter the spacecraft viewer.
Here you can select one of eight spacecraft by using the left/right arrow keys
and pressing <enter>.
You can also use the mouse by clicking on the little arrows. Select a ship
by clicking on it.
By pressing the up/down arrow keys you can switch from the spacecraft viewer
to the power-up viewer, where you can take a look at most of Parsec's
power-ups with short descriptions.

You can use the options menu by selecting "OPTIONS" from the "CONFIG" submenu.
Use the mouse and/or the arrow keys and <enter> to navigate and select
items in the options menu.
Here you can configure your display resolution and color depth, rendering
subsystem (OpenGL/Glide), and various detail settings.
You can also toggle sound/music and joystick/mouse support on and off,
and configure the mouse control settings.
You can also select wether you want to play using TCP/IP or IPX, and select
game-related options, such as the kill limit after which the game ends, and
the solar system to play in.


------------------------------------------------------------------------------
6. THE GAME
------------------------------------------------------------------------------

Parsec is a fast-paced space-combat action game. The current mode of game
play is traditional death-match, where all players, in this release up to
eight (four using IPX), compete for the highest number of kills.
As soon as the kill limit has been reached, the player with the most
kills wins. The kill limit can be configured in the options menu.

One of the most important things to do, while trying to avoid getting shot
down by other players, is to collect power-ups floating through outer space.
These get you powerful weapons, energy, are able to repair damage, and so
on. You can take a look at the available power-ups in Parsec's spacecraft
viewer (use <cursor up> or click on one of the vertical buttons to switch
from the spacecraft view to the power-up view).

The cockpit layout is as follows:

The monitor in the upper left-hand corner shows your currently selected
target spacecraft (select the next target using <t>). The colored bar
beneath the targeted ship's image shows its current damage. Targeting
spacecraft is useful for better recognizing them, since they will be
surrounded by a target reticle as soon as they come into view, and for
firing guided missiles. In order to fire guided missiles, a target has
to be selected (<t>) and then locked, by bringing the reticle into the
center of the screen. While a target is locked, the color of the reticle
will change from red to white.

The monitor in the upper right-hand corner shows your own ship and its
damage. The two vertical bars to the left of the monitor show (from left
to right) the current energy level and your ship's speed, respectively.

There are two basic types of weapons:

Energy weapons (the laser, the lightning cannon, the helix cannon, and
the photon cannon), and projectile weapons (dumb missiles, guided missiles,
swarm missiles, and proximity mines).

The currently selected energy weapon is shown in the lower left-hand corner.
Cycle to the next energy weapon with <g>.
The currently selected projectile weapon is shown in the lower right-hand
corner. Cycle to the next projectile weapon with <m>.

Energy weapons consume energy when fired, watch your energy level and regularly
collect energy power-ups.
If you have no energy left, you can only use your basic EMP device
with <x> which is available all the time. The EMP can be upgraded, but
the upgrades require energy to work.

Projectile weapons can only be collected in discrete quantities (say, five
dumb missiles). You can fire as many as you have collected.

Throughout space, there might be teleporters present. Each teleporter
has an entry gate and an exit gate, connected by a propulsion tunnel.
A ship entering the entry gate, is quickly propelled to the exit of
the tunnel. Be careful though, if you entry angle is too flat, the
teleporter won't work.

The radar is located in the center of the bottom of the screen. It shows all
joined targets in red, the currently selected target will be drawn in white
(cycle targets with <t>). Teleporters are shown as green dots on the radar.
The small monitor mounted on the left side of the radar will show
"incoming" when enemy guided missiles have locked onto you.
The three little lights below detect proximity mines. The more lights are
active, the nearer you are to a mine.

The center of the top of the screen shows an iconbar with which you can
see all weapons and special items (like invulnerability and afterburner) you
have collected. Gray icons denote items you can collect but have not done so
yet. Blue icons denote items you have already collected and can be used
immediately.

The icons from left to right are:

Laser - Helix Cannon - Lightning Cannon - Photon Cannon -
Dumb Missiles - Guided Missiles - Swarm Missiles - Proximity Mines -
EMP Device (always available) - Invisibility (always disabled) -
Invulnerability - Afterburner

The currently selected weapon (cycle with <g> for energy weapons, with
<m> for projectile weapons) will be surrounded by a white square.
You can also select weapons directly by pressing the corresponding
number keys <1> to <8>.

This is the default keyboard configuration of Parsec:

Function                Key
----------------------------------------
escape to menu          escape

turn left               cursor left
turn right              cursor right
dive down               cursor up
pull up                 cursor down

roll left               q
roll right              w

shoot weapon            space
launch missile          enter

next weapon             g
next missile            m

accelerate              r
deccelerate             f
afterburner             left shift

slide left              a
slide right             s
slide up                e
slide down              d

next target             t
show framerate          i

show playerlist         tab
decrease cockpit size   numpad -
increase cockpit size   numpad +

show wc-like radar      home
show elite-like radar   end
increase radar range    page up
decrease radar range    page down

toggle console          tilde
toggle help             f1
toggle object cam       f6

switch to window mode   f9
switch to fullscren     f10
save screenshot         f12

speed zero              backspace
target speed            z

emp device              x
quickchat               c


To view the keyboard configuration during the game, press <f1>.

The keyboard configuration can be changed by using the "bind" command in the
console (see next section).
In a future version there will be a much simpler method to change the keys.


------------------------------------------------------------------------------
7. THE CONSOLE
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

The summon command for creating arbitrary objects will only work while not
connected to a network game (i.e., in free flight mode).

We will document all major console commands in a future release.


------------------------------------------------------------------------------
8. TIMEDEMO
------------------------------------------------------------------------------

Use "timedemo 1" in the console to enable the benchmarking function for
demo playback. After demo playback has completed the console will contain
the obtained performance statistics. Return to normal demo playback mode
with "timedemo 0".


------------------------------------------------------------------------------
9. PARSECRC.CON
------------------------------------------------------------------------------

Parsec saves configuration information into a file called "parsecrc.con" on
program exit. If you want to start with the default settings, simply delete
this file. If this file cannot be created, is write protected, etc. the
current settings will not be saved on exit.


------------------------------------------------------------------------------
10. COMMAND LINE OPTIONS
------------------------------------------------------------------------------

Some important command line options are:

--vidmode     : override startup vidmode. syntax like "640x480x32".
--windowed    : start in windowed mode.
--fullscreen  : start in fullscreen mode.
--nojoystick  : disable joystick code.
--nosound     : disable sound code.
--log         : enable log window (Windows and MacOS 9.x only)
--noflipsync  : disable sync-to-screen option

--vidsys      : select video subsystem. use like --vidsys <video>,
		where <video> is "glide" for Glide/3dfx,
		"wgl" for OpenGL on Win32, "agl" for OpenGL on MacOS and
                "glx" for OpenGL on Linux.

On Win32 and Linux, you have to start the Parsec executable directly (without
the launcher) in order to use command line options.


------------------------------------------------------------------------------
11. SYSTEM-SPECIFIC ISSUES
------------------------------------------------------------------------------

Linux (x86)
-----------

This distribution includes two binaries, one for svgalib-based input
(parsec_svga), and one that uses X11 for input (parsec_x). The svgalib
version needs to be run as root from a console and only supports Glide 2.x
(i.e. 3dfx Voodoo) acceleration, while the X version can be run as normal
user if an X server is running and supports both Glide 2.x and OpenGL.
Note that in order to run Parsec as non-root in Glide mode you also need to
have Device3dfx installed.
There is a symlink called 'parsec' which should be set to the correct
executable of choice.

The OpenGL version requires a libGL.so library, and works best with
XFree86 4.x, using the correct drivers for your card.
Specifically this means NVIDIA cards (TNT, TNT2, GeForce/2/3), and
others that provide XFree86 4.x drivers.
XFree86 3.x, MESA, and utah-glx have not been tested extensively with this
release and might not work at all.
Fullscreen mode requires the XFree86-VidModeExtension.
Please note that strange visual problems (e.g. all ships are missing)
are almost always a driver problem, and we have no direct influence on that.

The Glide version only supports Glide 2.x, which means it can only be run on
Voodoo 1, Voodoo 2, Voodoo Banshee and Voodoo 3 cards. Since there is no
Glide 2.x for Voodoo 4/5 cards, owners of those cards will have to use the
(slower) OpenGL version.

Parsec/Linux uses its own sound server, based on GSI 0.8.8 by W.H.Scholten.
The server will be started automatically when Parsec starts. Usually this
spawned server will also be killed automatically when you exit the demo.
If you kill the Parsec process manually, you have to kill the server process
separately, and you also might have to remove /tmp/gsi.
See http://www.xs4all.nl/~whs for more information about GSI.

If you already have a sound server running (which grabs the /dev/dsp device)
it might be necessary to kill this server first.

If you use a joystick in the Linux version, be sure to use a tool like jscal
or a similiar one to calibrate your joystick.

If you experience the problem that the throttle wheel and the rotational (z)
axis of your joystick are swapped, you have to comment in the following
command contained in the file "init.con" by removing the semicolon in the
first column:
il.swap_joyaxes_23 1
This will swap the axes of the throttle wheel and the rotational axis.


Mac (MacOS 8.5 or later)
------------------------

OpenGL performance on ATI Rage 128 cards is less than optimal. You are
advised to use the latest drivers included with the OpenGL 1.2.1 release
(part of MacOS 9.1).
Cards with less than 8MB VRAM (this includes all Rev A, B and C iMacs, beige
G3 models, iBooks and most PowerBooks) offer extremely poor performance in
Parsec. A card with 8MB VRAM is *highly* recommended.
Hopefully OpenGL performance will be increased by future driver releases.
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

The Voodoo3 beta12 drivers contain a bug in the Glide library, which affects
particle visibility in Parsec. Either use beta11 drivers, or Voodoo5 drivers.

Please note that Parsec/OpenGL uses an extensive amount of RAM. If you're
running low on memory, you will experience white rectangles on the
screen (which means that OpenGL does not have enough memory to store
the textures in RAM) and erratic crashes. In this case either buy more
memory or increase your virtual memory size!


Mac (MacOS X)
-------------

Please note that this is the first version of Parsec that has been
released for MacOS X, so there might be some problems.

The following things are missing in the MacOS X version:
 * Glide/3dfx support
 * Joystick support
 * Audio CD support

The rest of the game should be on par with the other versions.

If you experience any problems with the MacOS X version, please take
the time and report a bug at:

http://www.parsec.org/bugs/


------------------------------------------------------------------------------
12. HARDWARE COMPATIBILITY
------------------------------------------------------------------------------

Please be sure to install the latest non-beta drivers for your respective
card if you experience any problems running Parsec LAN-Test. Even so, many
OpenGL drivers have severe problems with certain rendering modes OpenGL
provides. In fact, there are so many different combinations that a driver
that is entirely capable of running other games without problems could
possibly exhibit strange behavior with this release.

We have tested the following graphics hardware:


PC/Win32 (98/NT/2K)
-------------------

Voodoo Graphics
Voodoo 2 (8MB, 12MB)
Voodoo 3
Matrox G400 (some driver problems)
NVIDIA TNT
NVIDIA TNT2
NVIDIA TNT2 ULTRA
NVIDIA GeForce (SDR, DDR)
NVIDIA GeForce2 (GTS, MX)
NVIDIA GeForce3
ATI Rage 128
ATI Radeon


PC/Linux (x86)
--------------

Voodoo Graphics
Voodoo 2 (8MB, 12MB)
Voodoo 3
Matrox G400
NVIDIA TNT
NVIDIA GeForce2 (GTS, MX)
ATI Radeon


Mac (MacOS 8.5 or later)
------------------------

Voodoo Graphics
Voodoo 2 (8MB, 12MB)
Voodoo 3
ATI Rage 128
ATI Radeon
NVIDIA GeForce2 MX
NVIDIA GeForce3


Cards that we found incapable of playing Parsec:

 * Riva128
 * 3DLabs GVX1
 * ATI RageII

We will extend this list in the future with information we get from users
and bug reports.


------------------------------------------------------------------------------
13. KNOWN ISSUES/BUGS
------------------------------------------------------------------------------

* big fonts are not supported in Glide
* the EMP device has drawing problems in Glide
* connecting to a network game is vulnerable to packet loss


------------------------------------------------------------------------------
14. CHANGES IN THIS VERSION
------------------------------------------------------------------------------

build 0197
----------
* better support for low end graphics cards
* fixed some sound issues
* fixed keyboard initialization bugs under Windows

build 0196
----------
* two new ships (Assassin and Silverhawk)
* high resolution textures for the new ships
* new music by STEV
* 8 player support (on TCP/IP LANs)
* teleporter
* mouse control
* MacOS X version
* big fonts
* correct ship propulsion visibility in OpenGL
* texture compression
* texture precaching
* target direction indicator
* many bug fixes and enhancements


------------------------------------------------------------------------------
15. ACKNOWLEDGMENTS
------------------------------------------------------------------------------

We would like to thank the following people for their support:

* Thomas Bauer
* Uli Haboeck
* Frank Limbacher (Apple Germany)
* Christian Ritter (RedHat Germany)
* Matthias Nagorni (SuSE Germany)
* Mike Drummelsmith (Matrox Inc.)
