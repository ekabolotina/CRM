<?php

/* main/login.html.twig */
class __TwigTemplate_2bb902ccd06e640f0b596a7d864e69d7e80e702c1c8e6d07d49b9cb5a1e82d4d extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "main/login.html.twig", 1);
        $this->blocks = array(
            'header' => array($this, 'block_header'),
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
    public function block_header($context, array $blocks = array())
    {
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "  <section id=\"loginForm\">
    <h1>Добро пожаловать</h1>
    <h3>Авторизуйтесь для продолжения</h3>

    <form class=\"ajaxForm\" action=\"/login_user\" callback-after=\"loginUserCallbackAfter\">
      <input type=\"text\" name=\"login\" placeholder=\"Логин\">
      <input type=\"password\" name=\"password\" placeholder=\"Пароль\">
      <input type=\"submit\" value=\"Войти\" class=\"submit\">
    </form>
  </section>
";
    }

    public function getTemplateName()
    {
        return "main/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 6,  38 => 5,  33 => 3,  15 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends 'base.html.twig' %}

{% block header %}{% endblock header %}

{% block content %}
  <section id=\"loginForm\">
    <h1>Добро пожаловать</h1>
    <h3>Авторизуйтесь для продолжения</h3>

    <form class=\"ajaxForm\" action=\"/login_user\" callback-after=\"loginUserCallbackAfter\">
      <input type=\"text\" name=\"login\" placeholder=\"Логин\">
      <input type=\"password\" name=\"password\" placeholder=\"Пароль\">
      <input type=\"submit\" value=\"Войти\" class=\"submit\">
    </form>
  </section>
{% endblock content %}
", "main/login.html.twig", "/home/ivan/WWW/CRM/src/views/main/login.html.twig");
    }
}
