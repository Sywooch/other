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
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        if ((50 < $this->getAttribute($_collector_, "querycount"))) {
            echo " sf-toolbar-status-yellow";
        }
        echo "\">";
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_collector_, "querycount"), "html", null, true);
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
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_collector_, "querycount"), "html", null, true);
        echo "</span>
        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 14
        echo "    ";
        if (isset($context["profiler_url"])) { $_profiler_url_ = $context["profiler_url"]; } else { $_profiler_url_ = null; }
        $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => $_profiler_url_)));
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
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_collector_, "querycount"), "html", null, true);
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
        if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
        if (twig_test_empty($this->getAttribute($_collector_, "queries"))) {
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
            if (isset($context["collector"])) { $_collector_ = $context["collector"]; } else { $_collector_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_collector_, "queries"));
            foreach ($context['_seq'] as $context["i"] => $context["query"]) {
                // line 38
                echo "                    <tr class=\"\">
                        <";
                // line 39
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo twig_escape_filter($this->env, twig_cycle(array(0 => "th", 1 => "td"), $_i_), "html", null, true);
                echo ">
                            ";
                // line 40
                if (isset($context["query"])) { $_query_ = $context["query"]; } else { $_query_ = null; }
                echo $this->getAttribute($_query_, "query_formatted");
                echo "<br/>
                            <small>
                                <strong>Parameters:</strong>
                                [
                                    ";
                // line 44
                if (isset($context["query"])) { $_query_ = $context["query"]; } else { $_query_ = null; }
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($_query_, "parameters"));
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
                    if (isset($context["parameter"])) { $_parameter_ = $context["parameter"]; } else { $_parameter_ = null; }
                    echo twig_escape_filter($this->env, $_parameter_, "html", null, true);
                    if (isset($context["loop"])) { $_loop_ = $context["loop"]; } else { $_loop_ = null; }
                    if ((!$this->getAttribute($_loop_, "last"))) {
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
                if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
                echo twig_escape_filter($this->env, twig_cycle(array(0 => "th", 1 => "td"), $_i_), "html", null, true);
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
        return array (  188 => 55,  183 => 52,  169 => 47,  147 => 45,  129 => 44,  116 => 39,  113 => 38,  108 => 37,  104 => 35,  95 => 30,  91 => 28,  79 => 22,  73 => 18,  64 => 14,  62 => 16,  55 => 15,  41 => 8,  121 => 40,  114 => 22,  109 => 21,  106 => 20,  101 => 19,  85 => 16,  81 => 14,  77 => 12,  67 => 9,  59 => 8,  45 => 6,  28 => 4,  39 => 6,  110 => 20,  89 => 16,  65 => 14,  63 => 13,  58 => 12,  34 => 5,  26 => 5,  98 => 31,  93 => 18,  88 => 27,  80 => 15,  46 => 9,  44 => 9,  36 => 5,  43 => 14,  30 => 3,  57 => 11,  50 => 8,  47 => 7,  38 => 13,  52 => 11,  49 => 10,  37 => 5,  27 => 3,  227 => 92,  224 => 91,  221 => 90,  211 => 84,  207 => 82,  197 => 74,  195 => 73,  192 => 72,  189 => 71,  186 => 70,  181 => 67,  178 => 66,  173 => 49,  162 => 59,  158 => 57,  155 => 46,  152 => 55,  142 => 47,  140 => 46,  136 => 44,  133 => 43,  130 => 42,  120 => 40,  115 => 39,  105 => 31,  100 => 19,  78 => 40,  75 => 24,  70 => 17,  60 => 12,  56 => 20,  53 => 9,  40 => 7,  32 => 4,  24 => 4,  33 => 4,  25 => 3,  22 => 2,  19 => 1,);
    }
}
