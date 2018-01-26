<?php

/* TwigBundle:Exception:traces.txt.twig */
class __TwigTemplate_470169693d761f6ce5f941884c4f2f0d682baf28421308b44b853c2d179f59f8 extends Twig_Template
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
        if (isset($context["exception"])) { $_exception_ = $context["exception"]; } else { $_exception_ = null; }
        if (twig_length_filter($this->env, $this->getAttribute($_exception_, "trace"))) {
            // line 2
            if (isset($context["exception"])) { $_exception_ = $context["exception"]; } else { $_exception_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($_exception_, "trace"));
            foreach ($context['_seq'] as $context["_key"] => $context["trace"]) {
                // line 3
                if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
                $this->env->loadTemplate("TwigBundle:Exception:trace.txt.twig")->display(array("trace" => $_trace_));
                // line 4
                echo "
";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trace'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:traces.txt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 24,  114 => 22,  109 => 21,  106 => 20,  101 => 19,  85 => 16,  81 => 14,  77 => 12,  67 => 9,  59 => 8,  45 => 6,  28 => 4,  39 => 7,  110 => 20,  89 => 16,  65 => 14,  63 => 13,  58 => 12,  34 => 5,  26 => 4,  98 => 40,  93 => 18,  88 => 17,  80 => 15,  46 => 9,  44 => 9,  36 => 6,  43 => 8,  30 => 4,  57 => 11,  50 => 7,  47 => 7,  38 => 5,  52 => 11,  49 => 10,  37 => 5,  27 => 3,  227 => 92,  224 => 91,  221 => 90,  211 => 84,  207 => 82,  197 => 74,  195 => 73,  192 => 72,  189 => 71,  186 => 70,  181 => 67,  178 => 66,  173 => 63,  162 => 59,  158 => 57,  155 => 56,  152 => 55,  142 => 47,  140 => 46,  136 => 44,  133 => 43,  130 => 42,  120 => 40,  115 => 39,  105 => 31,  100 => 19,  78 => 40,  75 => 24,  70 => 23,  60 => 12,  56 => 20,  53 => 19,  40 => 7,  32 => 4,  24 => 4,  33 => 4,  25 => 3,  22 => 2,  19 => 1,);
    }
}
