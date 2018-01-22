<?php
/**
 * Console
 *
 * @author Anton Medvedev <anton@elfet.ru>
 * @link https://github.com/elfet/console
 * @license Licensed under the MIT license.
 * @version 2.0
 */

// Change next variables as you need.

// drattmann, h0nee
// backup, backup

// Digest HTTP Authentication
// To enable, add user: "name" => "password".
$users = array();
$realm = 'Console';

// Console theme.
// Available styles: white, green, grey, far, ubuntu, portal
$theme = 'portal';

// Commands
$commands = array(
    '*' => '$1',
);

// Start with this dir.
$currentDir = __DIR__;
$allowChangeDir = true;

// Allowed and denied commands.
$allow = array("girl", "aperture");
$deny = array();

$images = array("
             .,-:;//;:=,
          . :H@@@MM@M#H/.,+%;,
       ,/X+ +M@@M@MM%=,-%HMMM@X/,
     -+@MM; #M@@MH+-,;XMMMM@MMMM@+-
    ;@M@@M- XM@X;. -+XXXXXHHH@M@M#@/.
  ,%MM@@MH ,@%=             .---=-=:=,.
  =@#@@@MX.,                -%HX$$%%%:;
 =-./@M@M$                   .;@MMMM@MM:
 X@/ -#MM/                    . +MM@@@M$
,@M@H: :@:                    . =X#@@@@-
,@@@MMX, .                    /H- ;@M@M=
.H@@@@M@+,                    %MM+..%#$.
 /MMMM@MMH/.                  XM@MH; =;
  /%+%#XHH@$=              , .H@@@@MX,
   .=--------.           -%H.,@@@@@MX,
   .%MM@@@HHHXX$$$%+- .:XMMX =M@@MM%.
     =XMMM@MM@MM#H;,-+HMM@M+ /MMMX=
       =%@M@M#@$-.=$@MM@@@M; %M%=
         ,:+$+-,/H#MMMMMMM@= =,
               =++%%%%+/:-.
","
             =+%HM####@H%;,
          /H##############M$,
          ,@################+
           .H##############+
             X############/
              $##########/
               %########/
                /X/;;+X/

                 -XHHX-
                ,######,
#############X  .M####M.  X#############
##############-   -//-   -##############
X##############%,      ,+##############X
-##############X        X##############- 
 %############%          %############%
  %##########;            ;##########%
   ;#######M=              =M#######;
    .+M###@,                ,@###M+.
       :XH.                  .HX:
","
                          .,---.
                        ,/XM#MMMX;,
                      -%##########M%,
                     -@######%  $###@=
      .,--,         -H#######$   $###M:
   ,;$M###MMX;     .;##########$;HM###X=
 ,/@##########H=      ;################+
-+#############M/,      %##############+
%M###############=      /##############:
H################      .M#############;.
@###############M      ,@###########M:.
X################,      -$=X#######@:
/@##################%-     +######$-
.;##################X     .X#####+,
 .;H################/     -X####+.
   ,;X##############,       .MM/
      ,:+@H@M#######M#$-    .$$=
           .,-=;+$@###X:    ;/=.
                  .,/X$;   .::,
                      .,    ..
","
                     -$-
                    .H##H,
                   +######+
                .+#########H.
              -$############@.
            =H###############@  -X:
          .$##################:  @#@-
     ,:  .M###################;  H###;
   ;@#:  @###################@  ,#####:
 -M###.  M#################@.  ;######H
 M####-  +###############$   =@#######X
 H####$   -M###########+   :#########M,
  /####X-   =########%   :M########@/.
    ,;%H@X;   .$###X   :##MM@%+;:-
                 ..
  -/;:-,.              ,,-==+M########H
 -##################@HX%%+%%$%%%+:,,
    .-/H%%%+%%#H@###############M@+=:/+:
/XHX%:#####MH%=    ,---:;;;;/%%XHM,:###$
$@#MX %+;-                           .
","
                 =/;;/-
                +:    //
               /;      /;
              -X        H.
.//;;;:;;-,   X=        :+   .-;:=;:;%;.
M-       ,=;;;#:,      ,:#;;:=,       ,@
:%           :%.=/++++/=.$=           %=
 ,%;         %/:+/;,,/++:+/         ;+.
   ,+/.    ,;@+,        ,%H;,    ,/+,
      ;+;;/= @.  .H##X   -X :///+;
      ;+=;;;.@,  .XM@$.  =X.//;=%/.
   ,;:      :@%=        =#H:     .+%-
 ,%=         %;-///==///-//         =%,
;+           :%-;;;:;;;;-X-           +:
@-      .-;;;;M-        =M/;;;-.      -X
 :;;::;;-.    %-        :+    ,-;;-;:==
                  ,X        H.
               ;/      %=
                //    +;
                 ,////,
","
           .-;+#XHHHHHHX#+;-.
        ,;X@@X%/;=----=:/%X@@X/
      =$@@%=.              .=+H@X:
    -XMX:                      =XMX=
   /@@:                          =H@+
  %@X,                            .$@$
 +@X.                               $@%
-@@,                                .@@=
%@%                                  +@$
H@:                                  :@H
H@:         :HHHHHHHHHHHHHHHHHHX,    =@H
%@%         ;@M@@@@@@@@@@@@@@@@@H-   +@$
=@@,        :@@@@@@@@@@@@@@@@@@@@@= .@@:
 +@X        :@@@@@@@@@@@@@@@M@@@@@@:%@%
  $@$,      ;@@@@@@@@@@@@@@@@@M@@@@@@$.
   +@@HHHHHHH@@@@@@@@@@@@@@@@@@@@@@@+
    =X@@@@@@@@@@@@@@@@@@@@@@@@@@@@X=
      :$@@@@@@@@@@@@@@@@@@@M@@@@$:
        ,;$@@@@@@@@@@@@@@@@@@X/-
           .-;+#XXHHHHHX#+;-.
","
            ,:/+/-
            /M/              .,-=;//;-
       .:/= ;MH/,    ,=/+%#XH@MM#@:
      -$##@+$###@H@MMM#######H:.    -/H#
 .,H@H@ X######@ -H#####@+-     -+H###@X
  .,@##H;      +XM##M/,     =%@###@X;-
X%-  :M##########$.    .:%M###@%:
M##H,   +H@@@$/-.  ,;#M###@%,          -
M####M=,,---,.-%%H####M$:          ,+@##
@##################@/.         :%H##@$-
M###############H,         ;HM##M$=
#################.    .=#M##M$=
################H..;XM##M$=          .:+
M###################@%=           =+@MH%
@################M/.          =+H#X%=
=+M##############M,       -/X#X+;.
  .;XM##########H=    ,/X#H+:.
     ,:/%XM####H/.
          ,.:=-.
","
            .+
             /M;
              H#@:              ;,
               -###H-          -@/
               %####$.  -;  .%#X
                M#####+;#H :M#M.
..          .+/;%#########X###-
 -/%H%+;-,    +##############/
    .:$M###MH$%#############X  ,--=;-
        -/H#####################H+=.
           .+#################X.
         =%M####################H;.
            /@###############+;;/%%;,
         -%###################$.
       ;H######################M=
    ,%#####MH$%;+#####M###-/@####%
  :$H%+;=-      -####X.,H#   -+M##@-
 .              ,###;    ;      =$##+
                .#H,               :XH,
                 +                   .;-
","
       #+ @      # #              M#@
 .    .X  X.%##@;# #   +@#######X. @#%
   ,==.   ,######M+  -#####%M####M-    #
  :H##M%:=##+ .M##M,;#####/+#######% ,M#
 .M########=  -@#@.=#####M=M#######=  X#
 :@@MMM##M.  -##M.,#######M#######. =  M
             @##..###:.    .H####, @@ X,
   ############: ###,/####;  /##= @#. M
           ,M## ;##,@#M;/M#M  @# X#% X#
.%=   ######M## ##.M#:   ./#M ,M #M ,#$
##/         $## #+;#: #### ;#/ M M- @# :
#+ #M@MM###M-;M #:$#-###H# .#X @ + $#. #
      ######/.: #%=# M#:MM./#.-#  @#: H#
+,.=   @###: /@ %#,@  ##@X #,-#@.##% .@#
#####+;/##/ @##  #@,+       /#M    . X,
   ;###M#@ M###H .#M-     ,##M  ;@@; ###
   .M###%  ;####X ,@#######M/ -M###$  -H
    .M###%  X####H  .@@MM@;  ;@#M@
      H#M    /@####/      ,++.  / ==-,
               ,=/:, .+X@MMH@#H  #####$=
");

// Next comes the code...

###############################################
#                Controller                   #
###############################################

// Use next two for long time executing commands.
ignore_user_abort(true);
set_time_limit(0);

// If exist config include it.
if (is_readable($file = __DIR__ . '/console.config.php')) {
    include $file;
}

// If we have a user command execute it.
// Otherwise send user interface.
if (isset($_GET['command'])) {
    $userCommand = urldecode($_GET['command']);
    $userCommand = escapeshellcmd($userCommand);
} else {
    $userCommand = false;
}

// If can - get current dir.
if ($allowChangeDir && isset($_GET['cd'])) {
    $newDir = urldecode($_GET['cd']);
    if (is_dir($newDir)) {
        $currentDir = $newDir;
    }
}

###############################################
#              Authentication                 #
###############################################

// If auth is enabled:
if (!empty($users)) {
    if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Digest realm="' . $realm . '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($realm) . '"');
        die("Bye-bye!\n");
    }

    // Analyze the PHP_AUTH_DIGEST variable
    if (!($data = httpDigestParse($_SERVER['PHP_AUTH_DIGEST'])) || !isset($users[$data['username']])) {
        die("Wrong Credentials!\n");
    }

    // Generate the valid response
    $A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
    $A2 = md5($_SERVER['REQUEST_METHOD'] . ':' . $data['uri']);
    $valid_response = md5($A1 . ':' . $data['nonce'] . ':' . $data['nc'] . ':' . $data['cnonce'] . ':' . $data['qop'] . ':' . $A2);

    if ($data['response'] != $valid_response) {
        die("Wrong Credentials!\n");
    }

    // ok, valid username & password
    $httpUsername = $data['username'];
}

