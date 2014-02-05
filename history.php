<?php include('header.inc.php'); ?>
  <center>
   <blockquote>
    <font face="Helvetica,Arial" size="2"><img height="133" width="400" src="images/history_h.jpg"></font></blockquote>
  </center>
  <p><font face="Helvetica,Arial" size="2">In this section we try to give you a brief summary of how Parsec came into being in the first place, how features have evolved, as well as touch on some technological considerations.</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave>
      <div align="left">
       <font face="Helvetica,Arial">NOT FOR THE FAINT OF HEART</font></div>
     </td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">This section is probably not very interesting for pure computer gamers since it is not concerned with game play at all! Instead, we are focusing on technical details and how they have evolved over time. So this is primarily meant for those interested in game programming and computer graphics in general!</font></p>
  <p><font face="Helvetica,Arial" size="2">Enough to scare you away, off we go:</font></p>
  <p>
  <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
   <tr nosave>
    <td nosave><font face="Helvetica,Arial">SWADDLING CLOTHES AND FIRST TIMID STEPS</font></td>
   </tr>
  </table>
  </p>
  <p><font face="Helvetica,Arial" size="2">We started work on the Parsec project in early 1996, although this very name was not chosen until about half a year later. We did the original version for a computer graphics course held by our university's <a href="http://www.cg.tuwien.ac.at/home/" target="_top">Institute of Computer Graphics</a>. At the time, most work went into Parsec's software-renderer which mostly consists of hand-optimized assembly language code. (Yes, this implies that it's still alive and kicking.) This version was DOS-only and supported software-rendering in resolutions of 320x200 (meant for 486s) and 640x480 (for Pentiums) in 256 colors and could be played by four simultaneous players connected via an IPX-compatible network.</font></p>
  <p><font face="Helvetica,Arial" size="2">On a Pentium-90 this early version was capable of rendering between 25 and 50 frames per second in 640x480 (full-screen), mostly depending on the pixel-coverage of currently visible texture-mapped polygons (perspective-correct texture mapping, of course).</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave><font face="Helvetica,Arial">SHADOWS OF THE PAST</font></td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2"><img height="120" width="160" src="images/ship_rotation.gif" align="left">The Parsec of today doesn't bear much resemblance to this very early version anymore. (Hopefully, you wouldn't see any relation at all if you saw them placed next to one another...) Since then, we have created entirely new graphics, integrated really great music and sound effects, improved network game play tremendously, and added a lot of other things... well, you get the picture. If not, please have a look at the screenshots section and then hurry to download the movie in the download section.</font></p>
  <p><font face="Helvetica,Arial" size="2">Still in 1996 we also added support for resolutions up to 1280x1024 (well, 800x600 being perfectly suitable for game play on mid-range desktop PCs, but anything higher being only... well, it runs, alright?) and color-depths of 16 and 24 bits per pixel. Software rendering in 24bpp is more experimental than useful in general, but the 16bpp mode is actually used to display more colorful graphics and still fast enough on a decent PC.</font></p>
  <p><font face="Helvetica,Arial" size="2">The heading above notwithstanding, we still use our (extended) software renderer, although we have now somewhat succumbed to the merits of 3D hardware accelerators. More on that in a minute.</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave><font face="Helvetica,Arial">JUST ABOUT TIME: SOME REALLY COOL SPECIAL EFFECTS</font></td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">In the summer of 1997 we incorporated an all-new particle system into the rendering-pipeline that we now use for rendering special effects and weapons. In order to accommodate rendering of particles, our polygon-renderer had to be changed to perform a z-buffer fill in addition to using BSP trees for visibility determination. This z-buffer fill together with the newly integrated support for higher color-depths than 8bpp mandated a major revision of nearly all assembly-language routines responsible for rasterization.</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave><font face="Helvetica,Arial">ATTRACTING SOME PEOPLE WHO KNOW WHAT THEY'RE DOING</font></td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">Well, at about that time (we're still plodding along somewhere in the summer of 1997) we were able to persuade some really talented people to join forces and transform Parsec into a real team effort. Hmm, we didn't say how many we were until then, did we? Well, about slightly more than two, depending on the period of time.</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave>
      <div align="left">
       <font face="Helvetica,Arial">PUTTING ASIDE RECOMPILATIONS AND CLUMSY CONFIGURATION FILES</font></div>
     </td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">The subsequent integration of a command-console marked a huge leap ahead in configurability and game play customization. Nowadays, we use the console to configure the entire rendering-engine, tweak game play (hitpoints and number of missiles, for instance), and switch between software and hardware rendering on-the-fly. One could be tempted to think the console has gotten out of hand somehow, being able to create and execute scripts, list text files, load all sorts of data, sporting a history list and tab completion, ... Now don't tell us even your grandmother had that, there are a lot of other things... and it really looks cool!</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave><font face="Helvetica,Arial">DEVELOPING A CRUSH FOR 3D HARDWARE ACCELERATORS</font></td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">Speaking of hardware rendering, in the fall of 1997 we incorporated support of the Voodoo Graphics 3D accelerator by 3Dfx Interactive. Finally, a chipset had persuaded us that this would indeed be the future of 3D gaming and, we really had to put some effort into this.</font></p>
  <p><font face="Helvetica,Arial" size="2">This marks an especially huge leap ahead for us, not only in rendering quality and speed, but also in the structure of our codebase. In order to accommodate both hardware and software rendering in the same executable, we had to restructure our entire codebase into subsystems. Well, now that you mention it, we also had the slight complication of porting a purely-DOS game that was never meant to be anything else to Win32.</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave><font face="Helvetica,Arial">FINALLY DISCOVERING THE COOLNESS OF PORTABILITY</font></td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">Our newly restructured codebase also greatly simplified the task of porting Parsec to other platforms, since only system-dependent subsystems have to be implemented anew for each new platform.</font></p>
  <p><font face="Helvetica,Arial" size="2">So we proceeded by creating the aforementioned native Win32 version and this time we were determined to never again develop only for a single platform.</font></p>
  <p><font face="Helvetica,Arial" size="2">Since then we got MacOS and Linux versions up and running which now gives us four supported platforms: DOS (yeah, right, now even we are considering if this is going to be needed by anyone... anyone?), Win32 (95/98/NT), MacOS (PowerMac), and Linux.</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave>
      <div align="left">
       <font face="Helvetica,Arial">THE WOES OF SOFTWARE RENDERING</font></div>
     </td>
    </tr>
   </table>
   </p>
  </center>
  <p><a href="ship3.html"><font face="Helvetica,Arial" size="2"><img height="77" width="192" src="images/ship3_small.jpg" border="0" align="right"></font></a><font face="Helvetica,Arial" size="2">Currently we have reached the stage where a lot of cool stuff is only available in the hardware-accelerated versions. The most important feature coming to mind is a full view panorama depicting a quite realistic outer-space background containing nebulae, stars, and planets. In the summer of 1998 we extended our particle-system with respect to special effects and flexibility and are now using a lot of texture formats currently not supported by our software-renderer. Well, we will see how strong the demand for software rendering will still be when we are finally releasing...</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave>
      <div align="left">
       <font face="Helvetica,Arial">TCP/IP NETWORKING... COOL!</font></div>
     </td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">The most important feature we have worked on over the last half year is the TCP/IP networking subsystem and corresponding gameservers and masterserver to achieve the very important goal of Internet game play. Sometime in early 1998 we decided that we wanted more than peer-to-peer LAN game play... And it even runs on a 14.4kbps connection! Well, probably we're going to introduce new features that will up the minimum requirement to 28.8kbps.</font></p>
  <p><font face="Helvetica,Arial" size="2">The documentation for the current version of the <a href="netdocs/index.html" target="_top">Parsec Networking Architecture</a> is available online.</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave><font face="Helvetica,Arial">MORE FEATURES, MORE PLATFORMS, MORE CODE</font></td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">We are still working on increasing platform support, as porting has become a lot easier since our codebase supports both little-endian and big-endian systems transparently since the MacOS port and, apart from software rendering, we have a C-only version, with all assembly language subroutines also available as portable C code.</font></p>
  <p><font face="Helvetica,Arial" size="2">Most important of which is the brand-new OpenGL rendering subsystem which will allow us to also support Mesa and even get Parsec running under SGI IRIX, which, given our university background, isn't that bad an idea at all...</font></p>
  <center>
   <p>
   <table border="0" cellspacing="0" cellpadding="3" cols="1" width="100%" bgcolor="#0e2568" nosave>
    <tr nosave>
     <td nosave><font face="Helvetica,Arial">EASY TO FORGET: THERE'S STILL A LOT OF WORK TO DO</font></td>
    </tr>
   </table>
   </p>
  </center>
  <p><font face="Helvetica,Arial" size="2">Alright, we recently had a look at our download section and... there still is no executable to download!! OK, uh, anybody knows what happened, any excuses... anyone?</font></p>
  <p><font face="Helvetica,Arial" size="2">Actually, we had planned on releasing, uh, a while ago, but features kept crawling in and our standards were constantly increasing as to what we really wanted you to see and play. As we wrote on the main page we really are concerned with ensuring competitive quality in every respect, which we do think is possible, even given our limited resources.</font></p>
  <p><font face="Helvetica,Arial" size="2">And... now we have somewhat fixed the features and kind of game we really want Parsec to be.</font></p>
  <p><font face="Helvetica,Arial" size="2">We want to create a multiplayer game that really is fun to play, and, as far as possible, is the kind of game we ourselves have always wanted to play! (Hmm, there was the thing about cutscenes we, uh, do also like a lot...)</font></p>
  <p><font face="Helvetica,Arial" size="2">After all, let's face it, we're all computer gamers, and the reason for programming games is that we want to play them ourselves. And we hope that a lot of other people besides us are also going to enjoy it a lot!</font></p>
<?php include('footer.inc.php');?>
