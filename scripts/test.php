<?php
     include_once("ldap_wrapper.php"); 
 ?>
 <head>
    <script src="superbar.js">
        </script>
 </head>
 <body>
       <?php   
     $ldap = new LdapWrapper();
     echo $ldap->query_username("kdolan");
        ?>
         <script type="text/javascript">
    selected = new Array()
    names = new Array()
    names.push("Chris Lockfort (clockfort)");
    names.push("Gabbie Burns (yinyang)");
    names.push("Will Ziener-Dignazio (slackwill)");
    names.push("Ross Delinger (rossdylan)");
    names.push("Grant Cohoe (cohoe)");
    names.push("Ross Guarino (eos)");
    names.push("Channon Price (chprice)");
    names.push("Matt Soucy (msoucy)");
    names.push("Frank Hrach (knarf1393)");
    names.push("Ethan House (ehouse)");
    names.push("Benjamin Meyer (bmeyer)");
    names.push("Ben Centra (bencentra)");
    names.push("Joshua Winemiller (jewinemiller21)");
    names.push("Travis Whitaker (tmobile)");
    names.push("Andrew Hanes (ahanes)");
    names.push("Michael Moffitt (moffitt)");
    names.push("Julian Hammerstein (Hammerstein)");
    names.push("Ryan S Brown (ryansb)");
    names.push("Drew Stebbins (astebbin)");
    names.push("Gerard Geer (gman)");
    names.push("Eric Adams (grizzlyadams)");
    names.push("John Feulner (peppy)");
    names.push("Sarah Clauser (sclauser)");
    names.push("Duncan Keller (duncannons)");
    names.push("Cliff Chapman (mrdoom)");
    names.push("Anqi Chen (totoro)");
    names.push("Megan McNeice (mmcneice)");
    names.push("Michail Yasonik (gorbachev)");
    names.push("Alex Berkowitz (berky93)");
    names.push("Emily Egeland (ducktape)");
    names.push("Alex Walcutt (awalcutt)");
    names.push("Josh McSavaney (mcsaucy)");
    names.push("Daniel Tyler (dtyler)");
    names.push("Dan Fuhry (fuhry)");
    names.push("Anthony Gargiulo (agargiulo)");
    names.push("Russ Harmon (russ)");
    names.push("Benjamin Russell (benrr101)");
    names.push("Jeff Haak (zemon1)");
    names.push("Will Orr (worr)");
    names.push("Grant Kurtz (grnt426)");
    names.push("Connor Monahan (kerberos)");
    names.push("Alex Howland (ducker)");
    names.push("Michael Bax Bradley (mike5)");
    names.push("Nikko Williard (urfriendlyvirus)");
    names.push("Peter Vowell (caliswag)");
    names.push("Alexander Kyte (alexanderkyte)");
    names.push("Reed Swiernik (rswiernik)");
    names.push("Dan Brockwell (dbrocks)");
    names.push("Mike Janitor (thejanitor)");
    names.push("Michael Swan (swanboy)");
    names.push("Michael A. Wilmoth (leroyflyer)");
    names.push("f_MeghanSchafer (f_MeghanSchafer)");
    names.push("Jacqueline McGraw (jackiedmcgraw)");
    names.push("Ross Bayer (rostepher)");
    names.push("Schuyler Martin (skyguysciguy)");
    names.push("Matthew Lavine (mattlavine)");
    names.push("Nick Depinet (nick)");
    names.push("Michael G. Cunney (kanye)");
    names.push("Kevin Dolan (kdolan)");
    names.push("f_TroyCaro (f_TroyCaro)");
    names.push("Andrew Glaude (ajgajg1134)");
    names.push("Tyler Cromwell (tyler)");
    names.push("Joseph Batchik (jd)");
    names.push("Matt Gambogi (gambogi)");
    names.push("Stephen Demos (demos)");
    names.push("Derek Gonyeo (dgonyeo)");
    names.push("f_ColinMurphy (f_ColinMurphy)");
    names.push("f_DavidKisluk (f_DavidKisluk)");
    names.push("f_JasonNoll (f_JasonNoll)");
    names.push("f_ColtonSurdyk (f_ColtonSurdyk)");
    names.push("f_AndrewWood (f_AndrewWood)");
    names.push("f_CorySollberger (f_CorySollberger)");
    names.push("Robert Glossop (robgssp)");
    names.push("f_JayNdow (f_JayNdow)");
    names.push("f_ShawWinner (f_ShawWinner)");
    names.push("f_DerekCloos (f_DerekCloos)");
    names.push("f_DavidSeidman (f_DavidSeidman)");
    names.push("f_NathanielFalcone (f_NathanielFalcone)");
    names.push("f_PeterGilosa (f_PeterGilosa)");
    names.push("Nick Hilton (hilton)");
    names.push("Tal Cohen (tcohen)");
    names.push("f_MichaelEaton (f_MichaelEaton)");
    names.push("f_JoshuaHampton (f_JoshuaHampton)");
    names.push("Ryan Buzzell (rbuzzell)");
    names.push("Austin Levesque (austinlvsq)");
    names.push("Matthew Rose (cobert)");
    names.push("Julien Eid (jeid)");
    names.push("Sophie Song (sophiesong)");
    names.push("Scott Jordan (swinejelly)");
    names.push("Jennifer Dziuba (candy)");
    names.push("f_NateLemoi (f_NateLemoi)");
    names.push("f_ShareefAli (f_ShareefAli)");
    names.push("f_JoeGambino (f_JoeGambino)");
    names.push("f_ColinONeill (f_ColinONeill)");           
</script>   
                 <input type="text" class="superbar" id="superbar" onkeyup="search('superbar', event, addSelected);" name="inputText"/>  <br>
                <input type="text" class="superbar" id="superbar2" onkeyup="search('superbar2', event, addSelected);" name="inputText"/>  <br>
                <input type="text" class="superbar" id="superbar3" onkeyup="search('superbar3', event, addSelected);" name="inputText"/>    <br>
                
                                 <div id="results" class="results">
                 
                                 <div id="results" class="results">
                </div>
                <div id="results">
 </body>

