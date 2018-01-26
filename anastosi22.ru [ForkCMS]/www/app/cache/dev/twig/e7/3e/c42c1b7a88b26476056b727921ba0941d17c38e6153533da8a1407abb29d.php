<?php

/* WebProfilerBundle:Profiler:base_js.html.twig */
class __TwigTemplate_e73ec42c1b7a88b26476056b727921ba0941d17c38e6153533da8a1407abb29d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<script>/*<![CDATA[*/
    Sfjs = (function() {
        \"use strict\";

        var noop = function() {},

            profilerStorageKey = 'sf2/profiler/',

            request = function(url, onSuccess, onError, payload, options) {
                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                options = options || {};
                options.maxTries = options.maxTries || 0;
                xhr.open(options.method || 'GET', url, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onreadystatechange = function(state) {
                    if (4 !== xhr.readyState) {
                        return null;
                    }

                    if (xhr.status == 404 && options.maxTries > 1) {
                        setTimeout(function(){
                            options.maxTries--;
                            request(url, onSuccess, onError, payload, options);
                        }, 500);

                        return null;
                    }

                    if (200 === xhr.status) {
                        (onSuccess || noop)(xhr);
                    } else {
                        (onError || noop)(xhr);
                    }
                };
                xhr.send(payload || '');
            },

            hasClass = function(el, klass) {
                return el.className.match(new RegExp('\\\\b' + klass + '\\\\b'));
            },

            removeClass = function(el, klass) {
                el.className = el.className.replace(new RegExp('\\\\b' + klass + '\\\\b'), ' ');
            },

            addClass = function(el, klass) {
                if (!hasClass(el, klass)) { el.className += \" \" + klass; }
            },

            getPreference = function(name) {
                if (!window.localStorage) {
                    return null;
                }

                return localStorage.getItem(profilerStorageKey + name);
            },

            setPreference = function(name, value) {
                if (!window.localStorage) {
                    return null;
                }

                localStorage.setItem(profilerStorageKey + name, value);
            };

        return {
            hasClass: hasClass,

            removeClass: removeClass,

            addClass: addClass,

            getPreference: getPreference,

            setPreference: setPreference,

            request: request,

            load: function(selector, url, onSuccess, onError, options) {
                var el = document.getElementById(selector);

                if (el && el.getAttribute('data-sfurl') !== url) {
                    request(
                        url,
                        function(xhr) {
                            el.innerHTML = xhr.responseText;
                            el.setAttribute('data-sfurl', url);
                            removeClass(el, 'loading');
                            (onSuccess || noop)(xhr, el);
                        },
                        function(xhr) { (onError || noop)(xhr, el); },
                        '',
                        options
                    );
                }

                return this;
            },

            toggle: function(selector, elOn, elOff) {
                var i,
                    style,
                    tmp = elOn.style.display,
                    el = document.getElementById(selector);

                elOn.style.display = elOff.style.display;
                elOff.style.display = tmp;

                if (el) {
                    el.style.display = 'none' === tmp ? 'none' : 'block';
                }

                return this;
            }
        }
    })();
/*]]>*/</script>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:base_js.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  20 => 1,  48 => 16,  810 => 492,  807 => 491,  796 => 489,  792 => 488,  788 => 486,  775 => 485,  749 => 479,  746 => 478,  727 => 476,  710 => 475,  706 => 473,  702 => 472,  698 => 471,  694 => 470,  690 => 469,  686 => 468,  682 => 467,  679 => 466,  677 => 465,  660 => 464,  649 => 462,  634 => 456,  629 => 454,  625 => 453,  622 => 452,  620 => 451,  606 => 449,  601 => 446,  567 => 414,  549 => 411,  532 => 410,  529 => 409,  527 => 408,  522 => 406,  517 => 404,  182 => 87,  389 => 160,  386 => 159,  378 => 157,  371 => 156,  363 => 153,  358 => 151,  353 => 149,  343 => 146,  340 => 145,  331 => 140,  328 => 139,  326 => 138,  307 => 128,  302 => 125,  296 => 121,  293 => 120,  290 => 119,  281 => 114,  276 => 111,  269 => 107,  259 => 103,  253 => 100,  232 => 88,  227 => 86,  222 => 83,  210 => 77,  208 => 76,  189 => 66,  184 => 63,  175 => 58,  170 => 84,  155 => 47,  152 => 46,  144 => 42,  127 => 35,  34 => 5,  367 => 155,  357 => 123,  345 => 147,  334 => 141,  332 => 116,  327 => 114,  324 => 113,  321 => 135,  318 => 111,  309 => 129,  306 => 107,  297 => 104,  291 => 102,  288 => 118,  283 => 115,  274 => 110,  265 => 105,  263 => 95,  258 => 94,  255 => 101,  243 => 92,  235 => 89,  231 => 83,  224 => 81,  212 => 78,  202 => 94,  190 => 76,  161 => 63,  143 => 51,  122 => 41,  109 => 52,  58 => 25,  82 => 19,  63 => 18,  61 => 12,  204 => 78,  188 => 90,  174 => 65,  167 => 71,  125 => 42,  118 => 49,  104 => 32,  76 => 34,  47 => 21,  37 => 10,  164 => 70,  157 => 56,  145 => 74,  139 => 49,  131 => 45,  120 => 31,  111 => 47,  108 => 37,  106 => 51,  83 => 33,  74 => 14,  60 => 6,  52 => 12,  462 => 202,  453 => 199,  449 => 198,  446 => 197,  441 => 196,  439 => 195,  431 => 189,  429 => 188,  422 => 184,  415 => 180,  408 => 176,  401 => 172,  394 => 168,  387 => 164,  380 => 158,  373 => 156,  361 => 152,  355 => 150,  351 => 141,  348 => 121,  342 => 137,  338 => 119,  335 => 134,  329 => 131,  325 => 129,  323 => 128,  320 => 127,  315 => 131,  312 => 130,  303 => 106,  300 => 105,  298 => 120,  289 => 113,  286 => 112,  278 => 98,  275 => 105,  270 => 102,  267 => 101,  262 => 98,  256 => 96,  248 => 97,  246 => 136,  241 => 93,  233 => 87,  229 => 87,  226 => 84,  220 => 81,  216 => 79,  213 => 78,  207 => 75,  203 => 73,  200 => 72,  197 => 69,  194 => 68,  191 => 67,  185 => 74,  181 => 65,  178 => 59,  176 => 86,  172 => 57,  165 => 83,  162 => 57,  153 => 77,  150 => 55,  147 => 75,  141 => 73,  134 => 39,  130 => 46,  119 => 40,  116 => 57,  113 => 48,  102 => 24,  99 => 23,  96 => 37,  90 => 42,  84 => 40,  81 => 23,  73 => 33,  70 => 15,  67 => 14,  59 => 16,  53 => 12,  45 => 9,  38 => 18,  94 => 21,  92 => 43,  89 => 20,  85 => 24,  79 => 18,  75 => 19,  68 => 30,  64 => 23,  56 => 16,  50 => 22,  29 => 6,  87 => 41,  72 => 18,  55 => 24,  21 => 2,  26 => 5,  98 => 45,  93 => 9,  88 => 25,  80 => 27,  78 => 40,  46 => 13,  36 => 10,  27 => 7,  57 => 16,  40 => 11,  33 => 9,  30 => 5,  44 => 20,  42 => 11,  35 => 9,  31 => 8,  43 => 12,  41 => 19,  28 => 3,  201 => 92,  199 => 93,  196 => 92,  187 => 75,  183 => 82,  173 => 85,  171 => 73,  168 => 61,  166 => 54,  163 => 82,  158 => 80,  156 => 62,  151 => 63,  142 => 59,  138 => 56,  136 => 71,  133 => 55,  123 => 61,  121 => 50,  117 => 39,  115 => 39,  112 => 36,  105 => 25,  101 => 31,  91 => 33,  86 => 28,  69 => 17,  66 => 11,  62 => 27,  54 => 22,  51 => 13,  49 => 14,  39 => 10,  24 => 4,  32 => 6,  25 => 3,  22 => 1,  19 => 1,);
    }
}
