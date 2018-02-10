<?php

/* TwigBundle:Exception:exception.css.twig */
class __TwigTemplate_805b215564f1d3fc549c24f2a19ad69d3f97a3f7141d8b8c8e9fe08726ef8726 extends Twig_Template
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
        echo "/*
";
        // line 2
        if (isset($context["exception"])) { $_exception_ = $context["exception"]; } else { $_exception_ = null; }
        $this->env->loadTemplate("TwigBundle:Exception:exception.txt.twig")->display(array_merge($context, array("exception" => $_exception_)));
        // line 3
        echo "*/
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.css.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 4,  33 => 9,  25 => 3,  22 => 2,  19 => 1,);
    }
}
