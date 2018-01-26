<?php

/* TwigBundle:Exception:logs.html.twig */
class __TwigTemplate_79597ab1137808a6fdb4eacf16081fb83d91876289c5d3bd0801f59a3b87959e extends Twig_Template
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
        echo "<ol class=\"traces logs\">
    ";
        // line 2
        if (isset($context["logs"])) { $_logs_ = $context["logs"]; } else { $_logs_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_logs_);
        foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
            // line 3
            echo "        <li";
            if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
            if (($this->getAttribute($_log_, "priority") >= 400)) {
                echo " class=\"error\"";
            } elseif (($this->getAttribute($_log_, "priority") >= 300)) {
                echo " class=\"warning\"";
            }
            echo ">
            ";
            // line 4
            if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_log_, "priorityName"), "html", null, true);
            echo " - ";
            if (isset($context["log"])) { $_log_ = $context["log"]; } else { $_log_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_log_, "message"), "html", null, true);
            echo "
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</ol>
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:logs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 40,  93 => 9,  88 => 6,  80 => 41,  46 => 10,  44 => 9,  36 => 7,  43 => 8,  30 => 3,  57 => 11,  50 => 7,  47 => 6,  38 => 5,  52 => 6,  49 => 5,  37 => 4,  27 => 3,  227 => 92,  224 => 91,  221 => 90,  211 => 84,  207 => 82,  197 => 74,  195 => 73,  192 => 72,  189 => 71,  186 => 70,  181 => 67,  178 => 66,  173 => 63,  162 => 59,  158 => 57,  155 => 56,  152 => 55,  142 => 47,  140 => 46,  136 => 44,  133 => 43,  130 => 42,  120 => 40,  115 => 39,  105 => 31,  100 => 28,  78 => 40,  75 => 24,  70 => 23,  60 => 12,  56 => 20,  53 => 19,  40 => 8,  32 => 6,  24 => 4,  33 => 4,  25 => 3,  22 => 2,  19 => 1,);
    }
}