###############################################
#                   Action                    #
###############################################

// Choose action if we have user command in query - execute it.
// Else send to user html frontend of console.
if (false !== $userCommand) {
    // Check command by allow list.
    if (!empty($allow)) {
        if (!searchCommand($userCommand, $allow)) {
            $these = implode('<br>', $allow);
            die("<span class='error'>Sorry, but this command not allowed. </span>\n");//Try these:<br>{$these}
        }
    }

    // Check command by deny list.
    if (!empty($deny)) {
        if (searchCommand($userCommand, $deny)) {
            die("<span class='error'>Sorry, but this command is denied.</span>\n");
        }
    }

    // Change current dir.
    if ($allowChangeDir && 1 === preg_match('/^cd\s+(?<path>.+?)$/i', $userCommand, $matches)) {
        $newDir = $matches['path'];
        $newDir = '/' === $newDir[0] ? $newDir : $currentDir . '/' . $newDir;
        if (is_dir($newDir)) {
            $newDir = realpath($newDir);
            // Interface will recognize this and save as current dir.
            die("set current directory $newDir");
        } else {
            die("<span class='error'>cd: $newDir: No such directory.</span>\n");
        }
    }

    // Easter egg
    if (1 === preg_match('/^(g+?(i((r)l+?)))$/i', $userCommand)) {
        die(base64_decode('ICAgICAgICAgICAgICAgICAgICAgIC4sLCw6Ojs7dDtNTU1NTU1NTU1CVnQ6Ky4uDQogICAgICAgICAgICAgICAgICAgICAsSVZYVllJQnR0dCs7OytJVlZNTU1NTU1SUjoNCiAgICAgICAgICAgICAgICAgICAgICxZWVZZSXRNWXRpK2krKztYK1J0O3RYV1JNUiwNCiAgICAgICAgICAgICAgICAgICAgIC5ZUmlJWVJNVmlpdFZYUldSWU1JKysrK2l0TU0uLg0KICAgICAgICAgICAgICAgICAgICAgIC5ZKywuLFg7OywsLFlNTU1NTU1NTVJWSXRYTXRpDQogICAgICAgICAgICAgICAgICAgICAgIDtYKzssWDosLiAuLGlpSVJNV01NTUJCUk1NQlkuDQogICAgICAgICAgICAgICAgICAgICAgICB0Uis6STtpOitZO0lpdFlWWU1NTU1NTU1NUmkuDQogICAgICAgICAgICAgICAgICAgICAgICAuK1JYdDssOzouOjpYWElCTU1NTU1NTU1NKzoNCiAgICAgICAgICAgICAgICAgICAgICAgICAgLFJSWGl0WSssLjo7UldNTU1NTU1NTXQuDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgVllJOjo7LC4uOnRWTU1NTU1NQlkrLg0KICAgICAgICAgICAgICAgICAgICAgICAgICAgLlZCQlc7Ozs6OixpLk1NTU1NQmk7Lg0KICAgICAgICAgICAgICAgICAgICAgICAgICAgLnRXUlJWaTs7Oi5YOlZNTU1NTU1ZLg0KICAgICAgICAgICAgICAgICAgICAgICAgICwraSs6LFhZdHQrOixpOixNTU1CUjoNCiAgICAgICAgICAgICAgICAgICAgICAgLlZWLi4uLjoudHQ7OysrOissUk1ZTVYuDQogICAgICAgICAgICAgICAgICAgICAgIDpNOzs6Li4sLC4rdCsrK1l0dC4sKzoNCiAgICAgICAgICAgICAgICAgICAgICAgdFJ0OywuLjsrLiw7Kyt0aXQsDQogICAgICAgICAgICAgICAgICAgICAgOnRYdDssLiwsKyw7K1lSWSwNCiAgICAgICAgICAgICAgICAgICAgOisrOzs7Liw6Ljo7KztpTWkNCiAgICAgICAgICAgICAgICAgICAsUmk6OjosOjs6Ozo6OitJaQ0KICAgICAgICAgICAgICAgICAgICwrO1hpaTssLDs7STt0aXQsLg0KICAgICAgICAgICAgICAgICAgICAgO0JCdCw7Kzo6LDo7aSsuDQogICAgICAgICAgICAgICAgICAgICA7QldYWDs6Ojs7OmlYLg0KICAgICAgICAgICAgICAgICAgICAgOkJXVklpKyt0KztWKw0KICAgICAgICAgICAgICAgICAgICAgIFdCWHRJdGlpK2lXSS4NCiAgICAgICAgICAgICAgICAgICAgICA6TVdJWUl0aStpVlJZLA0KICAgICAgICAgICAgICAgICAgICAgICBSQlhWWUl0aWlJWVhXSSwNCiAgICAgICAgICAgICAgICAgICAgICAgO01SV1dWWXR0dHRJSVhXdC4NCiAgICAgICAgICAgICAgICAgICAgICAgLlhNQlJSWEl0aSsraXRJWFcsDQogICAgICAgICAgICAgICAgICAgICAgICAuQk1CQlJWSWkrOzsrdHRYWC4NCiAgICAgICAgICAgICAgICAgICAgICAgICAsTU1CUlhZdGk7OzsrdElXOw0KICAgICAgICAgICAgICAgICAgICAgICAgICB0TU1SV1l0aSsrK2l0dFhWDQogICAgICAgICAgICAgICAgICAgICAgICAgICArTVJWWXRpKysraXR0V0kNCiAgICAgICAgICAgICAgICAgICAgICAgICAgLlZNV1Z0aWlpaWlpdElSLA0KICAgICAgICAgICAgICAgICAgICAgICAgIC5YQkJXVnR0dHR0dHR0WFINCiAgICAgICAgICAgICAgICAgICAgICAgLixXQlJCWFZ0dHR0dHR0SVd0DQogICAgICAgICAgICAgICAgICAgICAgIDtSV1hXQlhZdHR0dHR0dFlSOw0KICAgICAgICAgICAgICAgICAgICAgLmlSV1ZJaUJXWUl0dHR0dHRZVywNCiAgICAgICAgICAgICAgICAgICAgLnRXVll0aTtXUlZJdHRpdHRJVlYgICAgICAuOiwsDQogICAgICAgICAgICAgICAgICAgIHRXVklpKys7WFJWSUl0dHR0SVhZICAgLi46WVl0WWk7dGl0dFYsDQogICAgICAgICAgICAgICAgICAgdFhZdGkrKyt0V1JWWXR0aXR0WVdJaUlZWVZJdHQ7aVhXKy4uLi4NCiAgICAgICAgICAgICAgICAgIDtXSXQrKytpWFJCQlZZSXRpdElZWFhZdGkraUlZdCsrO0lNUmk7Lg0KICAgICAgICAgICAgICAgIC46WHRpKzsrdFJXdDtCVllJdGl0SVlXVklJSVlYWFdYVlhZdCtpK0lWOw0KICAgICAgICAgICAgICAgIC50WWkrOztJV0k7OztCVlZJdGl0SVhCUlZJdDs7Ojo6Ojt0SVZYUmlYdA0KICAgICAgICAgICAgICAgIDpWaWlpKytpO2l0SVhCWFZ0dGl0VlcsICAgICAgICAgICAgICAgdEJJWA0KICAgICAgICAgICAgICAgIC5YSWlYSXR0SVZSQlJCSUl0dHRJUlggICAgICAgICAgICAgICAgIDpWWA0KICAgICAgICAgICAgICAgIC4sdFhYV1dXVmkrLiBSWFhJdGlZUlYgICAgICAgICAgICAgICAgICAuLg0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAsQldZaStJUlgNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRCWWlpdFdCLA0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgLldWdGlpSVJJDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgVld0aWlpSUIsDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgLEJJaWlpaVd0DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgLkJWaWlpaVlWDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIFhYdGlpK1lWDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlSaWlpK1lZDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDtCdGlpK1hJDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBXdGlpK1I7DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBYWSt0K0IuDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBZWCt0WVIuDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICB0WCtpV1YNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlYaStSSQ0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgdFlpSVhYDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICxYdGlJWFJ0Lg0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA7QklWWVJXSVYNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgK1JZWFhXaVlSLg0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBpV0lWWXRYTVYNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgdEJZSXRSdE0rDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIFhCV3R0WDpCOg0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICB0WVlCWFhZUjssUjoNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgdElZWVlJWTsgICwu') . "\n");
    }
    
    if($userCommand = "aperture"){
		die($images[rand(0, count($images)-1)] ."\n");
    }

    // Check if command is not in commands list.
    if (!searchCommand($userCommand, $commands, $command, false)) {
        $these = implode('<br>', array_keys($commands));
        die("<span class='error'>Sorry, but this command not allowed. Try these:<br>{$these}</span>");
    }

    // Create final command and execute it.
    $command = "cd $currentDir && $command";
    list($output, $error, $code) = executeCommand($command);

    header("Content-Type: text/plain; charset=utf-8");
    echo formatOutput($userCommand, htmlspecialchars($output));
    echo htmlspecialchars($error);

    exit(0); // Terminate app
} else {
    // Send frontend to user.
    header('Content-Type: text/html; charset=utf-8');

    // Show current dir name.
    $currentDirName = explode('/', $currentDir);
    $currentDirName = end($currentDirName);

    // Show current user.
    $whoami = isset($commands['*']) ? str_replace('$1', 'whoami', $commands['*']) : 'whoami';
    list($currentUser) = executeCommand($whoami);
    $currentUser = trim($currentUser);
}

