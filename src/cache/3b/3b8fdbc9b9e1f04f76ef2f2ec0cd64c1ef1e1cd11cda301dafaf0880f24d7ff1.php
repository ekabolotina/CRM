<?php

/* err_404.html.twig */
class __TwigTemplate_77ecf92983e6f42849ce4f4f323dd8caecbb1484d7eec6ee149f4410ae3a8c34 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "err_404.html.twig", 1);
        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page_title($context, array $blocks = array())
    {
        echo "Страница не найдена";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "  <h1>Страница не найдена.</h1>
";
    }

    public function getTemplateName()
    {
        return "err_404.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 6,  39 => 5,  33 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'base.html.twig' %}

{% block page_title %}Страница не найдена{% endblock page_title %}

{% block content %}
  <h1>Страница не найдена.</h1>
{% endblock content %}
", "err_404.html.twig", "/home/ivan/WWW/CRM/src/views/err_404.html.twig");
    }
}
