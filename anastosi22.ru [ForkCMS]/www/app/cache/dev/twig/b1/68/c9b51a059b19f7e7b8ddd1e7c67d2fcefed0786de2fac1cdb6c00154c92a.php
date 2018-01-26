<?php

/* ::database_data_collector.html.twig */
class __TwigTemplate_b168c9b51a059b19f7e7b8ddd1e7c67d2fcefed0786de2fac1cdb6c00154c92a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        <img width=\"20\" height=\"28\" alt=\"Database\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAcCAYAAABh2p9gAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAQRJREFUeNpi/P//PwM1ARMDlcGogZQDlpMnT7pxc3NbA9nhQKxOpL5rQLwJiPeBsI6Ozl+YBOOOHTv+AOllQNwtLS39F2owKYZ/gRq8G4i3ggxEToggWzvc3d2Pk+1lNL4fFAs6ODi8JzdS7mMRVyDVoAMHDsANdAPiOCC+jCQvQKqBQB/BDbwBxK5AHA3E/kB8nKJkA8TMQBwLxaBIKQbi70AvTADSBiSadwFXpCikpKQU8PDwkGTaly9fHFigkaKIJid4584dkiMFFI6jkTJII0WVmpHCAixZQEXWYhDeuXMnyLsVlEQKI45qFBQZ8eRECi4DBaAlDqle/8A48ip6gAADANdQY88Uc0oGAAAAAElFTkSuQmCC\" />
        <span class=\"sf-toolbar-status";
        // line 6
        if ((50 < $this->getAttribute($this->getContext($context, "collector"), "querycount"))) {
            echo " sf-toolbar-status-yellow";
        }
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "collector"), "querycount"), "html", null, true);
        echo "</span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 8
        echo "    ";
        ob_start();
        // line 9
        echo "        <div class=\"sf-toolbar-info-piece\">
            <b>DB Queries</b>
            <span>";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "collector"), "querycount"), "html", null, true);
        echo "</span>
        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 14
        echo "    ";
        $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => $this->getContext($context, "profiler_url"))));
    }

    // line 17
    public function block_menu($context, array $blocks = array())
    {
        // line 18
        echo "    <span class=\"label\">
        <span class=\"icon\"><img src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAcCAYAAAB/E6/TAAABLUlEQVR42u3TP0vDQBiA8UK/gDiLzi0IhU4OEunk5OQUAhGSOBUCzqWfIKSzX8DRySF0URCcMjWLIJjFD9Cpk/D6HITecEPUuzhIAz8CIdyTP/f2iqI4qaqqDx8l5Ic2uIeP/bquezCokOAFF+oCN3t4gPzSEjc4NEPaCldQbzjELTYW0RJzHDchwwem+ons6ZBpLSJ7nueJC22h0V+FzmwWV0ee59vQNV67CGVZJmEYbkNjfpY6X6I0Qo4/3RMmTdDDspuQVsJvgkP3IdMbIkIjLPBoadG2646iKJI0Ta2wxm6OdnP0/Tk6DYJgHcfxpw21RtscDTDDnaVZ26474GkkSRIrrPEv5sgMTfHe+cA2O6wPH6vOBpYQNALneHb96XTEDI6dzpEZ0VzO0Rf3pP5LMLI4tAAAAABJRU5ErkJggg==\" alt=\"\" /></span>
        <strong>SpoonDatabase</strong>
        <span class=\"count\">
            <span>";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "collector"), "querycount"), "html", null, true);
        echo "</span>
        </span>
    </span>
";
    }

    // line 27
    public function block_panel($context, array $blocks = array())
    {
        // line 28
        echo "    <h2>Queries</h2>

    ";
        // line 30
        if (twig_test_empty($this->getAttribute($this->getContext($context, "collector"), "queries"))) {
            // line 31
            echo "        <p>
            <em>No queries.</em>
        </p>
    ";
        } else {
            // line 35
            echo "        <table class=\"alt\">
            <tbody>
                ";
            // line 37
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "collector"), "queries"));
            foreach ($context['_seq'] as $context["i"] => $context["query"]) {
                // line 38
                echo "                    <tr class=\"\">
                        <";
                // line 39
                echo twig_escape_filter($this->env, twig_cycle(array(0 => "th", 1 => "td"), $this->getContext($context, "i")), "html", null, true);
                echo ">
                            ";
                // line 40
                echo $this->getAttribute($this->getContext($context, "query"), "query_formatted");
                echo "<br/>
                            <small>
                                <strong>Parameters:</strong>
                                [
                                    ";
                // line 44
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "query"), "parameters"));
                $context['loop'] = array(
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                );
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["parameter"]) {
                    // line 45
                    echo "                                        ";
                    echo twig_escape_filter($this->env, $this->getContext($context, "parameter"), "html", null, true);
                    if ((!$this->getAttribute($this->getContext($context, "loop"), "last"))) {
                        echo ",";
                    }
                    // line 46
                    echo "                                    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['parameter'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 47
                echo "                                ]
                            </small>
                        </";
                // line 49
                echo twig_escape_filter($this->env, twig_cycle(array(0 => "th", 1 => "td"), $this->getContext($context, "i")), "html", null, true);
                echo ">
                    </tr>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['i'], $context['query'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "            </tbody>
        </table>
    ";
        }
        // line 55
        echo "
    <style>
        th small {
            font-weight: normal;
        }
        th pre {
            background: none !important;
            font-weight: normal;
        }
    </style>
";
    }

    public function getTemplateName()
    {
        return "::database_data_collector.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  137 => 45,  100 => 36,  77 => 25,  350 => 327,  308 => 287,  95 => 39,  71 => 23,  65 => 22,  20 => 1,  48 => 8,  810 => 492,  807 => 491,  796 => 489,  792 => 488,  788 => 486,  775 => 485,  749 => 479,  746 => 478,  727 => 476,  710 => 475,  706 => 473,  702 => 472,  698 => 471,  694 => 470,  690 => 469,  686 => 468,  682 => 467,  679 => 466,  677 => 465,  660 => 464,  649 => 462,  634 => 456,  629 => 454,  625 => 453,  622 => 452,  620 => 451,  606 => 449,  601 => 446,  567 => 414,  549 => 411,  532 => 410,  529 => 409,  527 => 408,  522 => 406,  517 => 404,  182 => 87,  389 => 160,  386 => 159,  378 => 157,  371 => 156,  363 => 153,  358 => 151,  353 => 328,  343 => 146,  340 => 145,  331 => 140,  328 => 139,  326 => 138,  307 => 128,  302 => 125,  296 => 121,  293 => 120,  290 => 119,  281 => 114,  276 => 111,  269 => 107,  259 => 103,  253 => 100,  232 => 88,  227 => 86,  222 => 83,  210 => 77,  208 => 76,  189 => 66,  184 => 63,  175 => 55,  170 => 52,  155 => 47,  152 => 46,  144 => 42,  127 => 35,  34 => 5,  367 => 339,  357 => 123,  345 => 147,  334 => 141,  332 => 116,  327 => 114,  324 => 113,  321 => 135,  318 => 111,  309 => 129,  306 => 286,  297 => 104,  291 => 102,  288 => 118,  283 => 115,  274 => 110,  265 => 105,  263 => 95,  258 => 94,  255 => 101,  243 => 92,  235 => 89,  231 => 83,  224 => 81,  212 => 78,  202 => 94,  190 => 76,  161 => 49,  143 => 46,  122 => 41,  109 => 39,  58 => 18,  82 => 19,  63 => 21,  61 => 14,  204 => 78,  188 => 90,  174 => 65,  167 => 71,  125 => 42,  118 => 49,  104 => 37,  76 => 28,  47 => 15,  37 => 7,  164 => 70,  157 => 47,  145 => 74,  139 => 49,  131 => 45,  120 => 44,  111 => 47,  108 => 47,  106 => 38,  83 => 27,  74 => 14,  60 => 20,  52 => 12,  462 => 202,  453 => 199,  449 => 198,  446 => 197,  441 => 196,  439 => 195,  431 => 189,  429 => 188,  422 => 184,  415 => 180,  408 => 176,  401 => 172,  394 => 168,  387 => 164,  380 => 158,  373 => 156,  361 => 152,  355 => 329,  351 => 141,  348 => 121,  342 => 137,  338 => 119,  335 => 134,  329 => 131,  325 => 129,  323 => 128,  320 => 127,  315 => 131,  312 => 130,  303 => 106,  300 => 105,  298 => 120,  289 => 113,  286 => 112,  278 => 98,  275 => 105,  270 => 102,  267 => 101,  262 => 98,  256 => 96,  248 => 97,  246 => 136,  241 => 93,  233 => 87,  229 => 87,  226 => 84,  220 => 81,  216 => 79,  213 => 78,  207 => 75,  203 => 73,  200 => 72,  197 => 69,  194 => 68,  191 => 67,  185 => 74,  181 => 65,  178 => 59,  176 => 86,  172 => 57,  165 => 83,  162 => 57,  153 => 77,  150 => 55,  147 => 75,  141 => 73,  134 => 39,  130 => 46,  119 => 40,  116 => 57,  113 => 40,  102 => 37,  99 => 23,  96 => 35,  90 => 30,  84 => 27,  81 => 23,  73 => 23,  70 => 26,  67 => 22,  59 => 22,  53 => 17,  45 => 14,  38 => 6,  94 => 21,  92 => 31,  89 => 30,  85 => 23,  79 => 29,  75 => 22,  68 => 12,  64 => 24,  56 => 16,  50 => 16,  29 => 3,  87 => 33,  72 => 27,  55 => 11,  21 => 2,  26 => 3,  98 => 35,  93 => 38,  88 => 25,  80 => 29,  78 => 18,  46 => 14,  36 => 5,  27 => 7,  57 => 19,  40 => 11,  33 => 4,  30 => 3,  44 => 11,  42 => 8,  35 => 5,  31 => 8,  43 => 12,  41 => 19,  28 => 6,  201 => 92,  199 => 93,  196 => 92,  187 => 75,  183 => 82,  173 => 85,  171 => 73,  168 => 61,  166 => 54,  163 => 82,  158 => 80,  156 => 62,  151 => 63,  142 => 59,  138 => 56,  136 => 71,  133 => 55,  123 => 61,  121 => 50,  117 => 39,  115 => 39,  112 => 36,  105 => 25,  101 => 43,  91 => 34,  86 => 28,  69 => 18,  66 => 17,  62 => 21,  54 => 19,  51 => 9,  49 => 14,  39 => 6,  24 => 2,  32 => 6,  25 => 3,  22 => 2,  19 => 1,);
    }
}
