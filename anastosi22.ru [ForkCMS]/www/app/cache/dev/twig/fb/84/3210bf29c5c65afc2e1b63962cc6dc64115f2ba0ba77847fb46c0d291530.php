<?php

/* TwigBundle:Exception:trace.txt.twig */
class __TwigTemplate_fb843210bf29c5c65afc2e1b63962cc6dc64115f2ba0ba77847fb46c0d291530 extends Twig_Template
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
        if ($this->getAttribute($this->getContext($context, "trace"), "function")) {
            // line 2
            echo "    at ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getContext($context, "trace"), "class") . $this->getAttribute($this->getContext($context, "trace"), "type")) . $this->getAttribute($this->getContext($context, "trace"), "function")), "html", null, true);
            echo "(";
            echo twig_escape_filter($this->env, $this->env->getExtension('code')->formatArgsAsText($this->getAttribute($this->getContext($context, "trace"), "args")), "html", null, true);
            echo ")
";
        } else {
            // line 4
            echo "    at n/a
";
        }
        // line 6
        if (($this->getAttribute($this->getContext($context, "trace", true), "file", array(), "any", true, true) && $this->getAttribute($this->getContext($context, "trace", true), "line", array(), "any", true, true))) {
            // line 7
            echo "        in ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "trace"), "file"), "html", null, true);
            echo " line ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "trace"), "line"), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:trace.txt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 4,  87 => 20,  72 => 16,  55 => 13,  21 => 2,  26 => 3,  98 => 40,  93 => 9,  88 => 6,  80 => 19,  78 => 40,  46 => 11,  36 => 7,  27 => 4,  57 => 14,  40 => 8,  33 => 6,  30 => 3,  44 => 10,  42 => 6,  35 => 7,  31 => 5,  43 => 8,  41 => 9,  28 => 3,  201 => 92,  199 => 91,  196 => 90,  187 => 84,  183 => 82,  173 => 74,  171 => 73,  168 => 72,  166 => 71,  163 => 70,  158 => 67,  156 => 66,  151 => 63,  142 => 59,  138 => 57,  136 => 56,  133 => 55,  123 => 47,  121 => 46,  117 => 44,  115 => 43,  112 => 42,  105 => 40,  101 => 39,  91 => 31,  86 => 28,  69 => 25,  66 => 15,  62 => 23,  54 => 11,  51 => 12,  49 => 19,  39 => 16,  24 => 2,  32 => 6,  25 => 4,  22 => 2,  19 => 1,);
    }
}
