<?php

/* WebProfilerBundle:Router:panel.html.twig */
class __TwigTemplate_b024a9c7d1a77e74404278ed840bca9a4975a6556e4d6ed74393e94d34ca43d8 extends Twig_Template
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
        echo "<h2>Routing for \"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "request"), "pathinfo"), "html", null, true);
        echo "\"</h2>

<ul>
    <li>
        <strong>Route:&nbsp;</strong>
        ";
        // line 6
        if ($this->getAttribute($this->getContext($context, "request"), "route")) {
            // line 7
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "request"), "route"), "html", null, true);
            echo "
        ";
        } else {
            // line 9
            echo "            <em>No matching route</em>
        ";
        }
        // line 11
        echo "    </li>
    <li>
        <strong>Route parameters:&nbsp;</strong>
        ";
        // line 14
        if (twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "request"), "routeParams"))) {
            // line 15
            echo "            ";
            $this->env->loadTemplate("@WebProfiler/Profiler/table.html.twig")->display(array("data" => $this->getAttribute($this->getContext($context, "request"), "routeParams"), "class" => "inline"));
            // line 16
            echo "        ";
        } else {
            // line 17
            echo "            <em>No parameters</em>
        ";
        }
        // line 19
        echo "    </li>
    ";
        // line 20
        if ($this->getAttribute($this->getContext($context, "router"), "redirect")) {
            // line 21
            echo "    <li>
        <strong>Redirecting to:&nbsp;</strong> \"";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "router"), "targetUrl"), "html", null, true);
            echo "\" ";
            if ($this->getAttribute($this->getContext($context, "router"), "targetRoute")) {
                echo "(route: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "router"), "targetRoute"), "html", null, true);
                echo "\")";
            }
            // line 23
            echo "    <li>
    ";
        }
        // line 25
        echo "    <li>
        <strong>Route matching logs</strong>
        <table class=\"routing inline\">
            <tr>
                <th>Route name</th>
                <th>Pattern</th>
                <th>Log</th>
            </tr>
            ";
        // line 33
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "traces"));
        foreach ($context['_seq'] as $context["_key"] => $context["trace"]) {
            // line 34
            echo "                <tr class=\"";
            echo (((1 == $this->getAttribute($this->getContext($context, "trace"), "level"))) ? ("almost") : ((((2 == $this->getAttribute($this->getContext($context, "trace"), "level"))) ? ("matches") : (""))));
            echo "\">
                    <td>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "trace"), "name"), "html", null, true);
            echo "</td>
                    <td>";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "trace"), "path"), "html", null, true);
            echo "</td>
                    <td>";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "trace"), "log"), "html", null, true);
            echo "</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trace'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "        </table>
        <em><small>Note: The above matching is based on the configuration for the current router which might differ from
        the configuration used while routing this request.</small></em>
    </li>
