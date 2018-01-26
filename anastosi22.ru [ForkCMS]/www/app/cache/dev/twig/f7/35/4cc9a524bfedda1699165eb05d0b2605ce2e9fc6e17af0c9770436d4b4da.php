<?php

/* WebProfilerBundle:Collector:logger.html.twig */
class __TwigTemplate_f7354cc9a524bfedda1699165eb05d0b2605ce2e9fc6e17af0c9770436d4b4da extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("@WebProfiler/Profiler/layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["logger"] = $this;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_toolbar($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        if (($this->getAttribute($this->getContext($context, "collector"), "counterrors") || $this->getAttribute($this->getContext($context, "collector"), "countdeprecations"))) {
            // line 7
            echo "        ";
            ob_start();
            // line 8
            echo "            <img width=\"15\" height=\"28\" alt=\"Logs\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAA4klEQVQ4y2P4//8/AyWYYXgYwOPp6Xnc3t7+P7EYpB6k7+zZs2ADNEjRjIwDAgKWgAywIUfz8+fPVzg7O/8AGeCATQEQnAfi/SAah/wcV1dXvAYUgORANA75ehcXl+/4DHAABRIe+ZrhbgAhTHsDiEgHBA0glA6GfSDiw5mZma+A+sphBlhVVFQ88vHx+Xfu3Ll7QP5haOjjwtuAuGHv3r3NIMNABqh8+/atsaur666vr+9XUlwSHx//AGQANxCbAnEWyGQicRMQ9wBxIQM0qjiBWAFqkB00/glhayBWHwb1AgB38EJsUtxtWwAAAABJRU5ErkJggg==\" />
            ";
            // line 9
            if ($this->getAttribute($this->getContext($context, "collector"), "counterrors")) {
                // line 10
                echo "                ";
                $context["status_color"] = "red";
                // line 11
                echo "            ";
            } else {
                // line 12
                echo "                ";
                $context["status_color"] = "yellow";
                // line 13
                echo "            ";
            }
            // line 14
            echo "            ";
            $context["error_count"] = ($this->getAttribute($this->getContext($context, "collector"), "counterrors") + $this->getAttribute($this->getContext($context, "collector"), "countdeprecations"));
            // line 15
            echo "            <span class=\"sf-toolbar-status sf-toolbar-status-";
            echo twig_escape_filter($this->env, $this->getContext($context, "status_color"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getContext($context, "error_count"), "html", null, true);
            echo "</span>
        ";
            $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 17
            echo "        ";
            ob_start();
            // line 18
            echo "            ";
            if ($this->getAttribute($this->getContext($context, "collector"), "counterrors")) {
                // line 19
                echo "                <div class=\"sf-toolbar-info-piece\">
                    <b>Exception</b>
                    <span class=\"sf-toolbar-status sf-toolbar-status-red\">";
                // line 21
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "collector"), "counterrors"), "html", null, true);
                echo "</span>
                </div>
            ";
            }
            // line 24
            echo "            ";
            if ($this->getAttribute($this->getContext($context, "collector"), "countdeprecations")) {
                // line 25
                echo "                <div class=\"sf-toolbar-info-piece\">
                    <b>Deprecated Calls</b>
                    <span class=\"sf-toolbar-status sf-toolbar-status-yellow\">";
                // line 27
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "collector"), "countdeprecations"), "html", null, true);
                echo "</span>
                </div>
            ";
            }
            // line 30
            echo "        ";
            $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
            // line 31
            echo "        ";
            $this->env->loadTemplate("@WebProfiler/Profiler/toolbar_item.html.twig")->display(array_merge($context, array("link" => $this->getContext($context, "profiler_url"))));
            // line 32
            echo "    ";
        }
    }

    // line 35
    public function block_menu($context, array $blocks = array())
    {
        // line 36
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAgCAYAAAAMq2gFAAABjElEQVRIx2MIDw+vd3R0/GFvb/+fGtjFxeVJSUmJ1f///5nv37/PAMMMzs7OVLMEhoODgy/k5+cHJCYmagAtZAJbRG1L0DEwxCYALeOgiUXbt2+/X1NT8xTEdnd3/wi0SI4mFgHBDCBeCLXoF5BtwkCEpvNAvB8JnydCTwgQR0It+g1kWxNjUQEQOyDhAiL0gNUiWWRDjEUOyMkUZsCoRaMWjVpEvEVkFkGjFmEUqgc+fvx4hVYWIReqzi9evKileaoDslnu3LkTNLQtGk3edLPIycnpL9Bge5pb1NXVdQNosDmGRcAm7F+QgKur6783b95cBQoeRGv1kII3QPOdAoZF8+fPP4PUqnx55syZVKCEI1rLh1hsAbWEZ8aMGaUoFoFcMG3atKdIjfSPISEhawICAlaQgwMDA1f6+/sfB5rzE2Sej4/PD3C7DkjoAHHVoUOHLpSVlX3w8vL6Sa34Alr6Z8WKFaCoMARZxAHEoFZ/HBD3A/FyIF4BxMvIxCC964F4G6hZDMTxQCwJAGWE8pur5kFDAAAAAElFTkSuQmCC\" alt=\"Logger\"></span>
    <strong>Logs</strong>
    ";
        // line 39
        if (($this->getAttribute($this->getContext($context, "collector"), "counterrors") || $this->getAttribute($this->getContext($context, "collector"), "countdeprecations"))) {
            // line 40
            echo "        ";
            $context["error_count"] = ($this->getAttribute($this->getContext($context, "collector"), "counterrors") + $this->getAttribute($this->getContext($context, "collector"), "countdeprecations"));
            // line 41
            echo "        <span class=\"count\">
            <span>";
            // line 42
            echo twig_escape_filter($this->env, $this->getContext($context, "error_count"), "html", null, true);
            echo "</span>
        </span>
    ";
        }
        // line 45
        echo "</span>
";
    }

    // line 48
    public function block_panel($context, array $blocks = array())
    {
        // line 49
        echo "    <h2>Logs</h2>

    ";
        // line 51
        $context["priority"] = $this->getAttribute($this->getAttribute($this->getContext($context, "request"), "query"), "get", array(0 => "priority", 1 => 0), "method");
        // line 52
        echo "
    <table>
        <tr>
            <th>Filter</th>
            <td>
                <form id=\"priority-form\" action=\"\" method=\"get\" style=\"display: inline\">
                    <input type=\"hidden\" name=\"panel\" value=\"logger\">
                    <label for=\"priority\">Priority</label>
                    <select id=\"priority\" name=\"priority\" onchange=\"document.getElementById('priority-form').submit(); \">
                        ";
        // line 62
        echo "                        ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(array(100 => "DEBUG", 200 => "INFO", 250 => "NOTICE", 300 => "WARNING", 400 => "ERROR", 500 => "CRITICAL", 550 => "ALERT", 600 => "EMERGENCY", "-100" => "DEPRECATION only"));
        foreach ($context['_seq'] as $context["value"] => $context["text"]) {
            // line 63
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, $this->getContext($context, "value"), "html", null, true);
            echo "\"";
            echo ((($this->getContext($context, "value") == $this->getContext($context, "priority"))) ? (" selected") : (""));
            echo ">";
            echo twig_escape_filter($this->env, $this->getContext($context, "text"), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['value'], $context['text'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 65
        echo "                    </select>
                    <noscript>
                        <input type=\"submit\" value=\"refresh\">
                    </noscript>
                </form>
            </td>
        </tr>
    </table>

    ";
        // line 74
        if ($this->getAttribute($this->getContext($context, "collector"), "logs")) {
            // line 75
            echo "        <ul class=\"alt\">
            ";
            // line 76
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "collector"), "logs"));
            $context['_iterated'] = false;
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
                if (((($this->getContext($context, "priority") >= 0) && ($this->getAttribute($this->getContext($context, "log"), "priority") >= $this->getContext($context, "priority"))) || (($this->getContext($context, "priority") < 0) && ((($this->getAttribute($this->getAttribute($this->getContext($context, "log", true), "context", array(), "any", false, true), "type", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getContext($context, "log", true), "context", array(), "any", false, true), "type"), 0)) : (0)) == $this->getContext($context, "priority"))))) {
                    // line 77
                    echo "                <li class=\"";
                    echo twig_escape_filter($this->env, twig_cycle(array(0 => "odd", 1 => "even"), $this->getAttribute($this->getContext($context, "loop"), "index")), "html", null, true);
                    if (($this->getAttribute($this->getContext($context, "log"), "priority") >= 400)) {
                        echo " error";
                    } elseif (($this->getAttribute($this->getContext($context, "log"), "priority") >= 300)) {
                        echo " warning";
                    }
                    echo "\">
                    ";
                    // line 78
                    echo $context["logger"]->getdisplay_message($this->getAttribute($this->getContext($context, "loop"), "index"), $this->getContext($context, "log"));
                    echo "
                </li>
            ";
                    $context['_iterated'] = true;
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            if (!$context['_iterated']) {
                // line 81
                echo "                <li><em>No logs available for this priority.</em></li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 83
            echo "        </ul>
    ";
        } else {
            // line 85
            echo "        <p>
            <em>No logs available.</em>
        </p>
    ";
        }
    }

    // line 92
    public function getdisplay_message($_log_index = null, $_log = null)
    {
        $context = $this->env->mergeGlobals(array(
            "log_index" => $_log_index,
            "log" => $_log,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 93
            echo "    ";
            if ((twig_constant("Symfony\\Component\\HttpKernel\\Debug\\ErrorHandler::TYPE_DEPRECATION") == (($this->getAttribute($this->getAttribute($this->getContext($context, "log", true), "context", array(), "any", false, true), "type", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getContext($context, "log", true), "context", array(), "any", false, true), "type"), 0)) : (0)))) {
                // line 94
                echo "        DEPRECATION -  ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "log"), "message"), "html", null, true);
                echo "
        ";
                // line 95
                $context["id"] = ("sf-call-stack-" . $this->getContext($context, "log_index"));
                // line 96
                echo "        <a href=\"#\" onclick=\"Sfjs.toggle('";
                echo twig_escape_filter($this->env, $this->getContext($context, "id"), "html", null, true);
                echo "', document.getElementById('";
                echo twig_escape_filter($this->env, $this->getContext($context, "id"), "html", null, true);
                echo "-on'), document.getElementById('";
                echo twig_escape_filter($this->env, $this->getContext($context, "id"), "html", null, true);
                echo "-off')); return false;\">
            <img class=\"toggle\" id=\"";
                // line 97
                echo twig_escape_filter($this->env, $this->getContext($context, "id"), "html", null, true);
                echo "-off\" alt=\"-\" src=\"data:image/gif;base64,R0lGODlhEgASAMQSANft94TG57Hb8GS44ez1+mC24IvK6ePx+Wa44dXs92+942e54o3L6W2844/M6dnu+P/+/l614P///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAABIALAAAAAASABIAQAVCoCQBTBOd6Kk4gJhGBCTPxysJb44K0qD/ER/wlxjmisZkMqBEBW5NHrMZmVKvv9hMVsO+hE0EoNAstEYGxG9heIhCADs=\" style=\"display:none\">
            <img class=\"toggle\" id=\"";
                // line 98
                echo twig_escape_filter($this->env, $this->getContext($context, "id"), "html", null, true);
                echo "-on\" alt=\"+\" src=\"data:image/gif;base64,R0lGODlhEgASAMQTANft99/v+Ga44bHb8ITG52S44dXs9+z1+uPx+YvK6WC24G+944/M6W28443L6dnu+Ge54v/+/l614P///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAABMALAAAAAASABIAQAVS4DQBTiOd6LkwgJgeUSzHSDoNaZ4PU6FLgYBA5/vFID/DbylRGiNIZu74I0h1hNsVxbNuUV4d9SsZM2EzWe1qThVzwWFOAFCQFa1RQq6DJB4iIQA7\" style=\"display:inline\">
        </a>
        ";
                // line 100
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getContext($context, "log"), "context"), "stack"));
                foreach ($context['_seq'] as $context["index"] => $context["call"]) {
                    if (($this->getContext($context, "index") > 1)) {
                        // line 101
                        echo "            ";
                        if (($this->getContext($context, "index") == 2)) {
                            // line 102
                            echo "                <ul class=\"sf-call-stack\" id=\"";
                            echo twig_escape_filter($this->env, $this->getContext($context, "id"), "html", null, true);
                            echo "\" style=\"display: none\">
            ";
                        }
                        // line 104
                        echo "            ";
                        if ($this->getAttribute($this->getContext($context, "call", true), "class", array(), "any", true, true)) {
                            // line 105
                            echo "                ";
                            $context["from"] = (($this->env->getExtension('code')->abbrClass($this->getAttribute($this->getContext($context, "call"), "class")) . "::") . $this->env->getExtension('code')->abbrMethod($this->getAttribute($this->getContext($context, "call"), "function")));
                            // line 106
                            echo "            ";
                        } elseif ($this->getAttribute($this->getContext($context, "call", true), "function", array(), "any", true, true)) {
                            // line 107
                            echo "                ";
                            $context["from"] = $this->env->getExtension('code')->abbrMethod($this->getAttribute($this->getContext($context, "call"), "function"));
                            // line 108
                            echo "            ";
                        } elseif ($this->getAttribute($this->getContext($context, "call", true), "file", array(), "any", true, true)) {
                            // line 109
                            echo "                ";
                            $context["from"] = $this->getAttribute($this->getContext($context, "call"), "file");
                            // line 110
                            echo "            ";
                        } else {
                            // line 111
                            echo "                ";
                            $context["from"] = "-";
                            // line 112
                            echo "            ";
                        }
                        // line 113
                        echo "
            <li>Called from ";
                        // line 114
                        echo ((($this->getAttribute($this->getContext($context, "call", true), "file", array(), "any", true, true) && $this->getAttribute($this->getContext($context, "call", true), "line", array(), "any", true, true))) ? ($this->env->getExtension('code')->formatFile($this->getAttribute($this->getContext($context, "call"), "file"), $this->getAttribute($this->getContext($context, "call"), "line"), $this->getContext($context, "from"))) : ($this->getContext($context, "from")));
                        echo "</li>

            ";
                        // line 116
                        if (($this->getContext($context, "index") == (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "log"), "context"), "stack")) - 1))) {
                            // line 117
                            echo "                </ul>
            ";
                        }
                        // line 119
                        echo "        ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['index'], $context['call'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 120
                echo "    ";
            } else {
                // line 121
                echo "        ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "log"), "priorityName"), "html", null, true);
                echo " - ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "log"), "message"), "html", null, true);
                echo "
        ";
                // line 122
                if (($this->getAttribute($this->getContext($context, "log", true), "context", array(), "any", true, true) && (!twig_test_empty($this->getAttribute($this->getContext($context, "log"), "context"))))) {
                    // line 123
                    echo "            <br />
            <small>
                <strong>Context</strong>: ";
                    // line 125
                    echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($this->getContext($context, "log"), "context"), (64 | 256)), "html", null, true);
                    echo "
            </small>
        ";
                }
                // line 128
                echo "    ";
            }
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:logger.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  367 => 128,  357 => 123,  345 => 120,  334 => 117,  332 => 116,  327 => 114,  324 => 113,  321 => 112,  318 => 111,  309 => 108,  306 => 107,  297 => 104,  291 => 102,  288 => 101,  283 => 100,  274 => 97,  265 => 96,  263 => 95,  258 => 94,  255 => 93,  243 => 92,  235 => 85,  231 => 83,  224 => 81,  212 => 78,  202 => 77,  190 => 76,  161 => 63,  143 => 51,  122 => 41,  109 => 35,  58 => 14,  82 => 28,  63 => 18,  61 => 15,  204 => 78,  188 => 76,  174 => 65,  167 => 71,  125 => 42,  118 => 49,  104 => 32,  76 => 25,  47 => 18,  37 => 10,  164 => 70,  157 => 56,  145 => 52,  139 => 49,  131 => 45,  120 => 40,  111 => 47,  108 => 37,  106 => 36,  83 => 33,  74 => 14,  60 => 6,  52 => 12,  462 => 202,  453 => 199,  449 => 198,  446 => 197,  441 => 196,  439 => 195,  431 => 189,  429 => 188,  422 => 184,  415 => 180,  408 => 176,  401 => 172,  394 => 168,  387 => 164,  380 => 160,  373 => 156,  361 => 125,  355 => 122,  351 => 141,  348 => 121,  342 => 137,  338 => 119,  335 => 134,  329 => 131,  325 => 129,  323 => 128,  320 => 127,  315 => 110,  312 => 109,  303 => 106,  300 => 105,  298 => 120,  289 => 113,  286 => 112,  278 => 98,  275 => 105,  270 => 102,  267 => 101,  262 => 98,  256 => 96,  248 => 94,  246 => 32,  241 => 90,  233 => 87,  229 => 85,  226 => 84,  220 => 81,  216 => 79,  213 => 78,  207 => 75,  203 => 73,  200 => 72,  197 => 71,  194 => 70,  191 => 77,  185 => 74,  181 => 65,  178 => 64,  176 => 63,  172 => 62,  165 => 60,  162 => 57,  153 => 69,  150 => 55,  147 => 54,  141 => 51,  134 => 54,  130 => 46,  119 => 40,  116 => 39,  113 => 48,  102 => 41,  99 => 31,  96 => 37,  90 => 27,  84 => 24,  81 => 23,  73 => 24,  70 => 19,  67 => 20,  59 => 14,  53 => 12,  45 => 9,  38 => 7,  94 => 22,  92 => 27,  89 => 20,  85 => 24,  79 => 21,  75 => 19,  68 => 14,  64 => 23,  56 => 9,  50 => 14,  29 => 6,  87 => 34,  72 => 18,  55 => 13,  21 => 2,  26 => 5,  98 => 30,  93 => 9,  88 => 25,  80 => 27,  78 => 40,  46 => 10,  36 => 5,  27 => 3,  57 => 16,  40 => 11,  33 => 4,  30 => 3,  44 => 9,  42 => 16,  35 => 6,  31 => 5,  43 => 12,  41 => 8,  28 => 3,  201 => 92,  199 => 91,  196 => 90,  187 => 75,  183 => 82,  173 => 74,  171 => 73,  168 => 61,  166 => 71,  163 => 70,  158 => 67,  156 => 62,  151 => 63,  142 => 59,  138 => 56,  136 => 48,  133 => 55,  123 => 41,  121 => 50,  117 => 39,  115 => 39,  112 => 36,  105 => 34,  101 => 31,  91 => 33,  86 => 28,  69 => 17,  66 => 11,  62 => 23,  54 => 22,  51 => 15,  49 => 11,  39 => 6,  24 => 4,  32 => 5,  25 => 3,  22 => 1,  19 => 1,);
    }
}