###############################################
#                  Functions                  #
###############################################

function searchCommand($userCommand, array $commands, &$found = false, $inValues = true)
{
    foreach ($commands as $key => $value) {
        list($pattern, $format) = $inValues ? array($value, '$1') : array($key, $value);
        $pattern = '/^' . str_replace('\*', '(.*?)', preg_quote($pattern)) . '$/i';
        if (preg_match($pattern, $userCommand)) {
            if (false !== $found) {
                $found = preg_replace($pattern, $format, $userCommand);
            }
            return true;
        }
    }
    return false;
}

function executeCommand($command)
{
/*
    $descriptors = array(
        0 => array("pipe", "r"), // stdin - read channel
        1 => array("pipe", "w"), // stdout - write channel
        2 => array("pipe", "w"), // stdout - error channel
        3 => array("pipe", "r"), // stdin - This is the pipe we can feed the password into
    );

    $process = proc_open($command, $descriptors, $pipes);

    if (!is_resource($process)) {
        echo("Can't open resource with proc_open.");
    }

    // Nothing to push to input.
    fclose($pipes[0]);

    $output = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    $error = stream_get_contents($pipes[2]);
    fclose($pipes[2]);

    // TODO: Write passphrase in pipes[3].
    fclose($pipes[3]);

    // Close all pipes before proc_close!
    $code = proc_close($process);

    return array($output, $error, $code);
    */
}
/*
function formatOutput($command, $output)
{
    if (preg_match("%^(git )?diff%is", $command) || preg_match("%^status.*?-.*?v%is", $command)) {
        $output = formatDiff($output);
    }
    $output = formatHelp($output);
    return $output;
}

function formatDiff($output)
{
    $lines = explode("\n", $output);
    foreach ($lines as $key => $line) {
        if (strpos($line, "-") === 0) {
            $lines[$key] = '<span class="diff-deleted">' . $line . '</span>';
        }

        if (strpos($line, "+") === 0) {
            $lines[$key] = '<span class="diff-added">' . $line . '</span>';
        }

        if (preg_match("%^@@.*?@@%is", $line)) {
            $lines[$key] = '<span class="diff-sub-header">' . $line . '</span>';
        }

        if (preg_match("%^index\s[^.]*?\.\.\S*?\s\S*?%is", $line) || preg_match("%^diff.*?a.*?b%is", $line)) {
            $lines[$key] = '<span class="diff-header">' . $line . '</span>';
        }
    }

    return implode("\n", $lines);
}

function formatHelp($output)
{
    // Underline words with _0x08* symbols.
    $output = preg_replace('/_[\b](.)/is', "<u>$1</u>", $output);
    // Highlight backslash words with *0x08* symbols.
    $output = preg_replace('/.[\b](.)/is', "<strong>$1</strong>", $output);
    return $output;
}
*/
function httpDigestParse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce' => 1, 'nc' => 1, 'cnonce' => 1, 'qop' => 1, 'username' => 1, 'uri' => 1, 'response' => 1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}