</ul>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Router:panel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 36,  77 => 25,  350 => 327,  308 => 287,  95 => 39,  71 => 23,  65 => 22,  20 => 1,  48 => 16,  810 => 492,  807 => 491,  796 => 489,  792 => 488,  788 => 486,  775 => 485,  749 => 479,  746 => 478,  727 => 476,  710 => 475,  706 => 473,  702 => 472,  698 => 471,  694 => 470,  690 => 469,  686 => 468,  682 => 467,  679 => 466,  677 => 465,  660 => 464,  649 => 462,  634 => 456,  629 => 454,  625 => 453,  622 => 452,  620 => 451,  606 => 449,  601 => 446,  567 => 414,  549 => 411,  532 => 410,  529 => 409,  527 => 408,  522 => 406,  517 => 404,  182 => 87,  389 => 160,  386 => 159,  378 => 157,  371 => 156,  363 => 153,  358 => 151,  353 => 328,  343 => 146,  340 => 145,  331 => 140,  328 => 139,  326 => 138,  307 => 128,  302 => 125,  296 => 121,  293 => 120,  290 => 119,  281 => 114,  276 => 111,  269 => 107,  259 => 103,  253 => 100,  232 => 88,  227 => 86,  222 => 83,  210 => 77,  208 => 76,  189 => 66,  184 => 63,  175 => 58,  170 => 84,  155 => 47,  152 => 46,  144 => 42,  127 => 35,  34 => 5,  367 => 339,  357 => 123,  345 => 147,  334 => 141,  332 => 116,  327 => 114,  324 => 113,  321 => 135,  318 => 111,  309 => 129,  306 => 286,  297 => 104,  291 => 102,  288 => 118,  283 => 115,  274 => 110,  265 => 105,  263 => 95,  258 => 94,  255 => 101,  243 => 92,  235 => 89,  231 => 83,  224 => 81,  212 => 78,  202 => 94,  190 => 76,  161 => 63,  143 => 51,  122 => 41,  109 => 52,  58 => 18,  82 => 19,  63 => 21,  61 => 23,  204 => 78,  188 => 90,  174 => 65,  167 => 71,  125 => 42,  118 => 49,  104 => 37,  76 => 28,  47 => 15,  37 => 7,  164 => 70,  157 => 56,  145 => 74,  139 => 49,  131 => 45,  120 => 31,  111 => 47,  108 => 47,  106 => 51,  83 => 30,  74 => 14,  60 => 20,  52 => 12,  462 => 202,  453 => 199,  449 => 198,  446 => 197,  441 => 196,  439 => 195,  431 => 189,  429 => 188,  422 => 184,  415 => 180,  408 => 176,  401 => 172,  394 => 168,  387 => 164,  380 => 158,  373 => 156,  361 => 152,  355 => 329,  351 => 141,  348 => 121,  342 => 137,  338 => 119,  335 => 134,  329 => 131,  325 => 129,  323 => 128,  320 => 127,  315 => 131,  312 => 130,  303 => 106,  300 => 105,  298 => 120,  289 => 113,  286 => 112,  278 => 98,  275 => 105,  270 => 102,  267 => 101,  262 => 98,  256 => 96,  248 => 97,  246 => 136,  241 => 93,  233 => 87,  229 => 87,  226 => 84,  220 => 81,  216 => 79,  213 => 78,  207 => 75,  203 => 73,  200 => 72,  197 => 69,  194 => 68,  191 => 67,  185 => 74,  181 => 65,  178 => 59,  176 => 86,  172 => 57,  165 => 83,  162 => 57,  153 => 77,  150 => 55,  147 => 75,  141 => 73,  134 => 39,  130 => 46,  119 => 40,  116 => 57,  113 => 40,  102 => 33,  99 => 23,  96 => 35,  90 => 37,  84 => 27,  81 => 23,  73 => 23,  70 => 26,  67 => 22,  59 => 22,  53 => 17,  45 => 14,  38 => 6,  94 => 21,  92 => 28,  89 => 30,  85 => 23,  79 => 29,  75 => 28,  68 => 12,  64 => 24,  56 => 16,  50 => 16,  29 => 3,  87 => 33,  72 => 27,  55 => 38,  21 => 2,  26 => 3,  98 => 34,  93 => 38,  88 => 25,  80 => 29,  78 => 18,  46 => 14,  36 => 9,  27 => 7,  57 => 19,  40 => 11,  33 => 6,  30 => 7,  44 => 11,  42 => 8,  35 => 5,  31 => 8,  43 => 12,  41 => 19,  28 => 6,  201 => 92,  199 => 93,  196 => 92,  187 => 75,  183 => 82,  173 => 85,  171 => 73,  168 => 61,  166 => 54,  163 => 82,  158 => 80,  156 => 62,  151 => 63,  142 => 59,  138 => 56,  136 => 71,  133 => 55,  123 => 61,  121 => 50,  117 => 39,  115 => 39,  112 => 36,  105 => 25,  101 => 43,  91 => 34,  86 => 28,  69 => 26,  66 => 25,  62 => 21,  54 => 19,  51 => 37,  49 => 14,  39 => 10,  24 => 2,  32 => 6,  25 => 3,  22 => 2,  19 => 1,);
    }
}
