<?php

/* TwigBundle:Exception:exception_full.html.twig */
class __TwigTemplate_f56a0b160f31363f7de84f139033dc922b771d14a78ad0c424a784606462647f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("TwigBundle::layout.html.twig");

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "TwigBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/css/exception.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        // line 8
        echo "    ";
        if (isset($context["exception"])) { $_exception_ = $context["exception"]; } else { $_exception_ = null; }
        echo twig_escape_filter($this->env, $this->getAttribute($_exception_, "message"), "html", null, true);
        echo " (";
        if (isset($context["status_code"])) { $_status_code_ = $context["status_code"]; } else { $_status_code_ = null; }
        echo twig_escape_filter($this->env, $_status_code_, "html", null, true);
        echo " ";
        if (isset($context["status_text"])) { $_status_text_ = $context["status_text"]; } else { $_status_text_ = null; }
        echo twig_escape_filter($this->env, $_status_text_, "html", null, true);
        echo ")
";
    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        // line 12
        echo "    ";
        $this->env->loadTemplate("TwigBundle:Exception:exception.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 8,  30 => 3,  57 => 11,  50 => 7,  47 => 6,  38 => 5,  52 => 6,  49 => 5,  37 => 4,  27 => 2,  227 => 92,  224 => 91,  221 => 90,  211 => 84,  207 => 82,  197 => 74,  195 => 73,  192 => 72,  189 => 71,  186 => 70,  181 => 67,  178 => 66,  173 => 63,  162 => 59,  158 => 57,  155 => 56,  152 => 55,  142 => 47,  140 => 46,  136 => 44,  133 => 43,  130 => 42,  120 => 40,  115 => 39,  105 => 31,  100 => 28,  78 => 25,  75 => 24,  70 => 23,  60 => 12,  56 => 20,  53 => 19,  40 => 7,  32 => 3,  24 => 4,  33 => 4,  25 => 3,  22 => 2,  19 => 1,);
    }
}