###############################################
#                Autocomplete                 #
###############################################

$autocomplete = array(
    '^\w*$' => array('cd', 'ls', 'mkdir', 'chmod', 'git', 'hg', 'diff', 'rm', 'mv', 'cp', 'more', 'grep', 'ff', 'whoami', 'kill'),
    '^git \w*$' => array('status', 'push', 'pull', 'add', 'bisect', 'branch', 'checkout', 'clone', 'commit', 'diff', 'fetch', 'grep', 'init', 'log', 'merge', 'mv', 'rebase', 'reset', 'rm', 'show', 'tag', 'remote'),
    '^git \w* .*' => array('HEAD', 'origin', 'master', 'production', 'develop', 'rename', '--cached', '--global', '--local', '--merged', '--no-merged', '--amend', '--tags', '--no-hardlinks', '--shared', '--reference', '--quiet', '--no-checkout', '--bare', '--mirror', '--origin', '--upload-pack', '--template=', '--depth', '--help'),
);

###############################################
#                    View                     #
###############################################
?>

<!doctype html>
<html>
<head>
<title>console</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
    }

    body {
        padding: 10px;
        background: #FFFFFF;
        color: #333333;
        font-family: 'Lucida Console', Monaco, monospace;
        font-size: 16px;
    }

    form {
        display: table;
        width: 100%;
        white-space: nowrap;
    }

    form div {
        display: table-cell;
        width: auto;
    }

    form #command {
        width: 100%;
    }

    input {
        border: none;
        outline: none;
        background: transparent;
        width: 100%;
    }

    input:focus {
        outline: none;
    }

    pre, form, input {
        color: inherit;
        font-family: inherit;
        font-size: inherit;
    }

    pre {
        white-space: pre;
    }

    code {
        color: blue;
        font-family: inherit;
        font-size: inherit;
    }

    strong {
        font-weight: bolder;
        font-family: Tahoma, Geneva, sans-serif
    }

    .error {
        color: red;
    }

    .autocomplete .guess {
        color: #a9a9a9;
    }

    .diff-header {
        color: #333;
        font-weight: bold;
    }

    .diff-sub-header {
        color: #33a;
    }

    .diff-added {
        color: #3a3;
    }

    .diff-deleted {
        color: #a33;
    }
