<?php

/* WebProfilerBundle:Profiler:info.html.twig */
class __TwigTemplate_c424ddcbaaf8337b6646671df7b8dcc61c2de755505ed4bada2a3e0a49813806 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("@WebProfiler/Profiler/base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    <div id=\"content\">
        ";
        // line 5
        $this->env->loadTemplate("@WebProfiler/Profiler/header.html.twig")->display(array());
        // line 6
        echo "
        <div id=\"main\">
            <div class=\"clear-fix\">
                <div id=\"collector-wrapper\">
                    <div id=\"collector-content\">
                        ";
        // line 11
        $this->displayBlock('panel', $context, $blocks);
        // line 34
        echo "                    </div>
                </div>
                <div id=\"navigation\">
                    ";
        // line 37
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_search_bar"));
        echo "
                    ";
        // line 38
        $this->env->loadTemplate("@WebProfiler/Profiler/admin.html.twig")->display(array("token" => ""));
        // line 39
        echo "                </div>
            </div>
        </div>
    </div>
";
    }

    // line 11
    public function block_panel($context, array $blocks = array())
    {
        // line 12
        echo "                            ";
        if (($this->getContext($context, "about") == "purge")) {
            // line 13
            echo "                                <h2>The profiler database was purged successfully</h2>
                                <p>
                                    <em>Now you need to browse some pages with the Symfony Profiler enabled to collect data.</em>
                                </p>
                            ";
        } elseif (($this->getContext($context, "about") == "upload_error")) {
            // line 18
            echo "                                <h2>A problem occurred when uploading the data</h2>
                                <p>
                                    <em>No file given or the file was not uploaded successfully.</em>
                                </p>
                            ";
        } elseif (($this->getContext($context, "about") == "already_exists")) {
            // line 23
            echo "                                <h2>A problem occurred when uploading the data</h2>
                                <p>
                                    <em>The token already exists in the database.</em>
                                </p>
                            ";
        } elseif (($this->getContext($context, "about") == "no_token")) {
            // line 28
            echo "                                <h2>Token not found</h2>
                                <p>
                                    <em>Token \"";
            // line 30
            echo twig_escape_filter($this->env, $this->getContext($context, "token"), "html", null, true);
            echo "\" was not found in the database.</em>
                                </p>
                            ";
        }
        // line 33
        echo "                        ";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:info.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 13,  65 => 11,  20 => 1,  48 => 16,  810 => 492,  807 => 491,  796 => 489,  792 => 488,  788 => 486,  775 => 485,  749 => 479,  746 => 478,  727 => 476,  710 => 475,  706 => 473,  702 => 472,  698 => 471,  694 => 470,  690 => 469,  686 => 468,  682 => 467,  679 => 466,  677 => 465,  660 => 464,  649 => 462,  634 => 456,  629 => 454,  625 => 453,  622 => 452,  620 => 451,  606 => 449,  601 => 446,  567 => 414,  549 => 411,  532 => 410,  529 => 409,  527 => 408,  522 => 406,  517 => 404,  182 => 87,  389 => 160,  386 => 159,  378 => 157,  371 => 156,  363 => 153,  358 => 151,  353 => 149,  343 => 146,  340 => 145,  331 => 140,  328 => 139,  326 => 138,  307 => 128,  302 => 125,  296 => 121,  293 => 120,  290 => 119,  281 => 114,  276 => 111,  269 => 107,  259 => 103,  253 => 100,  232 => 88,  227 => 86,  222 => 83,  210 => 77,  208 => 76,  189 => 66,  184 => 63,  175 => 58,  170 => 84,  155 => 47,  152 => 46,  144 => 42,  127 => 35,  34 => 5,  367 => 155,  357 => 123,  345 => 147,  334 => 141,  332 => 116,  327 => 114,  324 => 113,  321 => 135,  318 => 111,  309 => 129,  306 => 107,  297 => 104,  291 => 102,  288 => 118,  283 => 115,  274 => 110,  265 => 105,  263 => 95,  258 => 94,  255 => 101,  243 => 92,  235 => 89,  231 => 83,  224 => 81,  212 => 78,  202 => 94,  190 => 76,  161 => 63,  143 => 51,  122 => 41,  109 => 52,  58 => 25,  82 => 19,  63 => 18,  61 => 12,  204 => 78,  188 => 90,  174 => 65,  167 => 71,  125 => 42,  118 => 49,  104 => 32,  76 => 34,  47 => 21,  37 => 6,  164 => 70,  157 => 56,  145 => 74,  139 => 49,  131 => 45,  120 => 31,  111 => 47,  108 => 37,  106 => 51,  83 => 33,  74 => 14,  60 => 6,  52 => 12,  462 => 202,  453 => 199,  449 => 198,  446 => 197,  441 => 196,  439 => 195,  431 => 189,  429 => 188,  422 => 184,  415 => 180,  408 => 176,  401 => 172,  394 => 168,  387 => 164,  380 => 158,  373 => 156,  361 => 152,  355 => 150,  351 => 141,  348 => 121,  342 => 137,  338 => 119,  335 => 134,  329 => 131,  325 => 129,  323 => 128,  320 => 127,  315 => 131,  312 => 130,  303 => 106,  300 => 105,  298 => 120,  289 => 113,  286 => 112,  278 => 98,  275 => 105,  270 => 102,  267 => 101,  262 => 98,  256 => 96,  248 => 97,  246 => 136,  241 => 93,  233 => 87,  229 => 87,  226 => 84,  220 => 81,  216 => 79,  213 => 78,  207 => 75,  203 => 73,  200 => 72,  197 => 69,  194 => 68,  191 => 67,  185 => 74,  181 => 65,  178 => 59,  176 => 86,  172 => 57,  165 => 83,  162 => 57,  153 => 77,  150 => 55,  147 => 75,  141 => 73,  134 => 39,  130 => 46,  119 => 40,  116 => 57,  113 => 48,  102 => 33,  99 => 23,  96 => 30,  90 => 42,  84 => 40,  81 => 23,  73 => 33,  70 => 15,  67 => 14,  59 => 16,  53 => 12,  45 => 9,  38 => 18,  94 => 21,  92 => 28,  89 => 20,  85 => 23,  79 => 18,  75 => 19,  68 => 12,  64 => 23,  56 => 16,  50 => 22,  29 => 3,  87 => 41,  72 => 18,  55 => 38,  21 => 2,  26 => 5,  98 => 45,  93 => 9,  88 => 25,  80 => 27,  78 => 18,  46 => 34,  36 => 10,  27 => 7,  57 => 39,  40 => 11,  33 => 9,  30 => 5,  44 => 11,  42 => 11,  35 => 5,  31 => 8,  43 => 12,  41 => 19,  28 => 3,  201 => 92,  199 => 93,  196 => 92,  187 => 75,  183 => 82,  173 => 85,  171 => 73,  168 => 61,  166 => 54,  163 => 82,  158 => 80,  156 => 62,  151 => 63,  142 => 59,  138 => 56,  136 => 71,  133 => 55,  123 => 61,  121 => 50,  117 => 39,  115 => 39,  112 => 36,  105 => 25,  101 => 31,  91 => 33,  86 => 28,  69 => 17,  66 => 11,  62 => 27,  54 => 22,  51 => 37,  49 => 14,  39 => 10,  24 => 4,  32 => 4,  25 => 3,  22 => 1,  19 => 1,);
    }
}