</style>
<?php if ($theme == "ubuntu") { ?>
    <style type="text/css">
        body {
            color: #FFFFFF;
            background-color: #281022;
        }

        code {
            color: #898989;
        }

        .diff-header {
            color: #FFF;
        }
    </style>
<?php } elseif ($theme == "grey") { ?>
    <style type="text/css">
        body {
            color: #B8B8B8;
            background-color: #424242;
            font-family: Monaco, Courier, monospace;
        }

        code {
            color: #FFFFFF;
        }

        form, input {
            color: #FFFFFF;
        }

        .diff-header {
            color: #B8B8B8;
        }

        .diff-sub-header {
            color: #cbcbcb;
        }
    </style>
<?php } elseif ($theme == "far") { ?>
    <style type="text/css">
        body {
            color: #CCCCCC;
            background-color: #001F7C;
            font-family: Terminal, monospace;
        }

        code {
            color: #6CF7FC;
        }

        .diff-header {
            color: aqua;
        }

        .diff-sub-header {
            color: #1f7184;
        }
    </style>
<?php } elseif ($theme == "white") { ?>
    <style type="text/css">
        body {
            color: #FFFFFF;
            background-color: #000000;
            font-family: monospace;
        }

        code {
            color: #898989;
        }

        .diff-header {
            color: #FFF;
        }
    </style>
<?php } elseif ($theme == "green") { ?>
    <style type="text/css">
        body {
            background-color: #000000;
            color: #00C000;
            font-family: monospace;
        }

        code {
            color: #00C000;
        }

        .diff-added {
            color: #23be8c;
        }
    </style>
<?php } elseif ($theme == "portal") { ?>
    <style type="text/css">
        body {
            background-color: #040505;
            color: #E2A302;
            font-family: 'Courier New', Courier;
        }

        input {
            color: #E2A302;
        }

        code {
            color: #E2A302;
        }

        .light {
            color: #FACF61;
        }

        .dark {
            color: #9e611a;
        }

        .diff-added {
            color: #23be8c;
        }
    </style>
<?php } ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    /**
     *  History of commands.
     */
    (function ($) {
        var maxHistory = 100;
        var position = -1;
        var currentCommand = '';
        var addCommand = function (command) {
            var ls = localStorage['commands'];
            var commands = ls ? JSON.parse(ls) : [];
            if (commands.length > maxHistory) {
                commands.shift();
            }
            commands.push(command);
            localStorage['commands'] = JSON.stringify(commands);
        };
        var getCommand = function (at) {
            var ls = localStorage['commands'];
            var commands = ls ? JSON.parse(ls) : [];
            if (at < 0) {
                position = at = -1;
                return currentCommand;
            }
            if (at >= commands.length) {
                position = at = commands.length - 1;
            }
            return commands[commands.length - at - 1];
        };

        $.fn.history = function () {
            var input = $(this);
            input.keydown(function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);

                if (code == 38) { // Up
                    if (position == -1) {
                        currentCommand = input.val();
                    }
                    input.val(getCommand(++position));
                    return false;
                } else if (code == 40) { // Down
                    input.val(getCommand(--position));
                    return false;
                } else {
                    position = -1;
                }
            });

            return input;
        };

        $.fn.addHistory = function (command) {
            addCommand(command);
        };
    })(jQuery);

    /**
     * Autocomplete input.
     */
    (function ($) {
        $.fn.autocomplete = function (suggest) {
            // Wrap and extra html to input.
            var input = $(this);
            input.wrap('<span class="autocomplete" style="position: relative;"></span>');
            var html =
                '<span class="overflow" style="position: absolute; z-index: -10;">' +
                    '<span class="repeat" style="opacity: 0;"></span>' +
                    '<span class="guess"></span></span>';
            $('.autocomplete').prepend(html);

            // Search of input changes.
            var repeat = $('.repeat');
            var guess = $('.guess');
            var search = function (command) {
                var array = [];
                for (var key in suggest) {
                    if (!suggest.hasOwnProperty(key))
                        continue;
                    var pattern = new RegExp(key);
                    if (command.match(pattern)) {
                        array = suggest[key];
                    }
                }

                var text = command.split(' ').pop();

                var found = '';
                if (text != '') {
                    for (var i = 0; i < array.length; i++) {
                        var value = array[i];
                        if (value.length > text.length &&
                            value.substring(0, text.length) == text) {
                            found = value.substring(text.length, value.length);
                            break;
                        }
                    }
                }
                guess.text(found);
            };
            var update = function () {
                var command = input.val();
                repeat.text(command);
                search(command);
            };
            input.change(update);
            input.keyup(update);
            input.keypress(update);
            input.keydown(update);

            input.keydown(function (e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if (code == 9) {
                    var val = input.val();
                    input.val(val + guess.text());
                    return false;
                }
            });

            return input;
        };
    })(jQuery);

    <?php $currentDirName = "/";
    $currentUser = "guest";?>

    /**
     * Windows variables.
     */
    window.currentDir = '<?php echo $currentDirName; ?>';
    window.currentDirName = window.currentDir == "/" ? window.currentDir : window.currentDir.split('/').pop();
    window.currentUser = '<?php echo $currentUser; ?>';
    window.titlePattern = "* — console";
    window.document.title = window.titlePattern.replace('*', window.currentDirName);

    /**
     * Init console.
     */
    $(function () {
        var screen = $('pre');
        var input = $('input').focus();
        var form = $('form');
        var scroll = function () {
            window.scrollTo(0, document.body.scrollHeight);
        };
        input.history();
        input.autocomplete(<?php echo json_encode($autocomplete); ?>);
        form.submit(function () {
            var command = $.trim(input.val());
            if (command == '') {
                return false;
            }

            $("<code>" + window.currentDirName + "&nbsp;" + window.currentUser + "$&nbsp;" + command + "</code><br>").appendTo(screen);
            scroll();
            input.val('');
            form.hide();
            input.addHistory(command);

            $.get('', {'command': command, 'cd': window.currentDir}, function (output) {
                var pattern = /^set current directory (.+?)$/i;
                if (matches = output.match(pattern)) {
                    window.currentDir = matches[1];
                    window.currentDirName = window.currentDir.split('/').pop();
                    $('#currentDirName').text(window.currentDirName);
                    window.document.title = window.titlePattern.replace('*', window.currentDirName);
                } else {
                    screen.append(output);
                }
            })
                .fail(function () {
                    screen.append("<span class='error'>Command is sent, but due to an HTTP error result is not known.</span>\n");
                })
                .always(function () {
                    form.show();
                    scroll();
                });
            return false;
        });

        $(document).keydown(function () {
            input.focus();
        });
        
        $(document).click(function () {
            input.focus();
        });

        $(document).ready(function() {
            form.hide();
            setTimeout(function(){
                screen.append("<code>Welcome to Aperture Laboratories</code>\n");

                setTimeout(function(){
                    screen.append("<code>Activation GlaDOS in</code>\n");

                    setTimeout(function(){
                        screen.append("<code>3</code>\n");

                        setTimeout(function(){
                            screen.append("<code>2</code>\n");

                            setTimeout(function(){
                                screen.append("<code>1</code>\n");

                                setTimeout(function(){
                                    screen.append("<code>Activation error.</code>\n");

                                    setTimeout(function(){
                                        screen.append("<code>Transition to manual mode. Please wait...</code>\n");

                                        setTimeout(function(){
                                            screen.append("<code>Manual mode has been activated.</code>\n");
                                            form.show();
                                        }, 3000);

                                    }, 1000);

                                }, 1000);

                            }, 1000);

                        }, 1000);

                    }, 1000);

                }, 2000);
            }, 100);
        });
    });
</script>
</head>
<body>
<pre></pre>
<form>
    <div id="currentDirName"><?php echo $currentDirName; ?></div>
    <div>&nbsp;<?php echo $currentUser; ?>$&nbsp;</div>
    <div id="command"><input type="text" value=""></div>
</form>
</body>
</html>
